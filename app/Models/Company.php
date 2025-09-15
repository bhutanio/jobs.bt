<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    protected $fillable = ['name', 'description', 'logo', 'verified_at'];

    public function jobPostings(): HasMany
    {
        return $this->hasMany(JobPosting::class);
    }
}
