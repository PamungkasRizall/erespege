<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Ramsey\Uuid\Uuid;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, HasRoles, Notifiable, SoftDeletes;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $guarded = ['id'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'updated_at' => 'datetime',
        'created_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

	protected static function booted(): void
    {
        static::creating(function ($model) {

            do{

                $uuid = Uuid::uuid4();

                $uuid_exist = self::where('id', $uuid)->exists();

            } while ($uuid_exist);

            $model->id = $uuid;
        });
    }

    public function getFullNameAttribute()
    {
        return trim(sprintf('%s %s %s', $this->profile?->doctoral_degree, $this->name, $this->profile?->academic_degree));
    }

    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class);//->chaperone('functionalPosition');
    }

    public function professions(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'profession_assesor', 'assesor_id', 'profession_id');
    }

    public function structures(): BelongsToMany
    {
        return $this->belongsToMany(Structure::class, 'user_structure')
                    ->withPivot('start_date', 'end_date')
                    ->withTimestamps();
    }

    public function positions(): BelongsToMany
    {
        return $this->structures()->orderByDesc('is_main');
    }
}
