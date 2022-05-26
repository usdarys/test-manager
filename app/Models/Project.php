<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    public function team() {
        return $this->belongsTo(Team::class);
    }

    public function testRuns() {
        return $this->hasMany(TestRun::class);
    }

    public function testCases() {
        return $this->hasMany(TestCase::class);
    }
}