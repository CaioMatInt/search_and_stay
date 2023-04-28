<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClientRentedBook extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'bookstore_book_id',
        'client_id',
        'rented_at',
        'gave_back_at'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'rented_at' => 'datetime',
        'gave_back_at' => 'datetime'
    ];

    public function user()
    {
        return $this->morphOne(User::class, 'profile');
    }
}
