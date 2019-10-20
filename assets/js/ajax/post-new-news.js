function form() {
    $.ajax({
        type: 'POST',
        url: '/admin/news/loadNewsTemplate',
        data: {
            pageTemplate: $('select#template-id').val()
        },
        success: function (data) {
            Formio.createForm(document.getElementById('contentArea'), JSON.parse(data)).then(function (form) {
                form.on('submit', (submission) => {
                    submission.newsTitle = $("input#newsTitle").val();
                    submission.templateId = $('select#template-id').val();

                    return $.ajax({
                        url: '/admin/add/news',
                        type: 'POST',
                        data: submission,
                        error: function (error) {
                            console.log(error);
                            $('html').html(error.responseText)
                            //window.location.replace('/admin/pages/new-page?message=error');
                        },
                        success: function (data) {
                            console.log(data)
                            $('html').html(data)
                            // window.location.replace('/admin/pages?message=success');
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
