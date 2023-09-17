<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    use HasFactory;

    public function services(){
        return $this->hasOne(Services::class, 'id', 'service_id');
    }

    public function company(){
        return $this->hasOne(Company::class, 'id', 'company_id')->with('parentAccount:id,name');
    }

    public function account(){
        return $this->hasOne(Account::class, 'id', 'account_id');
    }
}
