<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Choice extends Model
{
    use HasFactory;

    public const NUMBER_OF_CHOICES_PER_QUESTION = 4;
    public const DEFAULT_CHOICES = [
        [
            'name' => 'Kompeten Sepenuhnya',
            'score' => 0
        ],
        [
            'name' => 'Memerlukan Supervisi',
            'score' => 0
        ],
        [
            'name' => 'Tidak Dimintakan Kewenangannya Karena diluar Kompetensinya',
            'score' => 0
        ],
        [
            'name' => 'Tidak Dimintakan Kewenangannya Karena Fasilitas Tidak Tersedia',
            'score' => 0
        ],
    ];

    public $timestamps = false;

    protected $guarded = ['id'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {

            if (!$model->sequence) {
                $maxSequence = static::where('competence_id', $model->competence_id)->max('sequence');
                $model->sequence = $maxSequence ? $maxSequence + 1 : 1;
            }
        });
    }

    public function functionalPosition()
    {
        return $this->belongsTo(FunctionalPosition::class);
    }
}
