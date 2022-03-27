<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class School extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['name'];

    public static function boot ()
    {
        parent::boot();

        self::deleting(function (School $school) {

            foreach ($school->students as $student)
            {
                $student->delete();
            }
        });
    }

    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }
}
