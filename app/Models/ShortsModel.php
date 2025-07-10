<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShortsModel extends Model
{
    use HasFactory;
    protected $table = 'short';
    protected $primarykey = 'id';
    protected $fillable = ['title', 'thumbnail', 'url', 'description', 'status',  'metatitle', 'metadescription', 'metakey'];
}
