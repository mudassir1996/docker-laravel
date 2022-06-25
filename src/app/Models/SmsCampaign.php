<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmsCampaign extends Model
{
    use HasFactory;

    protected $fillable = [
        "campaign_title",
        "status",
        "schedule",
        "recepients",
        "sms_text",
        "outlet_id",
        "created_by"
    ];
}
