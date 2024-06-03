<?php

namespace App\Http\Controllers;

use App\Models\TextWidget;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AboutController extends Controller
{
<<<<<<< HEAD
    public function __invoke(): View
    {
        $widget = TextWidget::query()
            ->where('key', '=', 'About-page')
            ->where('active', '=', true)->first();
        if (!$widget) {
=======
    public function about(): View
    {
        $widget = TextWidget::query()
        ->where('key', '=', 'About-page')
        ->where('active', '=', true)->first();
        if(!$widget)
        {
>>>>>>> origin/main
            throw new NotFoundHttpException();
        }

        return view('about', compact('widget'));
    }
}
