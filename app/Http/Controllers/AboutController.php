<?php

namespace App\Http\Controllers;

use App\Models\TextWidget;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AboutController extends Controller
{
    public function __invoke(): View
    {
        $widget = TextWidget::query()
            ->where('key', '=', 'About-page')
            ->where('active', '=', true)->first();
        if (!$widget) {
            throw new NotFoundHttpException();
        }

        return view('about', compact('widget'));
    }
}
