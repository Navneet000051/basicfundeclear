<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentStudio extends Model
{
    use HasFactory;
    protected $table = 'rent_studios';
    protected $primaryKey = 'id';
    protected $fillable = ['title', 'thumbnail', 'url', 'status',  'metatitle', 'metadescription', 'metakey', 'position_by']; 
}
