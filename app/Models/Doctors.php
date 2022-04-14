<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctors extends Model
{
    use HasFactory;

    public function getActiveDoctors()
    {
        return $this->where('status', 1)->orderBy('name', 'ASC')->get();
    }
}
