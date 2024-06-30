<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\Notification;

class Product extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'products';

    protected $fillable = [
        'article',
        'name',
        'status',
        'data'
    ];

    public function scopeAvailable($query)
    {
        return $query->where('status', 'available');
    }

    public function routeNotificationForMail(Notification $notification): string
    {
        return config('products.email');
    }
}
