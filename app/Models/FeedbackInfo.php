<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeedbackInfo extends Model
{
    use HasFactory;

    protected $table = 'feedback_info';
    protected $fillable = [
        'description',
        'map',
    ];

    public function getId(): int
    {
        return $this->id;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getMap(): string
    {
        return $this->map;
    }
}
