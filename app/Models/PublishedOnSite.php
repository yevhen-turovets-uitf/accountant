<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublishedOnSite extends Model
{
    use HasFactory;

    public const ON_MAIN_PAGE = 5;

    protected $table = 'published_on_site';
    protected $fillable = [
        'date',
        'title',
        'url',
    ];

    public function getId(): int
    {
        return $this->id;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getUrl(): string
    {
        return $this->url;
    }
}
