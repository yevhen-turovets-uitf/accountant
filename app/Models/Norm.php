<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Norm extends Model
{
    use HasFactory, SoftDeletes;

    public const DETAIL_ROUTE_NAME = 'normativeBaseDetail';

    protected $fillable = [
        'title',
        'slug',
        'category_id',
        'number',
        'date',
        'status',
    ];

    protected $casts = [
        'date' => 'datetime',
    ];

    public function category(): ?BelongsTo
    {
        return $this->belongsTo(NormCategory::class, 'category_id', 'id');
    }

    public function redactions(): ?HasMany
    {
        return $this->hasMany(NormRedaction::class);
    }

    public function lastRedaction(): ?NormRedaction
    {
        return $this->redactions() ? $this->redactions()->orderByDesc('date')->first() : null;
    }

    public function tags(): ?BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'norm_tag');
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function getDate(): ?Carbon
    {
        return $this->date;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getCategoryId(): int
    {
        return $this->category_id;
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
