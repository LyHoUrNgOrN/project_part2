<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $fillable=['current_postition','hr_name','company_name','hr_email','company_phone','hr_phone','company_email','company_address','company_website'];
}
