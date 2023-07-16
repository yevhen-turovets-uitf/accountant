<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class CalendarReport extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = [];

    public function forms(): BelongsToMany
    {
        return $this->belongsToMany(Form::Class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::Class);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function getBase(): ?string
    {
        return $this->base;
    }

    public function getEventType(): ?int
    {
        return $this->event_type;
    }
}
