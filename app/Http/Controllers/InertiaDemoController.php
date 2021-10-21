<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class InertiaDemoController extends Controller
{
    public function show(String $username)
    {
        return Inertia::render('Demo/Show', [
            'username' => $username
        ]);
    }
}
