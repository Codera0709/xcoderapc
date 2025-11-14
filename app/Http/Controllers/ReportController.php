<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class ReportController extends Controller
{
    /**
     * Display the reports page.
     */
    public function index(): View
    {
        return view('pages.reports.index');
    }
}
