<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NormRedactionFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'file_url',
        'norm_redaction_id',
    ];

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getFileUrl(): string
    {
        return $this->file_url;
    }
}
