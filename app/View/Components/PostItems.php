<?php

namespace App\View\Components;

use Closure;
use App\Models\Post;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PostItems extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public Post $post, public bool $showAuthor = true)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.post-items');
    }
}
