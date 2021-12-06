<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class InertiaDemoController extends Controller
{
    public function show(String $username)
    {
        return Inertia::render('Demo', [
            'username' => $username
        ]);
    }

    public function singleChart() {
        return Inertia::render('SingleChart');
    }

    public function multipleChart() {
        return Inertia::render('MultipleChart');
    }
}
