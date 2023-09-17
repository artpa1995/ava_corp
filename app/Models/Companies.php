<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Companies extends Model
{
    use HasFactory;

    public function companyTypes()
    {
        return $this->hasOne(CompanyTypes::class, 'id', 'company_id');
    }

    public function industriesTypes()
    {
        return $this->hasOne(IndustriesTypes::class, 'id', 'industry_id');
    }

    public function parentCompany()
    {
        return $this->hasOne(Companies::class, 'id', 'parent_id');
    }

//    public function ow()
//    {
//        return $this->hasOne(Companies::class, 'id', 'parent_id');
//    }
}
