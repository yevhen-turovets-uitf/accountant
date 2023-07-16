<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicAgreement extends Model
{
    use HasFactory;

    protected $table = 'public_agreement';
    protected $fillable = [
        'description',
    ];

    public function getDescription(): string
    {
        return $this->description;
    }
}
