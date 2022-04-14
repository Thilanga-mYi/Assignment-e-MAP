@extends('back_end.layout.app')
@section('content')
    <div id="content" class="app-content">
        <div class="d-flex align-items-center mb-3">
            <div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin"
                            class="small_font font-weight-400  theme_font_color">Dashboard </a></li>
                    <li class="breadcrumb-item active small_font font-weight-400">Patient Registration</li>
                </ul>
            </div>
        </div>

        <div class="row">

            <div class="col-xl-12">

                <div class="card mb-3 rounded-0">

                    <div class="card-header d-flex align-items-center rounded-0">
                        <span class="flex-grow-1 font-weight-600">
                            <i class="fa fa-folder-open pe-2" aria-hidden="true"></i>
                            Registered Patients Directory
                        </span>
                        <a href="#" class="text-muted text-decoration-none fs-12px">
                            <i class="fa fa-fw fa-redo"></i>
                        </a>
                    </div>

                    <div class="px-3 py-3 d-flex align-items-center">
                        <span class="flex-grow-1">
                            Please use the table below to navigate or filter the results. You can download the table as
                            excel and pdf.
                        </span>
                        @if (Auth::user()->user_type_id == 1)
                            <a id="new_patient_modal_link" class="btn btn-default btn-sm" data-bs-toggle="modal"
                                data-bs-target="#new_patient_modal">
                                <i class="fa fa-plus fa-fw"></i>
                                New
                            </a>
                        @endif
                    </div>

                    <div class="list-group list-group-flush p-3">

                        <div id="datatable">

                            <table id="patient_list" class="table text-nowrap w-100">
                                <thead class="display-heading">
                                    <tr>
                                        <th>#</th>
                                        <th>Actions</th>
                                        <th>Patient ID</th>
                                        <th>Patient Name</th>
                                        <th>Email</th>
                                        <th>Tel</th>
                                        <th>Doctor</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>

                                <tbody></tbody>

                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="modal fade" id="new_patient_modal">
        <div class="modal-dialog modal-md">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Patient Registration</h5>
                    <button id="new_patient_modal_close_btn" type="button" class="btn-close"
                        data-bs-dismiss="modal"></button>
                </div>

                <form method="POST" id="new_patient_form">
                    @csrf

                    <div class="modal-body">

                        <div class="form-group mb-3">
                            <label class="form-label small_font" for="new_patient_id">Patient ID
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" id="new_patient_id" name="new_patient_id"
                                value="{{ $patient_id }}" disabled />
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label small_font" for="new_patient_doctor_id">Select Doctor
                                <span class="text-danger">*</span>
                            </label>
                            <select name="new_patient_doctor_id" id="new_patient_doctor_id" class="form-select">
                                <option value="0">Select a Doctor</option>
                                @foreach ($doctors_list as $doctor)
                                    <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="form-group mb-3">
                            <label class="form-label small_font" for="new_patient_name">Patient Name
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" id="new_patient_name" name="new_patient_name" />
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label small_font" for="new_patient_email">Email
                                <span class="text-danger">*</span>
                            </label>
                            <input type="email" class="form-control" id="new_patient_email" name="new_patient_email" />
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label small_font" for="new_patient_tel">Telephone (Primary)
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" id="new_patient_tel" name="new_patient_tel" />
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label small_font" for="new_patient_lab_report">LAB Report
                                <span class="text-danger">*</span>
                            </label>
                            <input type="file" class="form-control" id="new_patient_lab_report"
                                name="new_patient_lab_report" />
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label small_font" for="new_patient_xray_report">X-RAY Report
                                <span class="text-danger">*</span>
                            </label>
                            <input type="file" class="form-control" id="new_patient_xray_report"
                                name="new_patient_xray_report" />
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label small_font" for="new_patient_details">Bank Details
                                <span class="text-danger">*</span>
                            </label>
                            <textarea id="new_patient_details" name="new_patient_details" class="form-control" rows="3"></textarea>
                        </div>

                    </div>

                    <div class="card-footer">
                        <div class="d-flex flex-row-reverse">
                            <button id="new_patient_save_btn" class="btn btn-primary ">
                                <i class="fa fa-floppy-o" aria-hidden="true"></i>
                                Save
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="patient_lab_report_modal">
        <div class="modal-dialog modal-md">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Patient LAB Report</h5>
                    <button id="new_patient_modal_close_btn" type="button" class="btn-close"
                        data-bs-dismiss="modal"></button>
                </div>

                <img id="patient_report_img_url"
                    src="https://1000logos.net/wp-content/uploads/2020/05/Google-Photos-logo.jpg" class="w-100">

            </div>
        </div>
    </div>
@endsection
