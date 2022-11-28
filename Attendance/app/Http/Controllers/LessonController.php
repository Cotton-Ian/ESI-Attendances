<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function index(){
        $lessons = Lesson::getLessonForToday();
        return view('lesson', compact('lessons'));
    }
}
