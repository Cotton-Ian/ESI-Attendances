<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory, SoftDeletes;


    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['deleted_at'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The roles that belong to the Student
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function lessons(): BelongsToMany
    {
        return $this->belongsToMany(Lesson::class, 'student_presences')->using(StudentPresences::class, 'student_presences')->withPivot('is_present');
    }


    public static function getStudentLessonsPresences($id)
    {
        $students =  self::orderBy('students.id', 'asc')
        ->leftJoin('student_presences', 'students.id', '=', 'student_id', 'and', 'student_presences.lesson_id', '=', $id)
        ->get(['students.id', 'students.name', 'students.surname', 'student_presences.is_present']);


        return $students;
    }


}
