<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class TaskController extends Controller
{
    /**
     * Display a list of tasks.
     *
     * @return View
     */
    public function __invoke(): View
    {
        return view('tasks.index');
    }
}
