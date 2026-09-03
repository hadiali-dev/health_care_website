<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Report extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'report_text',
    ];

    // A report belongs to a user (patient)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}