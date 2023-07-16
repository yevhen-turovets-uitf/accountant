<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConsultationRedaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'date',
        'description',
        'consultation_id',
    ];

    public function redactionTitles(): ?HasMany
    {
        return $this->hasMany(ConsultationRedactionTitle::class);
    }

    public function files(): ?HasMany
    {
        return $this->hasMany(ConsultationRedactionFile::class);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getUpdateDate(): ?Carbon
    {
        return $this->updated_at;
    }

    public function getCreatedDate(): ?Carbon
    {
        return $this->created_at;
    }

    public function getDeletedDate(): ?Carbon
    {
        return $this->deleted_at;
    }
}
