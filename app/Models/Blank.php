<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blank extends Model
{
    use HasFactory, SoftDeletes;

    public const DETAIL_ROUTE_NAME = 'blanksDetail';

    protected $fillable = [
        'title',
        'slug',
        'category_id',
    ];

    public function category(): ?BelongsTo
    {
        return $this->belongsTo(BlankCategory::class, 'category_id', 'id');
    }

    public function redactions(): ?HasMany
    {
        return $this->hasMany(BlankRedaction::class);
    }

    public function lastRedaction(): ?BlankRedaction
    {
        return $this->redactions() ? $this->redactions()->orderByDesc('date')->first() : null;
    }

    public function tags(): ?BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'blank_tag');
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

    public function getDate(): string
    {
        return $this->date;
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
