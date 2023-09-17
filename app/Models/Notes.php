<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notes extends Model
{
    use HasFactory;


    public function contacts(){
        return $this->hasOne(Contact::class,'id', 'contact_id');
    }

    public function account(){
        return $this->hasOne(Account::class,'id', 'account_id');
    }

    public function company() {
        return $this->hasOne(Company::class,'id', 'company_id');
    }
    
    public function user(){
        return $this->hasOne(User::class,'id', 'user_id');
    }
}
