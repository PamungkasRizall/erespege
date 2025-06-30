<?php

namespace App\Models;

use App\Enums\Committee;
use App\Services\UserService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Str;

class CompetenceBA extends Model
{
    use HasFactory;

    protected $table = 'competence_bas';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $guarded = ['id'];

    protected $casts = [
        'date_at' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'filings' => 'json',
        'committee' => Committee::class,
    ];

    protected static function booted(): void
    {
        static::creating(function ($model) {

            do{

                $uuid = Uuid::uuid4();
                $uuid_exist = self::where('id', $uuid)->exists();

            } while ($uuid_exist);

            $model->id = $uuid;
            $model->assesor_id = Auth::id();
            $model->profession_id = (new UserService)->userProfessionId();

            $number = self::getNextNumber($model->date_at);
            $userCommittee = (new UserService)->userCommittee();

            $model->number = $number;
            $model->committee = $userCommittee;
            $model->code = sprintf(
                '%s/KREDENSIAL/BA/%s/%s/%s',
                $userCommittee->numbering(),
                Str::padLeft($number, 2, 0),
                $model->date_at->format('m'),
                $model->date_at->format('Y'),
            );
        });
    }

    protected static function getNextNumber(Carbon $date_at): int
    {
        return self::whereYear('date_at', $date_at->format('Y'))
            ->whereMonth('date_at', $date_at->format('m'))
            ->max('number') + 1;
    }

    // Relationships
    public function assesor()
    {
        return $this->belongsTo(User::class, 'assesor_id');
    }

    public function subCommittee()
    {
        return $this->belongsTo(User::class, 'sub_committee_id');
    }

    public function profession()
    {
        return $this->belongsTo(Profession::class, 'profession_id');
    }

    public function approvals(): MorphMany
    {
        return $this->morphMany(Approval::class, 'approvalable')->with('user');
    }
}
