<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;
use App\Models\UpVoteDownVotes;

class UpVoteDownVote extends Component
{

    public Post $post;

    public function mount(Post $post)
    {
        $this->post = $post;
    }

    public function render()
    {
        $upVotes = UpVoteDownVotes::query()
            ->where('post_id', '=', $this->post->id)
            ->where('is_upvote', '=', true)
            ->count();

        $downVotes = UpVoteDownVotes::query()
            ->where('post_id', '=', $this->post->id)
            ->where('is_upvote', '=', false)
            ->count();

        $hasUpVote = null;

        /** @var \App\Models\User $user  */
        $user = request()->user();
        if ($user) {
            $model = UpVoteDownVotes::query()
                ->where('post_id', '=', $this->post->id)
                ->where('user_id', '=', $user->id)
                ->first();

            if ($model) {
                $hasUpVote = !!$model->is_upvote;
            }
        }

        return view('livewire.up-vote-down-vote', compact('upVotes', 'downVotes', 'hasUpVote'));
    }

    public function upVoteDownVote($upVote = true)
    {
        /** @var \App\Models\User $user  */

        $user = request()->user();
        if (!$user) {
            return $this->redirect('login');
        }
        if (!$user->hasVerifiedEmail()) {
            return $this->redirect(route('verification.notice'));
        }

        $model = UpVoteDownVotes::query()
            ->where('post_id', '=', $this->post->id)
            ->where('user_id', '=', $user->id)
            ->first();

        if (!$model) {
            UpVoteDownVotes::create([

                'is_upvote' =>  $upVote,
                'post_id' =>   $this->post->id,
                'user_id' =>   $user->id

            ]);

            return;
        }

        if ($upVote && $model->is_upvote || !$upVote && !$model->is_upvote) {
            $model->delete();
        } else {

            $model->is_upvote = $upVote;
            $model->save();
        }
    }
}
