<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    public function accountTypes(){
        return $this->hasOne(CompanyType::class, 'id', 'account_type_id');
    }

    public function industriesTypes(){
        return $this->hasOne(IndustriesType::class, 'id', 'industry_id');
    }

    public function parentAccount(){
        return $this->hasOne(Account::class, 'id', 'parent_id');
    }

    public function ownerUser(){
        return $this->hasOne(User::class, 'id', 'owner_id');
    }

    public function contacts(){
        return $this->hasMany(Contact::class, 'account_id');
    }
    public function companyFiles(){
        return $this->hasMany(CompanyFile::class, 'account_id', 'id');
    }
    public function country(){
        return $this->hasOne(Country::class, 'id', 'country_id');
    }

    public function salesPerodical(){
        return $this->hasOne(Sales::class, 'account_id', 'id')->where('periodical_one_off', '=', '1');
    }

}
