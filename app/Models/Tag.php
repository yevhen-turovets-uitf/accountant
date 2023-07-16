<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
    ];

    public function news(): ?BelongsToMany
    {
        return $this->belongsToMany(News::class, 'news_tag');
    }

    public function handbooks(): ?BelongsToMany
    {
        return $this->belongsToMany(Handbook::class, 'handbook_tag');
    }

    public function taxSystems(): ?BelongsToMany
    {
        return $this->belongsToMany(TaxSystem::class, 'tax_system_tag');
    }

    public function reports(): ?BelongsToMany
    {
        return $this->belongsToMany(Report::class, 'report_tag');
    }

    public function blanks(): ?BelongsToMany
    {
        return $this->belongsToMany(Blank::class, 'blank_tag');
    }

    public function consultations(): ?BelongsToMany
    {
        return $this->belongsToMany(Consultation::class, 'consultation_tag');
    }

    public function norms(): ?BelongsToMany
    {
        return $this->belongsToMany(Norm::class, 'norm_tag');
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }
}
