<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     */
    public function index(): View
    {
        return view('pages.dashboard.index');
    }

    /**
     * Display the components demo page.
     */
    public function componentsDemo(): View
    {
        return view('pages.dashboard.components-demo');
    }

    /**
     * Display the forms demo page.
     */
    public function formsDemo(): View
    {
        return view('pages.dashboard.forms-demo');
    }

    /**
     * Display the data demo page.
     */
    public function dataDemo(): View
    {
        return view('pages.dashboard.data-demo');
    }

    /**
     * Display the interactive demo page.
     */
    public function interactiveDemo(): View
    {
        return view('pages.dashboard.interactive-demo');
    }

    /**
     * Display the feedback demo page.
     */
    public function feedbackDemo(): View
    {
        return view('pages.dashboard.feedback-demo');
    }
}
