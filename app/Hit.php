<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hit extends Model
{
    protected $fillable = [
        'path', 'method', 'query_params', 'request_ip', 'response_code'
    ];
}
