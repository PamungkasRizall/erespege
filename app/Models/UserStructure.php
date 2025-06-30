<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserStructure extends Model
{
    protected $table = 'user_structure';
    protected $guarded = ['id'];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($userStructure) {
            $structure = Structure::find($userStructure->structure_id);

            if ($structure->is_unique) {
                $existing = UserStructure::where('structure_id', $structure->id)->whereNull('end_date')->exists();
                if ($existing) {
                    throw new \Exception("Posisi {$structure->name} sudah diisi oleh orang lain.");
                }
            }
        });
    }
}
