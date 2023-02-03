<?php

namespace App\Models;

use App\Traits\UuidForKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleComment extends Model
{
    use HasFactory, UuidForKey;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'article_comment_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'article_id',
        'source_id',
        'comment'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'source_id');
    }

    public function fisioterapis()
    {
        return $this->belongsTo(Fisioterapis::class, 'source_id');
    }

    public function getNameAttribute()
    {
        return $this->user->name ?? $this->fisioterapis->name;
    }
}
