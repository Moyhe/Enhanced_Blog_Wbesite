<div class="flex mb-4 gap-3">
    <div class="w-12 h-12 flex items-center justify-center bg-gray-200 rounded-full">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
        </svg>

    </div>
    <div>
        <div>
            <a href="#" class="font-semibold text-indigo-600">
                {{ $comment->user->name }}
            </a>
            - <span class="text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
        </div>

        @if ($editing)
        <livewire:comment-create :comment-model="$comment" />
        @else
        <div>
            {{ $comment->comment }}
        </div>
        @endif

        <div class="gap-3">
            <a wire:click.prevent='startReply' href="" class="text-indigo-600 mr-3">Reply</a>
            @if (Auth::id() == $comment->user_id)
            <a href="#" wire:click.prevent='editComment' class="text-blue-600 mr-3">Edit</a>
            <a href="" wire:click.prevent='deleteComment' class="text-red-600">Delete</a>
            @endif
        </div>
        @if ($replying)
        <livewire:comment-create :post="$comment->post" :parent-comment="$comment" />
        @endif


        <div class="mb-3 mt-5">
            @foreach ($comment->comments as $childComment)

            <livewire:comment-item :comment="$childComment" wire:key="comment-{{ $childComment->id }}" />

            @endforeach
        </div>

    </div>
</div>