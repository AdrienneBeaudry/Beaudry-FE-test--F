$(document).ready(function () {

    $('select').material_select();

    fetchIndividuals();
    assignCompany();


    $("#assign-company-form").submit(function () {
        return false;
    });


    $("#assign-company").click(function () {
        $.post($("#assign-company-form").attr("action"),
            $("#assign-company-form :input").serializeArray(),
            function (info) {
                $("#result").html(info);
                fetchIndividuals();
                assignCompany();
                $("#assign-company-form").each(function(){
                    this.reset();
                });
            }
        );
    });

});



function fetchIndividuals() {
    $("#individuals-container").empty();
    $.getJSON("helpers/get-individuals.php", function (individuals) {
        $.each(individuals, function (i, individual) {
            $("#individuals-container").append(
                "<p><input name=\"select-individual\" form=\"assign-company-form\" type=\"radio\" value=\"" + individual.id +
                "\" id=\"" + individual.id + "\" />" + "<label for=\"" + individual.id +
                "\">" + individual.full_name + "</label></p>"
            );


        });
    });
}

function assignCompany() {
    $("#companies-container").empty();
    $.getJSON("helpers/get-companies.php", function (companies) {
        $.each(companies, function (i, company) {
            $("#companies-container").append(
                "<p><input name=\"select-company\" form=\"assign-company-form\" type=\"radio\" value=\"" + company.id +
                "\" id=\"" + "100" + company.id + "\" />" + "<label for=\"" + "100" + company.id +
                "\">" + company.name + "</label></p>"
            );
        });
    });
}