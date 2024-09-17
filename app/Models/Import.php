<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Import extends Model
{
    use HasFactory;
    protected $table = 'imports';
    protected $fillable = [

        'name',
        'department',
        'date',
        'shift',
        'timetable',

        'attendance_status',
        'check_in',
        'check_out',
        'late',
        'early_leave',
        'attended',
        'absent',
        'worked',
        'break',
        'leave_type',
        'leave',
        'ot1',
        'ot2',
        'ot3'

    ];
}
