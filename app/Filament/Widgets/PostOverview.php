<?php

namespace App\Filament\Widgets;

use App\Models\PostView;
use App\Models\UpVoteDownVotes;
use Filament\Widgets\Widget;
use Illuminate\Database\Eloquent\Model;

class PostOverview extends Widget
{
    protected static string $view = 'filament.widgets.post-overview';
    public ?Model $record = null;


    protected function getViewData(): array
    {
        return [

           'viewCount' => PostView::query()->where('post_id', '=', $this->record->id)->count(),
           'upVotes' => UpVoteDownVotes::query()->where('post_id', '=', $this->record->id)->where('is_upVote', '=', true)->count(),
           'downVotes' => UpVoteDownVotes::query()->where('post_id', '=', $this->record->id)->where('is_upVote', '=', false)->count()
        ];
    }

    protected int | string | array $columnSpan = 3;
}
