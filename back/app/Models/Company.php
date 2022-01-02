<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Company extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'user_detail_id',
        'current_postition',
        'hr_name',
        'company_name',
        'hr_email',
        'company_phone',
        'hr_phone',
        'company_email',
        'company_address',
        'company_website',
        'picture'
    ];
    
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function user_detail()
    {
        return $this->belongsTo(User_detail::class);
    }
}
