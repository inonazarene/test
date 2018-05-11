<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhotoTag extends Model
{
    protected $table = 'photo_tag';
    protected $primaryKey = 'photo_tag_id';
    protected $fillable = ['tag','photo_id'];
}
