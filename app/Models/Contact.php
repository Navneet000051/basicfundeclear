<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;

class Contact extends Model
{
    use HasFactory;
  
    public $fillable = ['name', 'email', 'message'];

    protected $table = 'contacts';
  
  
}