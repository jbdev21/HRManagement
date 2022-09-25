<?php

namespace App\Models;

use App\Traits\HasDocumentTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory, HasDocumentTrait;

    protected $guarded = [];

    //date
    protected $dates = [
        'dob',
    ];

    //fullname
    public function getFullNameAttribute()
    {
        return $this->last_name.', '. $this->first_name;
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }


    public function leaves(){
        return $this->hasMany(Leave::class);
    }

    public function currentLeaves($type = "vacation"){
        if($this->working_status != "permanent"){
            return 0;
        }

        $column = $type == "vacation" ? "points_deduction_vacation" : "points_deduction_sick";

        if($this->permanent_date){
            $credits = $this->getMonthDifference() * config("app.credits_per_month");
            return $credits - $this->leaves()->where('recommendation', "approval")->sum($column);
        }

        return 0;
    }




    function getMonthDifference(){
        if($this->permanent_date){
            $to = now();
            $from = Carbon::parse($this->permanent_date);
            return $to->diffInMonths($from);
        }

        return 0;
    }


    public function workExperiences()
    {
        return $this->hasMany(WorkExperience::class);
    }

    //morphMany documents
    public function documents()
    {
        return $this->morphMany(Document::class, 'documentable');
    }
}
