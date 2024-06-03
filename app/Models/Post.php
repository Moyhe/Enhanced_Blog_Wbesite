<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
<<<<<<< HEAD
        'title',
        'slug',
        'thumbnail',
        'body',
        'active',
        'published_at',
        'user_id',
        'meta_data',
        'meta_description'
=======
       'title',
       'slug',
       'thumbnail',
       'body',
       'active',
       'published_at',
       'user_id',
       'meta_data',
       'meta_description'
>>>>>>> origin/main
    ];


    protected $casts = [

        'published_at' => 'datetime'
    ];


    /**
     * Get the user that owns the Post
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The roles that belong to the Post
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function shortBody($words = 30): string
    {
        return Str::words(strip_tags($this->body), $words);
    }

    public function getFormatedDate()
    {
        return $this->published_at->format('F jS Y');
    }

    public function getThumbnail()
    {
<<<<<<< HEAD
        if (str_starts_with($this->thumbnail, 'https')) {
            return $this->thumbnail;
        }

        return '/storage/' . $this->thumbnail;
    }

    public function humanReadTime(): Attribute
    {
        return new Attribute(
            get: function ($value, $attributes) {
                $words = Str::wordCount(strip_tags($attributes['body']));
                $minutes = ceil($words / 200);
                return $minutes . ' ' . str('min')->plural($minutes) . ', ' . $words . ' ' . str('word')->plural($minutes);
=======
         if(str_starts_with($this->thumbnail, 'http'))
         {
            return $this->thumbnail;
         }

         return '/storage/' . $this->thumbnail;
    }

    public function humanReadTime(): Attribute {
        return new Attribute(
            get: function($value, $attributes) {
                  $words = Str::wordCount(strip_tags($attributes['body']));
                  $minutes = ceil($words/ 200);
                  return $minutes . ' ' .str('min')->plural($minutes). ', '. $words . ' ' . str('word')->plural($minutes);
>>>>>>> origin/main
            }
        );
    }
}
