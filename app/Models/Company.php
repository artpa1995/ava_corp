<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    public function contacts(){
        return $this->hasOne(Contact::class,'id', 'contact_id');
    }

    public function country(){
        return $this->hasOne(Country::class,'id','country_id');
    }

    public function state(){
        return $this->hasOne(CountryState::class, 'id','state_id');
    }

    public function parentAccount(){
        return $this->hasOne(Account::class, 'id', 'account_id');
    }

    public function companyTypes(){
        return $this->hasOne(TypeOfCompaneis::class, 'id', 'company_id');
    }

    public function companyFiles(){
        return $this->hasMany(CompanyFile::class, 'company_id', 'id');
    }

    public function companyFiles1(){
        return $this->hasMany(CompanyFile::class, 'company_id', 'id')->where('file_type', '=', 'file_path_1');
    }

    public function taxReturns(){
        return $this->hasMany(TaxReturns::class, 'company_id', 'id');
    }

    public function pdf_fils(){
        return $this->hasMany(TaxReturnPdf::class, 'company_id', 'id');
    }

    public function salesPerodical(){
        return $this->hasOne(Sales::class, 'company_id', 'id')->where('periodical_one_off', '=', '1');
    }

}
