var jsonElement = document.getElementById('json');
var formElement = document.getElementById('formio');
var subJSON = document.getElementById('subjson');

var builder = new Formio.FormBuilder(document.getElementById('builder'), {
    "display": "form",
    "settings": {},
    "components": [
        {
            "label": "Text Field",
            "key": "textField",
            "type": "textfield",
            "input": true
        },
        {
            "type": "button",
            "label": "Submit",
            "key": "submit",
            "disableOnInvalid": true,
            "input": true
        }
    ]
});

var onForm = function (form) {
    form.on('change', function () {
        subJSON.innerHTML = '';
        subJSON.appendChild(document.createTextNode(JSON.stringify(form.submission, null, 4)));
    });
};

var onBuild = function (build) {
    jsonElement.innerHTML = '';
    formElement.innerHTML = '';
    jsonElement.appendChild(document.createTextNode(JSON.stringify(builder.instance.schema, null, 4)));
    Formio.createForm(formElement, builder.instance.form).then(onForm);
};

var onReady = function () {
    var jsonElement = document.getElementById('json');
    var formElement = document.getElementById('formio');
    builder.instance.on('saveComponent', onBuild);
    builder.instance.on('editComponent', onBuild);
};

var setDisplay = function (display) {
    builder.setDisplay(display).then(onReady);
};

// Handle the form selection.
var formSelect = document.getElementById('form-select');
formSelect.addEventListener("change", function () {
    setDisplay(this.value);
});

builder.instance.ready.then(onReady);

$('form').submit(function (e) {
    e.preventDefault();

    var jsonElement = document.getElementById('json');

    var data = {
        templateName : $("input[name='templateName']").val(),
        templateFile : $("select[name='templateFile']").val(),
        jsonElement : jsonElement.innerHTML,
    };

    $.ajax({
        url: '/admin/add/template',
        type: 'POST',
        data: data,
        error: function(error) {
            // $('html').html(error);
            console.log(error)
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
        success: function(response) {
            // $('html').html(response);
            window.location.replace('/admin/templates?message=successfully-added');
        }
    });
});
