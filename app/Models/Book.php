<?php

namespace App\Models;

use App\Events\BookCreatedEvent;
use App\Events\BookDeletedEvent;
use App\Events\BookUpdatedEvent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'image',
        'isbn',
        'value'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'isbn' => 'integer',
        'value' => 'integer'
    ];

    protected $dispatchesEvents = [
        'created' => BookCreatedEvent::class,
        'updated' => BookUpdatedEvent::class,
        'deleted' => BookDeletedEvent::class,
    ];
}
