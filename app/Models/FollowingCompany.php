<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class FollowingCompany extends Model
{
    use HasFactory;

    public function contact(){
        return $this->hasOne(Contact::class,'id', 'contact_id');
    }

    public function company(){
        return $this->hasOne(Company::class,'id', 'company_id')->with('parentAccount:id,name')->with('state')->with('country');
    }
}
