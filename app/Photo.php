<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $table = 'photo';
    protected $primaryKey ='photo_id';
    protected $fillable = ['filename', 'filesize', 'height', 'width', 'user_id'];

    public function tags()
    {
        return $this->hasMany(PhotoTag::class, 'photo_id');
    }
}
