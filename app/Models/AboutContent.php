<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutContent extends Model
{
    use HasFactory;
    
    protected $table = 'aboutcontent';

    // Specify the fillable fields
    protected $fillable = [
        'heading',
        'subheading',
        'description',
        'content',
        'status',
        'position_by',
        'metatitle',
       'metadescription', 
       'metakey'
    ];
}
