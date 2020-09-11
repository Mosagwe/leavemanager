$(function () {
// Ask the user if they really want to delete the record
    $('.table').on('click', '[data-action="delete"]', function (e) {
        e.preventDefault();

        let form = $(this).data('form');

        Swal.fire({
            title: 'Are you sure?',
            text: "Once deleted, you will not be able to recover the record",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((willDelete) => {
            if (willDelete.value) {
                $(form).submit();
            }
        })
    });

    // Ask the user if they really want to withdraw the record
    $('.table').on('click', '[data-action="withdraw"]', function (e) {
        e.preventDefault();

        let form = $(this).data('form');

        Swal.fire({
            title: 'Are you sure?',
            text: "Once withdrawn, you will not be able to recover the record",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((willDelete) => {
            if (willDelete.value) {
                $(form).submit();
            }
        })
    });
})
