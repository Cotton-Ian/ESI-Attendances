<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\Pivot;

class StudentPresences extends Pivot
{
    protected $table = 'student_presences';

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
    protected $hidden = [];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    /**
     * It takes an array of arrays, and for each array, it updates the record with the student_id and
     * date, or creates a new record if it doesn't exist, and sets the is_present value to the value in
     * the array.
     *
     * @param presences an array of arrays, each array has the following keys:
     */
    public static function updateOrCreateMultiple($presences){
        foreach($presences as $presence){
            static::class::updateOrCreate(
                ['student_id' => $presence['student_id'], 'date' => $presence['date']],
                ['is_present' => $presence['is_present']]
            );
        }
    }
}
