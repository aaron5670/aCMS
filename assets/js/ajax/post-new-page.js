$('select#template-id').change(function () {
    $.ajax({
        type: 'POST',
        url: '/admin/pages/loadPageTemplate',
        data: {
            pageTemplate: $('select#template-id').val()
        },
        success: function (data) {
            Formio.createForm(document.getElementById('contentArea'), JSON.parse(data)).then(function (form) {
                form.on('submit', (submission) => {
                    submission.pageTitle = $("input#pageTitle").val();
                    submission.pageSlug = $("input#pageSlug").val();
                    submission.templateId = $('select#template-id').val();

                    return $.ajax({
                        url: '/admin/add/page',
                        type: 'POST',
                        data: submission,
                        error: function (error) {
                            //$('html').html(error.responseText);
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
                            toastr["success"]("Pagina succesvol aangemaakt!", "Succes")

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
                    });

                });
                form.on('error', (errors) => {
                    console.log('We have errors!');
                });
            });
        }
    });
});