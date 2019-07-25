<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PanelContent extends Model
{
    protected $connection = 'cms_db';
    public $table = "panel_content";
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'page_panel_id',
        'css_class',
        'css_id',
        'full_width',
        'title',
        'sub_title',
        'bg_image',
        'bg_position',
        'bg_size',
        'bg_color',
        'content',
    ];

    public function panel()
    {
        return $this->belongsTo('App\Models\Panel');
    }
}
