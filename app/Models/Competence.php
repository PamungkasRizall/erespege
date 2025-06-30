<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;

class Competence extends Model
{
    use HasFactory, SoftDeletes;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime'
    ];

    protected $with = [
        'details',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {

            do{

                $uuid = Uuid::uuid4();

                $uuid_exist = self::where('id', $uuid)->exists();

            } while ($uuid_exist);

            $model->id = $uuid;
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

    public function details(): HasMany
    {
        return $this->hasMany(CompetenceDetail::class)->whereNull('parent_id');
    }

    public function choices(): HasMany
    {
        return $this->hasMany(Choice::class);
    }

    public function functionalPosition(): BelongsTo
    {
        return $this->belongsTo(FunctionalPosition::class);
    }
}
