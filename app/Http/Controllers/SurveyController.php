<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SurveyController extends Controller
{
    public function index() {

        return Inertia::render('Survey', [
            'questions' => Question::all()
        ]);

    }
}
