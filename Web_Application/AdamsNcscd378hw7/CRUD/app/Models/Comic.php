<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Comic extends Model
{
    use HasFactory;
    use Sortable;
    protected $table = 'comics';
    protected $fillable = [
        'title',
        'volume',
        'volume_id',
        'issue_num',
        'pub_date',
        'condition',
        'writer_name',
        'artist_name',
        'description',
        'image_URL'
    ];

    public $sortable = [
        'title',
        'volume',
        'volume_id',
        'issue_num',
        'pub_date',
        'condition',
        'writer_name',
        'artist_name'
    ];

    public function category()
    {
        return $this->belongsTo('AppCategory');
    }
}
