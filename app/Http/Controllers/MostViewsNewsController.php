<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewsView;
use App\Models\News;
use Jenssegers\Agent\Agent;

class MostViewsNewsController extends Controller
{

    public function index()
    {
        // Fetch all news views
        $newsViews = NewsView::with('news')->latest()->get();

        // Map to include browser name
        $newsViews = $newsViews->map(function ($view) {
            $agent = new Agent();
            $agent->setUserAgent($view->user_agent);

            $view->browser = $agent->browser(); // add browser property
            return $view;
        });

        return view('layouts.newsDashboard.most_views.index', compact('newsViews'));
    }


    public function show(News $news)
    {
        // Return partial view for modal
        return view('layouts.newsDashboard.most_views.show', compact('news'));
    }
}