<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddressRelation extends Model
{
    use HasFactory;

    public function addresses(){
        return $this->hasOne(Address::class, 'id','address_id')->with('state')->with('country')->with('county');
    }

}
