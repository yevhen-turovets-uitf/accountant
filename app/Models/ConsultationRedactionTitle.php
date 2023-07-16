<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ConsultationRedactionTitle extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'text_id',
        'consultation_redaction_id',
    ];

    public function redaction(): ?BelongsTo
    {
        return $this->belongsTo(ConsultationRedaction::class, 'consultation_redaction_id', 'id');
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getTextId(): string
    {
        return $this->text_id;
    }

    public function getCreatedDate(): ?Carbon
    {
        return $this->created_at;
    }

    public function getUpdateDate(): ?Carbon
    {
        return $this->updated_at;
    }
}
