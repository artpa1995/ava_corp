<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    public function ownerUser(){
        return $this->hasOne(User::class, 'id', 'owner_id');
    }

    public function parentAccount(){
        return $this->hasOne(Account::class, 'id', 'account_id');
    }

    public function reportsTo(){
        return $this->hasOne(Contact::class, 'id', 'reports');
    }

    public function mailingAddress(){
        return $this->hasOne(User::class, 'id', 'mailing_address');
    }


}
