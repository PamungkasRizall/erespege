<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompetenceAnswer extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relationships
    public function competenceDetail()
    {
        return $this->belongsTo(CompetenceDetail::class);
    }

    public function choice()
    {
        return $this->belongsTo(Choice::class);
    }

    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

    public function assesor()
    {
        return $this->belongsTo(User::class, 'assesor_id');
    }

    public function assessor_choice()
    {
        return $this->belongsTo(Choice::class, 'ass_choice_id');
    }
}
