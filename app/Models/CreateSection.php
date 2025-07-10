<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreateSection extends Model
{
    use HasFactory;

    // Specify the table if it doesn't follow Laravel's naming conventions
    protected $table = 'sections';

    // Define the fillable properties
    protected $fillable = [
        'section',
        'heading',
        'subheading',
        'status',
    ];

    // Specify the default attribute values
    protected $attributes = [
        'status' => 1,
    ];
}
