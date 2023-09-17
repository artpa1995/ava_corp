<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    public function country(){
        return $this->hasOne(Country::class,'id','country_id');
    }

    public function state(){
        return $this->hasOne(CountryState::class, 'id','state_id');
    }
    public function county(){
        return $this->hasOne(County::class, 'id','county_id');
    }

    public function addressRelation(){
        return $this->hasMany(AddressRelation::class, 'address_id', 'id');
    }

    public function addressProvider(){
        return $this->hasOne(AddressProvider::class, 'id', 'address_provider');
    }
}
