<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_code',
        'post_name',
        'post_slug',
        'post_summary',
        'post_details',
        'feature_image',
        'status'
    ];

    /**
     * The categories that belong to the post.
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'post_to_category', 'post_id', 'category_id');
    }
}
