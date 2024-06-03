<?php

namespace App\View\Components;

use App\Models\Category;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;

class Sidebar extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $categories = Category::query()

<<<<<<< HEAD
            ->select('categories.title', 'categories.slug', DB::raw('count(*) as total'))
            ->join('category_post', 'categories.id', '=', 'category_post.category_id')
            ->groupBy('categories.id')
            ->orderByDesc('total')
            ->get();
=======
        ->select('categories.title', 'categories.slug', DB::raw('count(*) as total'))
        ->join('category_post', 'categories.id', '=', 'category_post.category_id')
        ->groupBy('categories.id')
        ->orderByDesc('total')
        ->get();
>>>>>>> origin/main

        return view('components.sidebar', compact('categories'));
    }
}
