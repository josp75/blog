<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    const TITLE = 'title';
    const SLUG = 'slug';
    const EXCERPT = 'excerpt';
    const BODY = 'body';
    const CATEGORY = 'category_id';
    const USER = 'user_id';

    use HasFactory;
    protected $fillable = [
        self::TITLE,
        self::EXCERPT,
        self::BODY,
        self::CATEGORY
    ];

    protected $with = ['category', 'author'];

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
       return $this->belongsTo(Category::class);
    }
    /**
     * @return BelongsTo
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

