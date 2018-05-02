<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $table = 'photo';
    protected $primaryKey ='photo_id';
    protected $fillable = ['filesize', 'height', 'width', 'user_id'];
}
