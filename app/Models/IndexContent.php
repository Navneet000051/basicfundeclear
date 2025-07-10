<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndexContent extends Model
{
    use HasFactory;
    
    // Specify the table associated with the model
    protected $table = 'indexcontent';

    // Specify the fillable fields
    protected $fillable = [
        'heading',
        'subheading',
        'description',
        'attribute',
        'ytlink',
        'watchlink',
        'content',
        'status',
        'position_by',
        'metatitle',
       'metadescription', 
       'metakey'
    ];
}
