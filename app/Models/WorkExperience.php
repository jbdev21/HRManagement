<?php

namespace App\Models;

use App\Traits\HasDocumentTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WorkExperience extends Model
{
    use HasFactory, HasDocumentTrait;

    protected $fillable = [
        'employee_id',
        'job_title',
        'status',
        'start_date',
        'end_date',
        'description',
    ];

    //date protected
    protected $dates = [
        'start_date',
        'end_date',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function documents()
    {
        return $this->morphMany(Document::class, 'documentable');
    }

    //calculate duration
    public function getDurationAttribute()
    {
        if ($this->start_date && $this->end_date) {
            $start = new \DateTime($this->start_date);
            $end = new \DateTime($this->end_date);
            $diff = $start->diff($end);
            return $diff->format('%y years, %m months, %d days');
        }
        return null;
    }

    //duration left calculate from today dates
    public function getDurationLeftAttribute()
    {
        if ($this->end_date) {
            $end = new \DateTime($this->end_date);
            $today = new \DateTime();
            $diff = $today->diff($end);
            return $diff->format('%y years, %m months, %d days');
        }
        return null;
    }
}
