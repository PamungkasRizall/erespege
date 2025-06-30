<?php

namespace App\Models;

use App\Enums\FilingOrigin;
use App\Enums\FilingStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Filing extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    public const MEDIA_COLLECTION = 'filing';
    public const ALLOWED_EXTENSIONS = ['pdf'];
    public const ACTIVE_PERIOD = 3; //years
    public const ASSESSMENT_PERIOD = 90; //days/30
    public const KREDENSIAL = 'Kredensial';
    public const NO_CLINICAL_PRIVILEGES = 'DM.01.01/XXXIV.1/GANTI-NOMOR-INI/YEAR';
    public const NUMBER_REQ_DOCUMENT = 8;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $guarded = ['id'];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'recomendation_at' => 'date',
        'cp_at' => 'date',
        'cp_created_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'end_at' => 'datetime',
        'status' => FilingStatus::class,
        'origin' => FilingOrigin::class
    ];

    protected $hidden = [
        'media'
    ];

    protected $appends = [
        'hyperlink'
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
            $model->user_id = Auth::id();
        });
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(self::MEDIA_COLLECTION)
            ->singleFile()
            ->acceptsMimeTypes(['application/pdf']);
    }

    public function getHyperlinkAttribute()
    {
        return $this->getFirstMediaUrl(self::MEDIA_COLLECTION);
    }

    public static function scopeStatus($query, FilingStatus $status)
    {
        return $query->where('filings.status', $status->value);
    }

    public static function scopeMine($query)
    {
        return $query->whereUserId(Auth::id());
    }

    // Relationships
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);//->chaperone('profile');
    }

    public function competence()
    {
        return $this->belongsTo(Competence::class);
    }

    public function answers(): HasMany
    {
        return $this->hasMany(CompetenceAnswer::class);
    }

    public function assessor(): HasOne
    {
        return $this->hasOne(CompetenceAnswer::class);
    }

    public function approvals(): MorphMany
    {
        return $this->morphMany(Approval::class, 'approvalable')->with('user');
    }

    public function documents(): HasMany //for approval
    {
        return $this->hasMany(Filing::class, 'user_id', 'user_id')->where('origin', FilingOrigin::MANUAL);
    }

    public function reCredential(): HasOne
    {
        return $this->hasOne(Filing::class, 'user_id', 'user_id')->where('name', self::KREDENSIAL);
    }
}
