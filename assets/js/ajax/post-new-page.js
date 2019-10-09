function form() {
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
                    submission.pageStatus = $('select#page-status').val();

                    return $.ajax({
                        url: '/admin/add/page',
                        type: 'POST',
                        data: submission,
                        error: function (error) {
                            //console.log(error);
                            window.location.replace('/admin/pages/new-page?message=error');
                        },
                        success: function (data) {
                            window.location.replace('/admin/pages?message=success');
                        }
                    });
                });
                form.on('error', (errors) => {
                    console.log('There are some errors..');
                    console.log(errors);
                });
            });
        }
    })
}

$('select#template-id').ready(function () {
    form();
});

$('select#template-id').change(function () {
    form();
});
