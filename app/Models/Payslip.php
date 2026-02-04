<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payslip extends Model
{
    protected $fillable = [
        'folder_key',
        'year',
        'month',
        'batch_name',
        'original_name',
        'stored_name',
        'file_path',
        'file_size',
        'mime_type',
        'uploaded_by',
    ];

    protected $casts = [
        'year' => 'integer',
        'month' => 'integer',
        'file_size' => 'integer',
    ];

    public function uploader(): BelongsTo
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    public function getFolderLabelAttribute(): string
    {
        $m = str_pad((string)$this->month, 2, '0', STR_PAD_LEFT);
        return "{$this->year}-{$m}";
    }
}
