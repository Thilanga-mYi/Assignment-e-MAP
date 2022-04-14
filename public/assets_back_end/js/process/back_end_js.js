Notiflix.Loading.Init({
    svgColor: "#64dd17",
    fontFamily: "Quicksand",
    useGoogleFont: true,
});

Notiflix.Confirm.Init({
    titleColor: '#212121',
    okButtonColor: '#f8f8f8',
    okButtonBackground: '#64dd17',
    cancelButtonColor: '#f8f8f8',
    cancelButtonBackground: '#a9a9a9',
    width: '300px',
    useGoogleFont: true,
    fontFamily: 'Quicksand',
});

$.ajaxSetup({
    beforeSend() {
        Notiflix.Loading.Pulse();
    },
    complete(status) {
        Notiflix.Loading.Remove();
    }
});

var baseUrl = window.location.origin;
var new_patient_form = $("#new_patient_form");
var new_patient_modal = $("#new_patient_modal");
var patient_lab_report_modal = $('#patient_lab_report_modal');
var patient_report_img_url = $('#patient_report_img_url');

new_patient_form.on('submit', function (e) {
    e.preventDefault();

    Notiflix.Confirm.Show('Need Confirmation to Save', 'Please confirm to save this patient?', 'Confirm', 'Ignore', function () {

        var formData = new FormData(new_patient_form[0]);

        $.ajax({
            url: "/admin/patient/db/save",
            method: "POST",
            data: formData,
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                Notiflix.Loading.Pulse();
            },
            success: function (response) {
                Notiflix.Loading.Remove();

                if ($.isEmptyObject(response.error)) {
                    if (response['type'] == 'error') {
                        Notiflix.Notify.Failure(response['des']);
                    } else if (response['type'] == 'success') {

                        Notiflix.Notify.Success(response['des']);
                        patient_list.ajax.reload(null, false);
                        new_patient_modal.modal('hide');
                        new_patient_form.trigger("reset");

                    }
                } else {
                    $.each(response.error, function (key, value) {
                        Notiflix.Notify.Failure(value);
                    });
                }
            }
        });

    }, function () { });
});

var patient_list = $('#patient_list').DataTable({
    dom: "<'row mb-3'<'col-sm-4'l><'col-sm-8 text-end'<'d-flex justify-content-end'fB>>>t<'d-flex align-items-center'<'me-auto'i><'mb-0'p>>",
    lengthMenu: [10, 20, 30, 40, 50],
    responsive: true,
    pageLength: 20,
    buttons: [{
        extend: 'print',
        className: 'btn btn-default'
    },
    {
        extend: 'csv',
        className: 'btn btn-default'
    }
    ],
    ajax: {
        url: '/admin/patient/GET_ALL',
        dataSrc: ''
    },
    createdRow: function (row, data, dataIndex, cells) {
        $(cells).addClass('py-1 align-middle');
    }
});

function change_patient_status_func(id, status) {

    $.ajax({
        type: "GET",
        url: "/admin/patient/CHANGE_STATUS",
        data: {
            id: id,
            status: status
        },
        success: function (response) {
            Notiflix.Notify.Success('Status Changed');

            patient_list.ajax.reload(null, false);

        }
    });
}

function view_patient_lab_func_view(id) {

    $.ajax({
        type: "GET",
        url: "/admin/patient/VIEW_LAB_REPORT",
        data: {
            id: id
        },
        success: function (response) {

            patient_report_img_url.attr('src', baseUrl + '/assets_back_end/upload_img/' + response['data']['img_url'] + '');
            patient_lab_report_modal.modal('toggle');

        }
    });

}

function view_patient_xray_func_view(id) {

    $.ajax({
        type: "GET",
        url: "/admin/patient/VIEW_XRAY_REPORT",
        data: {
            id: id
        },
        success: function (response) {

            patient_report_img_url.attr('src', baseUrl + '/assets_back_end/upload_img/' + response['data']['img_url'] + '');
            patient_lab_report_modal.modal('toggle');

        }
    });

}
