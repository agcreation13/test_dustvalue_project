<?php
// app/Models/Tenant.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tenant extends Model
{
    protected $fillable = ['name', 'domain', 'database_name'];

    // Relationship with employees
    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }
}