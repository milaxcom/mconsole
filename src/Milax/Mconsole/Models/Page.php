<?php

namespace Milax\Mconsole\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = ['slug', 'title', 'heading', 'preview', 'text', 'description', 'hide_heading', 'fullwidth', 'system', 'enabled'];
    
    protected $casts = [
        'heading' => 'array',
        'preview' => 'array',
        'text' => 'array',
        'title' => 'array',
        'description' => 'array',
        'links' => 'array',
    ];
    
    public function setSlugAttribute($value)
    {
        if (strlen($value) == 0) {
            $this->attributes['slug'] = str_slug($this->heading);
        } else {
            $this->attributes['slug'] = str_slug($value);
        }
    }
    
    /**
     * ContentLink relationship
     * 
     * @return Illuminate\Eloquent\Relatios\HasMany
     */
    public function links()
    {
        return $this->hasMany('Milax\Mconsole\Models\ContentLink');
    }
}
