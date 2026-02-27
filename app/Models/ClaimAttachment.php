<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ClaimAttachment extends Model {
  protected $fillable = ['claim_id','label','path','original'];
  public function claim(){ return $this->belongsTo(Claim::class); }
}
