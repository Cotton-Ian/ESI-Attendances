<?php

namespace App\Http\Controllers;
use App\Models\Student;
use App\Models\StudentPresences;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Util\Http\Response\CustomResponse;
use App\Http\Requests\UpdatePresenceRequest;

class PresenceController extends Controller
{
    /**
     * It gets all the students with their presence for today
     *
     * @return A view called presence.blade.php
     */
    public function index()
    {

    }

    public function getPresenceToday($id){
        $students = Student::getStudentLessonsPresences($id);
        $lesson = Lesson::find($id);

        return view('presence', compact(['students', 'lesson']));
    }


    /**
     * It takes a JSON array of objects, each object containing a student's id and a boolean value
     * indicating whether the student is present or not, and updates the database accordingly
     *
     * @param Request request The request object.
     *
     * @return A JSON object with a message.
     */
    public function takePresence(UpdatePresenceRequest $request)
    {
        $lesson = Lesson::find($request[0]['lesson_id']);

        $data = [];
        foreach($request->request->all()  as $presence){
            $data[$presence['student_id']] = ['is_present'=>$presence['is_present' ]];

        }
        $lesson->students()->sync($data);

        return CustomResponse::make('json')
            -> withMessage('Student presences successfully taken !')
            -> success()
            -> get();
    }
}
