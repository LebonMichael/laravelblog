<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostsCreateRequest;
use App\Models\Category;
use App\Models\Photo;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts = Post::with(['photo','categories','user'])->filter(request(['search']))->paginate(15);
        Session::flash('user_message','No posts found');
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostsCreateRequest $request)
    {
        $post = new Post();
        $post->title = $request->title;
        $post->slug = Str::slug($post->title, '-');
        $post->body = $request->body;
        $post->user_id = Auth::user()->id;
        /** photo opslaan **/
        if($file = $request->file('photo_id')){
            $name = time() . $file->getClientOriginalName();
            $file->move('img', $name);
            /** wegschrijven naar de photo table **/
            $photo = Photo::create(['file'=>$name]);
            $post['photo_id'] = $photo->id;
        }
        /** wegschrijven naar de post table **/
        $post->save();

        /** de gekozen categorieen wegschrijven naar de tussen table category_post **/
        $post->categories()->sync($request->categories, false);
        return redirect()->route('post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        /** voor detailpagina **/
        //$post = Post::findOrFail($id);
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all();
        $post = Post::findOrFail($id);
        return view('admin.posts.edit', compact('post', 'categories'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        /** Opzoeken van de post die aangepast dient te worden **/
        $post =Post::findOrFail($id);
        /** opgezochte post word vervangen met de nieuwe ingevulde waarden uit het formulier **/
        $post->title = $request->title;
        $post->slug = Str::slug($post->title, '-');
        $post->body = $request->body;
        if($file = $request->file('photo_id')){
            /** opvragen oude image **/
            $oldImage = Photo::find($post->photo_id);
            if($oldImage){
                /** fysisch verwijderen uit img directory **/
                unlink(public_path() . $oldImage->file);
                /** oude image uit de table photos verwijderen **/
                $oldImage->delete();
            }
            /** vanaf hier wordt de nieuwe photo opgeslagen **/
            /** wegschrijven naar img map **/
            $name = time() . $file->getClientOriginalName();
            $file->move('img', $name);
            /** wegschrijven naar de photo table **/
            $photo = Photo::create(['file'=>$name]);
            $post->photo_id = $photo->id;
        }
        $post->update();
        /** categoreen syncen **/
        $post->categories()->sync($request->categories, true);
        return redirect()->route('post.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $post = Post::findOrFail($id);
        if($post->photo){
            unlink(public_path() . $post->photo->file); //fysiek verwijderen uit de img-tabel
            $post->photo->delete();                                // photo deleten uit photo-table
        }
        //categories uit tsstabel verwijderen : gebeurt automatisch door de constraints

        $post->delete();
        return redirect()->route('post.index');
    }
    public function post(Post $post){
        //$post = Post::findOrFail($id);
        $post->load('postcomments.user');
        return view('post', compact('post'));
    }


}
