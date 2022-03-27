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

    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }
}
