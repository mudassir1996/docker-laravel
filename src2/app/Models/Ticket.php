<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'status',
        'featured_img',
        'outlet_id',
        'created_by',

    ];

    public function ticket_response()
    {
        return $this->hasMany(TicketResponse::class);
    }
}
