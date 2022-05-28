<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestRun extends Model
{
    use HasFactory;

    public function project() {
        return $this->belongsTo(Project::class);
    }

    public function testCases() {
        return $this->belongsToMany(TestCase::class, 'test_results')->as('result')->withPivot(
            'status',
            'comment',
            'updated_by',
            'updated_at'
        );
    }
}