<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Claim extends Model
{
  protected $fillable = [
    'claim_code','hr_user_id',
    'employee_surname','employee_given','employee_middle','employee_dob','civil_status',
    'employment_status','claim_type','benefit','occurrence',
    'dependent_name','dependent_relationship','dependent_dob',
    'room_date','time_in','time_out','amount_per_receipt',
    'status','approved_at',
    'total_amount','recomputed_total',
    'is_recomputed','recomputation_reason','recomputation_remarks',
    'assessment','remarks',
  ];

  protected $casts = [
    'employee_dob' => 'date',
    'dependent_dob' => 'date',
    'room_date' => 'date',
    'approved_at' => 'date',
    'is_recomputed' => 'boolean',
  ];

  public function receipts(){ return $this->hasMany(ClaimReceipt::class); }
  public function attachments(){ return $this->hasMany(ClaimAttachment::class); }
  public function hrUser(){ return $this->belongsTo(User::class, 'hr_user_id'); }

  public function getEmployeeFullNameAttribute(): string {
    return trim($this->employee_given.' '.$this->employee_middle.' '.$this->employee_surname);
  }
}
