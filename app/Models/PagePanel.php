<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PagePanel extends Model
{
    protected $connection = 'cms_db';
    public $table = "page_panel";
    use SoftDeletes;

    
    protected $fillable = [
        'page_id',
        'panel_id',
        'sort'
    ];
}
