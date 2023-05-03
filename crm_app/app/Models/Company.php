<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'phone','email'];
    public $timestamps = false;
    public function contacts(): HasMany
    {
        return $this->hasMany(Contact::class);
    }
}
