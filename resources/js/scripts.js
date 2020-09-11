require('./forms/actions')
require('./modals/decline')
require('./modals/details')

require('./forms/leave_application')

$(function () {
    // Date picker
    $('.datepicker').datepicker({
        autohide: true,
        format: 'yyyy-mm-dd'
    });


    // Handle setting the active class on menu
    let url = window.location;
    let link = $('ul.navbar-nav a').filter(function () {
        return this.href === url;
    });

    if (link.hasClass('collapse-item')) {
        link.addClass('active');
        link.closest('.collapse').addClass('show');
    }

    link.closest('.nav-item').addClass('active');

    // Initialize all selects to select2
    $("form select.form-control").select2({theme: "bootstrap4"});

    // Set the validation defaults
    jQuery.validator.setDefaults({
        errorElement: 'span',
        errorClass: 'invalid-feedback',
        focusInvalid: false,

        errorPlacement: function (error, element) {
            if (element.is('select')) {
                $(element).closest('div').append(error);
            } else {
                $(element).after(error);
            }
        },

        highlight: function (element) {
            $(element).addClass('is-invalid').removeClass('is-valid');
        },

        unhighlight: function (element) {
            $(element).removeClass('is-invalid').addClass('is-valid');
        }
    });

    // Validate form
    $("form.validate-form").validate();

    // Validate form on select
    $('form select').on('select2:select', function (e) {
        $(this).valid();
    });
});
