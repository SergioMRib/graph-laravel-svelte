<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SurveyController extends Controller
{
    public function index() {

        $item = Question::all()->map(function($item) {
                    $item['choice'] = 0;

                    return $item;
                });

        return Inertia::render('Survey', [
            'questions' => $item
        ]);

    }
}
