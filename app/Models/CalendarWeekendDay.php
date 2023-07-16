<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class CalendarWeekendDay extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = [];

    protected $casts = [
        'date' => 'datetime',
    ];

    public function getId(): int
    {
        return $this->id;
    }

    public function getDate(): ?Carbon
    {
        return $this->date;
    }
}
