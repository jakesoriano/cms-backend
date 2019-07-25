<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Panel extends Model
{
    protected $connection = 'cms_db';
    public $table = "panel";
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'key',
        'preview_image',
        'config',
    ];

    public function content()
    {
        return $this->hasMany('App\Models\PanelContent');
    }
  
}
