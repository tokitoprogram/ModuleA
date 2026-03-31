<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Book extends Model
{
    protected $fillable = ['title', 'author', 'description','published_year', 'path_to_image', 'currentPage', 'user_id', 'genre_id'];
    protected $casts = [

        'published_year'=>'integer',
        'currentPage'=>'integer'

    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function genre(): BelongsTo
    {
        return $this->belongsTo(Genre::class);
    }
}
