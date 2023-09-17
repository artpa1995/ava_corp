<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyOrganization extends Model
{
    use HasFactory;

    public function companyTypes()
    {
        return $this->hasOne(CompanyType::class, 'id', 'company_id');
    }

    public function industriesTypes()
    {
        return $this->hasOne(IndustriesType::class, 'id', 'industry_id');
    }

    public function parentCompany()
    {
        return $this->hasOne(CompanyOrganization::class, 'id', 'parent_id');
    }

    public function ownerUser()
    {
        return $this->hasOne(User::class, 'id', 'owner_id');
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class, 'company_id');
    }
}
