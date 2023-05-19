<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Ladmin\Models\Admin;

class Inbounds extends Model
{

    protected $casts = [
        'access' => 'json'
    ];

    public function admin(){
        return $this->belongsTo(Admin::class);
    }

    use HasFactory;
}
