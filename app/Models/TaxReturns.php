<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaxReturns extends Model
{
    use HasFactory;
    
    public function company(){
        return $this->hasOne(Company::class,'id', 'company_id');
    }
    public function companyWithAccount(){
        return $this->hasOne(Company::class,'id', 'company_id')->with('parentAccount:id,name');
    }

    public function pdfFile(){
        return $this->hasOne(TaxReturnPdf::class, 'tax_return_id', 'id');
    }
}
