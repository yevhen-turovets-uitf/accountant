<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class NormCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'category_id',
    ];

    public function childrenElements(): ?HasMany
    {
        return $this->hasMany(Norm::class, 'category_id', 'id');
    }

    public function categories(): ?HasMany
    {
        return $this->hasMany(NormCategory::class, 'category_id');
    }

    public function childrenCategories(): ?HasMany
    {
        return $this->hasMany(NormCategory::class)->with('categories');
    }

    public function parentCategory()
    {
        return $this->belongsTo(NormCategory::class, 'category_id');
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function getParentId(): ?int
    {
        return $this->category_id;
    }

    public function getUpdateAt(): ?Carbon
    {
        return $this->updated_at;
    }

    public function getCreatedAt(): ?Carbon
    {
        return $this->created_at;
    }

    public function getDeletedAt(): ?Carbon
    {
        return $this->deleted_at;
    }
}
