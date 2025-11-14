<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class AnalyticsController extends Controller
{
    /**
     * Display the analytics dashboard.
     */
    public function index(): View
    {
        return view('pages.analytics.index');
    }
}
