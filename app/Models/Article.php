<?php

namespace App\Models;

use App\Traits\UuidForKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory, UuidForKey;

    protected $primaryKey = 'article_id';

    protected $fillable = [
        'title',
        'slug',
        'image',
        'content',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['image_url'];

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'article_tags', 'article_id', 'tag_id');
    }

    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('uploads/article/' . $this->image);
        }
    }

    public function comments()
    {
        return $this->hasMany(ArticleComment::class, 'article_id');
    }
}
