<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Livewire\Component;
use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;

class Comments extends Component
{

    // public Collection $comments;
    public Post $post;

    public function mount(Post $post)
    {
        $this->post = $post;
    }

    protected $listeners = [

        'commentCreated' => '$refresh',
        'commentDeleted' => '$refresh',
    ];

    public function render()
    {

        $comments = $this->selectComments();
        return view('livewire.comments', compact('comments'));
    }

    // public function commentCreated(int $id)
    // {
    //     $comment = Comment::query()->where('id', '=', $id)->first();
    //    if(!$comment->parent_id)
    //    {
    //      $this->comments = $this->comments->prepend($comment);
    //    }
    // }

    // public function commentDeleted(int $id)
    // {
    //     $this->comments = $this->comments->reject(function ($comment) use($id) {
    //         return $comment->id == $id;
    //     });

    // }

    public function selectComments()
    {
        return Comment::query()
            ->with(['post', 'user', 'comments'])
            ->whereNull('parent_id')
            ->where('post_id', '=', $this->post->id)
            ->orderByDesc('created_at')
            ->get();
    }
}
