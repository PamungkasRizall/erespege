<?php

namespace App\Models;

use App\Enums\Committee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class Profession extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
        'committee' => Committee::class
    ];

    protected $with = [
        'assesors',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {

            $model->created_by = Auth::id();
        });

        static::deleting(function ($model) {
            if (Auth::check()) {
                $model->deleted_by = Auth::id();
                $model->saveQuietly(); // Prevent infinite loops
            }
        });

        static::updating(function ($model) {
            if (Auth::check()) {
                $model->updated_by = Auth::id();
            }
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function functionalPosition(): HasMany
    {
        return $this->hasMany(FunctionalPosition::class);
    }

    public function assesors()
    {
        return $this->belongsToMany(User::class, 'profession_assesor', 'profession_id', 'assesor_id');
    }
}
