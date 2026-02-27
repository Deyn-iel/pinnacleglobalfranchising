<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ClaimReceipt extends Model {
  protected $fillable = ['claim_id','category','description','amount'];
  public function claim(){ return $this->belongsTo(Claim::class); }
}
