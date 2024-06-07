<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\PostView;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function home(): View
    {
        // latest post

        $latesPosts = Post::query()
            ->where('active', '=', 1)
            ->whereDate('published_at', '<', Carbon::now())
            ->orderBy('published_at', 'desc')
            ->limit(1)
            ->first();


        // show the most popular  posts based on upVotes

        $popularPosts = Post::query()
            ->leftJoin('up_vote_down_votes', 'posts.id', '=', 'up_vote_down_votes.post_id')
            ->select('posts.*', DB::raw('COUNT(up_vote_down_votes.id) as upvote_count'))
            ->where(function ($query) {
                $query->whereNull('up_vote_down_votes.is_upvote')
                    ->orWhere('up_vote_down_votes.is_upvote', '=', 1);
            })
            ->where('active', '=', true)
            ->whereDate('published_at', '<', Carbon::now())
            ->orderByDesc('upvote_count')
            ->groupBy('posts.id')
            ->limit(3)
            ->get();


        // if authorized - show recommended posts based on user upvotes

        $user = auth()->user();
        if ($user) {

            $leftJoin = "(SELECT category_post.post_id, category_post.category_id FROM up_vote_down_votes AS votes JOIN category_post ON votes.post_id
               = category_post.post_id WHERE votes.is_upvote = TRUE  AND votes.user_id = ?) as t";
            $recommendedPosts = Post::query()

                ->leftJoin('category_post', 'posts.id', '=', 'category_post.post_id')
                ->leftJoin(DB::raw($leftJoin), function ($join) {
                    $join->on('t.category_id', '=', 'category_post.category_id')
                        ->on('t.post_id', '!=', 'category_post.post_id');
                })
                ->select('posts.*')
                ->where('posts.id', '!=', DB::raw('t.post_id'))
                ->setBindings([$user->id])
                ->limit(3)
                ->get();
        } else {

            // if not authorized show popular posts based on  views


            $recommendedPosts = Post::query()

                ->leftJoin('post_views', 'posts.id', '=', 'post_views.post_id')
                ->select('posts.*', DB::raw('COUNT(post_views.id) as view_count'))
                ->where('active', '=', true)
                ->whereDate('published_at', '<', Carbon::now())
                ->orderByDesc('view_count')
                ->groupBy('posts.id',)
                ->limit(3)
                ->get();
        }

        // show recent categories with their latest pots

        $categories = Category::query()
            // ->with(['posts' =>  function($query) {
            //     $query->orderBy('published_at', 'Desc')->limit(3);
            // }])
            ->whereHas('posts', function ($query) {
                $query
                    ->where('active', '=', true)
                    ->whereDate('published_at', '<', Carbon::now());
            })
            ->select('categories.*')
            ->selectRaw('MAX(posts.published_at) as max_date')
            ->leftJoin('category_post', 'categories.id', '=', 'category_post.category_id')
            ->leftJoin('posts', 'posts.id', '=', 'category_post.post_id')
            ->orderByDesc('max_date')
            ->groupBy('categories.id')
            ->limit(3)
            ->get();


        return view('home', compact('latesPosts', 'popularPosts', 'recommendedPosts', 'categories'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post, Request $request)
    {
        if (!$post->active || $post->published_at > Carbon::now()) {

            throw new NotFoundHttpException();
        }

        $next = Post::query()
            ->where('active', true)
            ->whereDate('published_at', '<=', Carbon::now())
            ->whereDate('published_at', '<', $post->published_at)
            ->orderBy('published_at', 'desc')
            ->limit(1)
            ->first();

        $prev = Post::query()
            ->where('active', true)
            ->whereDate('published_at', '<=', Carbon::now())
            ->whereDate('published_at', '>', $post->published_at)
            ->orderBy('published_at', 'asc')
            ->limit(1)
            ->first();

        $user = $request->user();

        PostView::create([
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'post_id' => $post->id,
            'user_id' => $user?->id
        ]);

        return view('post.view', compact('post', 'next', 'prev'));
    }

    public function byCategory(Category $category)
    {
        $posts = Post::query()

            ->join('category_post', 'posts.id', '=', 'category_post.post_id')
            ->where('category_post.category_id', '=', $category->id)
            ->where('active', true)
            ->whereDate('published_at', '<=', Carbon::now())
            ->orderBy('published_at', 'desc')
            ->paginate(10);

        return view('post.posts', compact('posts', 'category'));
    }

    public function search(Request $request)
    {
        $q = $request->get('q');

        $posts = Post::query()
            ->where('active', '=', true)
            ->whereDate('published_at', '<=', Carbon::now())
            ->orderBy('published_at', 'desc')
            ->where(function ($query) use ($q) {
                $query->where('title', 'like', "%$q%")
                    ->orWhere('body', 'like', "%$q%");
            })
            ->paginate(10);

        return view('post.search', compact('posts'));
    }
}
