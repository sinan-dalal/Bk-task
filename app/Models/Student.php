<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory, SoftDeletes;


    protected $fillable = [
        'name',
        'school_id',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($student) {
            $lastOrder = School::findOrFail($student['school_id'])->students->count();
            $student['order'] = ++$lastOrder;

            return $student;
        });
    }


    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }
}
