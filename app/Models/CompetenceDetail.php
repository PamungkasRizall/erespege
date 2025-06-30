<?php

namespace App\Models;

use App\Enums\CompetenceDetail as EnumCompetenceDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class CompetenceDetail extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'type' => EnumCompetenceDetail::class
    ];

    protected $with = [
        'children',
    ];

    public function competence(): BelongsTo
    {
        return $this->belongsTo(Competence::class);
    }

    // Children Relationship
    public function children()
    {
        return $this->hasMany(CompetenceDetail::class, 'parent_id');
    }
}
