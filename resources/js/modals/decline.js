$(function(){
    $('#declineModal').on('show.bs.modal', function (e) {
        let target = $(e.relatedTarget);
        $("#leaveRequestId").val(target.data('id'));
    })
})
