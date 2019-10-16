$('form#settingsForm').submit(function (event) {
    event.preventDefault(); //prevent default action

    var form_data = $(this).serialize();


    $.ajax({
        url: '/admin/settings/changeCMSSettings',
        type: 'POST',
        data: form_data,
        error: function (error) {
            console.log(error.responseText)
            toastr["warning"]("Er is iets fout gegaan. Probeer het nog is...", "Oeps");

            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "2500",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
        },
        success: function (data) {
            toastr["success"]("Website instellingen succesvol aangepast! 😃", "Succes")

            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "2500",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
        }
    })
});