<?php
/** @var $posts \Illuminate\Pagination\LengthAwarePaginator */
?>

<x-app-layout :meta-title="$category->title" meta-description="welcome to the story of love kanekiTouka">

    <!-- Posts Section -->
    <div class="flex">
        <section class="w-full md:w-2/3 flex flex-col items-center px-3">

            @foreach ($posts as $post)

            <x-post-items :post="$post"></x-post-items>

            @endforeach
            {{ $posts->onEachSide(1)->links() }}

        </section>

        <x-sidebar></x-sidebar>
    </div>

</x-app-layout>