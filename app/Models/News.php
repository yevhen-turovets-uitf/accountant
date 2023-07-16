<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
    use HasFactory, SoftDeletes;

    public const ON_MAIN_PAGE = 6;
    public const DETAIL_ROUTE_NAME = 'news.show';

    protected $fillable = [
        'title',
        'slug',
        'description',
        'text',
    ];

    public function tags(): ?BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'news_tag');
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getCreatedDate(): Carbon
    {
        return $this->created_at;
    }

    public function getUpdatedDate(): ?Carbon
    {
        return $this->updated_at;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }
}
