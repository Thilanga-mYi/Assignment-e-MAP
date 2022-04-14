<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientHasReports extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'report_type_id',
        'img_url',
        'status'
    ];

    public function add($data)
    {
        return $this->create($data);
    }

    public function edit($key, $term, $data)
    {
        return $this->where($key, $term)->update($data);
    }

    public function getLABReport($id)
    {
        return $this->where('patient_id', $id)
            ->where('report_type_id', 1)
            ->first();
    }

    public function getXRAYReport($id)
    {
        return $this->where('patient_id', $id)
            ->where('report_type_id', 2)
            ->first();
    }


    public function getPatientDetailsById($patient_id)
    {
        return $this->where('patient_id', $patient_id)->first();
    }
}
