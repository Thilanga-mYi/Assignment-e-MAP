<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patients extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'name',
        'email',
        'tel',
        'doctor_id',
        'description',
        'status'
    ];

    public function getPatientCount()
    {
        return $this::count();
    }

    public function add($data)
    {
        return $this->create($data);
    }

    public function edit($key, $term, $data)
    {
        return $this->where($key, $term)->update($data);
    }

    public function getAll()
    {
        return $this->orderBy('created_at', 'DESC')->get();
    }

    public function getPatientDetailsByPatientId($patient_id)
    {
        return $this->where('patient_id', $patient_id)->first();
    }
}
