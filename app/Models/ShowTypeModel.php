<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShowTypeModel extends Model
{
    use HasFactory;

    protected $table = 'showtype';
    protected $primarykey = 'id';
    protected $fillable = ['title', 'subtitle', 'description', 'status','thumbnail'];

    public function assignedShows()
    {
        return $this->hasMany(ShowAssignModel::class, 'showtype_id', 'id')->where('status', 1);
    }
}
