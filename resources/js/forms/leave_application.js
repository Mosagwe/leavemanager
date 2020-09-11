$(function () {
    let leaveApplicationForm = $("#leaveApplicationForm");

    if (leaveApplicationForm.length > 0) {
        $.ajax({
            type: 'post',
            url: location.protocol + '//' + location.hostname + (location.port ? ':' + location.port : '') + "/dates/disabled",
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                leave_request_id: $("#leave_request_id").val(),
            },
            success: function (data) {
                // Adjust Date picker
                $('.date').datepicker({
                    autoclose: true,
                    format: "yyyy-mm-dd",
                    datesDisabled: data,
                    startDate: '+1d',
                    daysOfWeekDisabled: ['0', '6']
                }).on("changeDate", function () {
                    renderSummary();
                });

                renderSummary();
            }
        });

        $("#leave_type, #start_at, #days").change(function () {
            renderSummary();
        });
    }
});

function renderSummary() {
    if ($("#leave_type").val().length === 0) {
        $("#leaveSummary").hide();

        return false;
    }

    let selectedOption = $("#leave_type option:selected");
    let leaveType = selectedOption.text();
    let balance = selectedOption.data('balance');

    let daysInput = $("#days")
    daysInput.rules("add", {min: 1, max: balance});

    let result = '<div class="card">' +
        '                <div class="card-body">' +
        '                    <h5 class="card-title">Summary</h5>' +
        '                    <table id="summaryTable" class="table">' +
        '                        <tr>' +
        '                            <th>Leave Type</th>' +
        '                            <td>' + leaveType + '</td>' +
        '                        </tr>' +
        '                        <tr>' +
        '                            <th>Current Balance</th>' +
        '                            <td>' + balance + '</td>' +
        '                        </tr>' +
        '                     </table>' +
        '                     <table id="summaryDatesTable" class="table m-0">' +
        '                     </table>' +
        '                 </div>' +
        '         </div>'

    $("#leaveSummary").html(result).show();

    let days = daysInput.val();

    let startDate = $("#start_at").val();

    if (days.length !== 0 && startDate.length !== 0) {
        $.ajax({
            type: 'post',
            url: location.protocol + '//' + location.hostname + (location.port ? ':' + location.port : '') + "/applications/get-dates",
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                leaveType: $("#leave_type").val(),
                startDate: startDate,
                days: days
            },
            success: function (data) {
                $("#summaryDatesTable").html('<tr>' +
                    '<th>Start Date</th>' +
                    '               <td>' + startDate + '</td>' +
                    '         </tr>' +
                    '<tr>' +
                    '<th>Applied Days</th>' +
                    '               <td>' + days + '</td>' +
                    '         </tr>' +
                    '         <tr>' +
                    '               <th>End Date</th>' +
                    '               <td>' + data.endDate + '</td>' +
                    '         </tr>' +
                    '         <tr>' +
                    '               <th>Reporting Date</th>' +
                    '               <td>' + data.returnDate + '</td>' +
                    '         </tr>');

                $("#calendar").datepicker('destroy').datepicker({
                    format: "yyyy-mm-dd",
                    startDate: startDate,
                    endDate: data.endDate
                }).show();
            }
        });
    }
}
