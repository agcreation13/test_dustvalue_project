<?php

// app/Models/Employee.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Employee extends Model
{
    protected $fillable = [
        'name',
        'email',
        'position',
        'salary',
        'department',
        'joining_date',
        'tenant_id',
    ];

    // Relationship with Tenant
    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }
}