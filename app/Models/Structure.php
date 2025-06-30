<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Structure extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    public function parent()
    {
        return $this->belongsTo(Structure::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Structure::class, 'parent_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_structure')
                    ->withPivot('start_date', 'end_date')
                    ->withTimestamps();
    }
}
