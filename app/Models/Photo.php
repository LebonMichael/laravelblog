<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = ['file'];

    //protected $guarded = ['id']; //alleen id nodig beschermt de id zodat hij uniek is

    protected $uploads = '/img/';
    /** 'accessor' versie 8 **/
    public function getFileAttribute($photo)
    {
        return $this->uploads . $photo;
    }
    /** zelfde als getFileAttribute maar in versie 9 **/
    /*protected function firstName(): Attribute
    {
        return Attribute::make(
            get: fn($value) => ucfirst($value),
        );
    }*/


}
