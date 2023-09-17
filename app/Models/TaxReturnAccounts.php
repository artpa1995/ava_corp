<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaxReturnAccounts extends Model
{
    use HasFactory;

    public function pdfFile(){
        return $this->hasOne(TaxReturnPdfAccounts::class, 'tax_return_id', 'id');
    }
    public function account(){
        return $this->hasOne(Account::class,'id', 'account_id');
    }
}
