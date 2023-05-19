<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Ladmin\Models\Admin;

class Debt extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_id',
        'inbound_id',
        'client_id',
        'amount'
    ];

    public function admin(){
        return $this->belongsTo(Admin::class);
    }
}
