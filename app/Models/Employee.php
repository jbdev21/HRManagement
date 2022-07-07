<?php

namespace App\Models;

use App\Traits\HasDocumentTrait;
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
