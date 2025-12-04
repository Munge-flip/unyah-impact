<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'agent_id',
        'game',
        'service_category',
        'service_type',
        'price',
        'status',
        'payment_method',
        'payment_status'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function agent()
    {
        return $this->belongsTo(User::class, 'agent_id');
    }
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
