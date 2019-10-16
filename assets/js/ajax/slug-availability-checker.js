$("#pageSlug").keyup(function () {
    this.value = this.value.replace(/ /g, "-");
});

function checkAvailability() {

    const pageID = $("input#pageID").val();

    $("#loaderIcon").show();
    jQuery.ajax({
        url: "/admin/pages/CheckSlugAvailability",
        data: 'slug=' + $("input#pageSlug").val() + '&pageID=' + pageID,
        type: "POST",
        success: function (data) {
            const result = JSON.parse(data);
            const input = $("input#pageSlug");
            const feedbackDiv = $("div#feedback");

            if (data === '') {
                input.removeClass("is-valid").addClass("is-invalid");
                feedbackDiv.removeClass("valid-feedback").addClass("invalid-feedback");
                feedbackDiv.html('Je moet wel een slug invullen.');
            }

            if (result.error) {
                input.removeClass("is-valid").addClass("is-invalid");
                feedbackDiv.removeClass("valid-feedback").addClass("invalid-feedback");
                feedbackDiv.html(result.error);
            } else if (result.success) {
                input.removeClass("is-invalid").addClass("is-valid");
                feedbackDiv.removeClass("invalid-feedback").addClass("valid-feedback");
                feedbackDiv.html('Looks good!');
            }

            $("#loaderIcon").hide();
        },
        error: function () {
        }
    });
}