<?php

declare(strict_types=1);

namespace App\Models;

use App\Events\SubmissionSaved;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use HasFactory;

    protected $dispatchesEvents = [
        'saved' => SubmissionSaved::class,
    ];

    protected $fillable = [
        'name',
        'email',
        'message',
    ];
}
