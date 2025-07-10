<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShowAssignModel extends Model
{
    use HasFactory;
    protected $table = 'showassign';
    protected $primarykey = 'id';
    protected $fillable = [
        'showtype_id',
        'title',
        'subtitle',
        'description',
        'thumbnail',
        'url',
        'status',
        'metatitle',
        'metadescription',
        'metakey',
    ];

    public function showType()
    {
        return $this->belongsTo(ShowTypeModel::class, 'showtype_id');
    }

}
