<?php

namespace App\Models;

use App\Traits\GetImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class TextWidget extends Model
{
    use HasFactory, GetImage;

    protected $fillable = [

        'key',
        'image',
        'title',
        'content',
        'active'
    ];


    public static function getTitle(string $key): string
    {
        $widget =  Cache::get('text-widget-' . $key, function () use ($key) {
            return TextWidget::query()->where('key', '=', $key)->where('active', '=', 1)->first();
        });

        if ($widget) {
            return $widget->title;
        }

        return '';
    }


    public static function getContent(string $key): string
    {
        $widget =  Cache::get('text-widget-' . $key, function () use ($key) {
            return TextWidget::query()->where('key', '=', $key)->where('active', '=', 1)->first();
        });

        if ($widget) {
            return $widget->content;
        }

        return '';
    }
}
