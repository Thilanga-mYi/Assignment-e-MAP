<?php

namespace App\Http\Controllers;

use App\Models\Doctors;
use App\Models\PatientHasReports;
use App\Models\Patients;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PatientsController extends Controller
{

    public function index()
    {
        $patient_id = 'PID/' . str_pad((new Patients)->getPatientCount() + 1, 3, '0', STR_PAD_LEFT);
        $doctors_list = (new User)->getDoctors();
        return view('back_end.dashboard', compact('patient_id', 'doctors_list'));
    }

    public function savePatient(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'new_patient_name' => 'required',
            'new_patient_email' => 'required',
            'new_patient_doctor_id' => 'required|numeric|min:1',
            'new_patient_tel' => 'required|numeric|digits:10',
            'new_patient_lab_report' => 'mimes:jpeg,png,jpg|max:5000',
            'new_patient_xray_report' => 'mimes:jpeg,png,jpg|max:5000',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }

        $filestorelocation = public_path('/' . env('PATIENT_FILE_PATH'));

        $patient_data = [
            'patient_id' => 'PID/' . str_pad((new Patients)->getPatientCount() + 1, 3, '0', STR_PAD_LEFT),
            'name' => $request->new_patient_name,
            'email' => $request->new_patient_email,
            'tel' => $request->new_patient_tel,
            'doctor_id' => $request->new_patient_doctor_id,
            'description' => $request->new_patient_details,
            'status' => 1,
        ];

        $patient_obj = (new Patients)->add($patient_data);

        if ($request->hasFile('new_patient_lab_report')) {

            $patient_lab_image_url = $request->file('new_patient_lab_report');
            $filename = '1' . '-' . time() . $patient_lab_image_url->getClientOriginalName();
            $patient_lab_image_url->move($filestorelocation, $filename);

            $fileData = [
                'patient_id' =>  $patient_obj->id,
                'report_type_id' => 1,
                'img_url' => $filename,
                'status' => 1,
            ];

            $lab_file_data = (new PatientHasReports)->add($fileData);
        }

        if ($request->hasFile('new_patient_xray_report')) {

            $patient_xray_image_url = $request->file('new_patient_xray_report');
            $filename = '2' . '-' . time() . $patient_xray_image_url->getClientOriginalName();
            $patient_xray_image_url->move($filestorelocation, $filename);

            $fileData = [
                'patient_id' => $patient_obj->id,
                'report_type_id' => 2,
                'img_url' => $filename,
                'status' => 1,
            ];

            $xray_file_data = (new PatientHasReports)->add($fileData);
        }

        return response()->json([
            'code' => 1,
            'type' => 'success',
            'des' => 'Successfully saved',
            'refresh_status' => 1,
            'feild_reset_status' => 1,
        ]);
    }

    public function getALl()
    {
        $tableData = [];
        $records = (new Patients)->getAll();

        $index = 0;

        foreach ($records as $key => $value) {

            $check_lab_report = (new PatientHasReports)->getLABReport($value['id']);
            $check_xray_report = (new PatientHasReports)->getXRAYReport($value['id']);

            $value['status'] == 1 ? $status = '<span class="text-success">ACTIVE</span>' : $status = '<span class="text-danger">IN-ACTIVE</span>';

            $change_status_action = $value->status == 1 ?
                '<a onclick="change_patient_status_func(' . $value->id . ',2)" class="dropdown-item font-weight-400 small_font">' .
                '<i class="fa fa-ban pe-3" aria-hidden="true"></i>' .
                'Disable' .
                '</a>
            ' : '
                <a onclick="change_patient_status_func(' . $value->id . ',1)" class="dropdown-item font-weight-400 small_font">' .
                '<i class="fa fa-check pe-3" aria-hidden="true"></i>' .
                'Enable' .
                '</a>
            ';

            if (Auth::user()->user_type_id == 1) {
                $admin_actions = (empty($check_lab_report) ? '<a class="dropdown-item font-weight-400 small_font"><i>LAB Report not available</i></a>' : '<a class="dropdown-item font-weight-400 small_font" onclick="view_patient_lab_func_view(' . $value->id . ')">' .
                    '<i class="fa fa-eye pe-3" aria-hidden="true"></i>' .
                    'View LAB Report' .
                    '</a>')
                    .
                    (empty($check_xray_report) ? '<a class="dropdown-item font-weight-400 small_font"><i>X-RAY Report not available</i></a>' : '<a class="dropdown-item font-weight-400 small_font" onclick="view_patient_xray_func_view(' . $value->id . ')">' .
                        '<i class="fa fa-eye pe-3" aria-hidden="true"></i>' .
                        'View X-RAY Report' .
                        '</a>') . $change_status_action;
            } elseif (Auth::user()->user_type_id == 2) {
                $admin_actions = empty($check_lab_report) ? '<a class="dropdown-item font-weight-400 small_font"><i>LAB Report not available</i></a>' : '<a class="dropdown-item font-weight-400 small_font" onclick="view_patient_lab_func_view(' . $value->id . ')">' .
                    '<i class="fa fa-eye pe-3" aria-hidden="true"></i>' .
                    'View LAB Report' .
                    '</a>';
            } elseif (Auth::user()->user_type_id == 3) {
                $admin_actions = empty($check_xray_report) ? '<a class="dropdown-item font-weight-400 small_font"><i>X-RAY Report not available</i></a>' : '<a class="dropdown-item font-weight-400 small_font" onclick="view_patient_xray_func_view(' . $value->id . ')">' .
                    '<i class="fa fa-eye pe-3" aria-hidden="true"></i>' .
                    'View X-RAY Report' .
                    '</a>';
            } elseif (Auth::user()->user_type_id == 4) {
                $admin_actions =  (empty($check_lab_report) ? '<a class="dropdown-item font-weight-400 small_font"><i>LAB Report not available</i></a>' : '<a class="dropdown-item font-weight-400 small_font" onclick="view_patient_lab_func_view(' . $value->id . ')">' .
                    '<i class="fa fa-eye pe-3" aria-hidden="true"></i>' .
                    'View LAB Report' .
                    '</a>')
                    .
                    (empty($check_xray_report) ? '<a class="dropdown-item font-weight-400 small_font"><i>X-RAY Report not available</i></a>' : '<a class="dropdown-item font-weight-400 small_font" onclick="view_patient_xray_func_view(' . $value->id . ')">' .
                        '<i class="fa fa-eye pe-3" aria-hidden="true"></i>' .
                        'View X-RAY Report' .
                        '</a>');
            } else {
                $admin_actions = '';
            }

            $actions = '<div class="mt-md-0 mt-2">' .
                '<a href="#" data-bs-toggle="dropdown"class="btn btn-sm btn-default text-decoration-none">' .
                '<i class="fa fa-bars" aria-hidden="true"></i></a><div class="dropdown-menu bg-white rounded-0">' . $admin_actions . '</div></div>';

            $isRender = false;

            if (Auth::user()->user_type_id == 1) {
                $isRender = true;
            } elseif (Auth::user()->user_type_id == 2 && !empty($check_lab_report)) {
                $isRender = true;
            } elseif (Auth::user()->user_type_id == 3 && !empty($check_xray_report)) {
                $isRender = true;
            } elseif ($value['doctor_id'] == Auth::user()->id) {
                $isRender = true;
            }

            if ($isRender) {
                $tableData[] = [
                    ++$index,
                    $actions,
                    $value['patient_id'],
                    $value['name'],
                    $value['email'],
                    $value['tel'],
                    User::find($value['doctor_id'])->name,
                    $value['description'] == Null ? '-' : $value['description'],
                    $status,
                ];
            }
        }

        return $tableData;
    }

    public function changeStatus(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }

        (new Patients)->edit('id', $request->id, ['status' => $request->status]);

        return response()->json([
            'code' => 1,
            'type' => 'Success',
            'des' => 'Successfully saved',
            'refresh_status' => 1,
            'feild_reset_status' => 1,
        ]);
    }

    public function viewLABReport(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }

        $lab_report_obj = (new PatientHasReports)->getLABReport($request->id);

        return response()->json([
            'code' => 1,
            'type' => 'success',
            'des' => '',
            'data' => $lab_report_obj,
            'refresh_status' => 1,
            'feild_reset_status' => 1,
        ]);
    }

    public function viewXRAYReport(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }

        $xray_report_obj = (new PatientHasReports)->getXRAYReport($request->id);

        return response()->json([
            'code' => 1,
            'type' => 'success',
            'des' => '',
            'data' => $xray_report_obj,
            'refresh_status' => 1,
            'feild_reset_status' => 1,
        ]);
    }

    public function getPatientDetailsById(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'patient_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }

        $patient_obj = (new Patients)->getPatientDetailsByPatientId($request->patient_id);
        
        if (!empty($patient_obj)) {
            $lab_report_obj = (new PatientHasReports)->getLABReport($patient_obj->id);
            $xray_report_obj = (new PatientHasReports)->getXRAYReport($patient_obj->id);

            $data = [
                'patient_name' => $patient_obj->name,
                'doctor_name' => User::find($patient_obj->doctor_id)->name,
                'lab_report' => empty($lab_report_obj) ? '' : $lab_report_obj->img_url,
                'xray_report' => empty($xray_report_obj) ? '' : $xray_report_obj->img_url,
            ];
            return response()->json([
                'code' => 1,
                'type' => 'success',
                'des' => '',
                'data' => $data,
                'refresh_status' => 1,
                'feild_reset_status' => 1,
            ]);
        }

        return response()->json([
            'code' => 2,
            'type' => 'error',
            'des' => 'Unable to found any Patient belongs to inserted ID',
            'refresh_status' => 1,
            'feild_reset_status' => 1,
        ]);
    }
}
