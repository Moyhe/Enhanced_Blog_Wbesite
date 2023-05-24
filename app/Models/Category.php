<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Carbon\Carbon;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
       'title',
       'slug'
    ];

    /**
     * The posts that belong to the Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class);
    }

       /**
     * The posts that belong to the Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function publishedPosts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class)

        ->where('active', '=', true)
        ->whereDate('published_at', '<', Carbon::now());
    }

}
