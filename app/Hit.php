<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hit extends Model
{
    protected $fillable = [
        'route_id', 'request_ip', 'response_code'
    ];
}
