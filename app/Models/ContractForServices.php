<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractForServices extends Model
{
    use HasFactory;

    protected $table = 'contract_for_services';
    protected $fillable = [
        'description',
    ];

    public function getDescription(): string
    {
        return $this->description;
    }
}
