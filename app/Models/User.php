<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Laravel\Sanctum\HasApiTokens;

class User extends \TCG\Voyager\Models\User
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'date_to',
        'date_from',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'date_from' => 'datetime',
        'date_to' => 'datetime',
    ];

    public function getId(): int
    {
        return $this->id;
    }

    public function getDateFrom(): ?Carbon
    {
        return $this->date_from;
    }

    public function getDateTo(): ?Carbon
    {
        return $this->date_to;
    }

    public function isActiveStatus(): bool
    {
        return Carbon::now()->between($this->getDateFrom(), $this->getDateTo());
    }

    public function favorites(): ?HasMany
    {
        return $this->hasMany(Favorite::class);
    }

    public function calendarReports(): BelongsToMany
    {
        return $this->belongsToMany(CalendarReport::Class);
    }
}
