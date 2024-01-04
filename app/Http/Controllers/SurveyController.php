<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    public function index() {

        return Question::all();

    }
}
