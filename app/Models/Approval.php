<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Approval extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    public const MEDIA_COLLECTION = 'approval';
    public const ALLOWED_EXTENSIONS = ['pdf', 'png', 'jpg', 'jpeg'];

    public $timestamps = false;
    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public static function boot() {
        parent::boot();
        static::creating(function ($model) {

            $model->created_at = Carbon::now();
            $model->created_by = Auth::id();
        });
    }

    public function approvalable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by')->select('id', 'name', 'nip');
    }
}
