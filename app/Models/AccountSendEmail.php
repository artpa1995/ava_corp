<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountSendEmail extends Model
{
    use HasFactory;

    public function contacts(){
        return $this->hasOne(Contact::class,'id', 'contact_id');
    }
}
