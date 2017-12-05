$(document).ready(function () {

    fetchAllCompanies();

    $("#add-company-btn").click(function () {
        $.post($("#add-company-form").attr("action"),
            $("#add-company-form :input").serializeArray(),
            function (info) {
                $("#result").html(info);
                fetchAllCompanies();
                $("#add-company-form")[0].reset();
            }
        );
    });


    $("#add-company-form").submit(function () {
        return false;
    });


    $("#company-input").keyup(function () {
        $("span").html("");
    });

    function fetchAllCompanies() {
        $("#fetch-employees-form")[0].reset();
        $.getJSON("helpers/get-companies.php", function (companies) {
            $.each(companies, function (i, item) {
                $("#selectCompany").append(
                    "<p> <input name=\"selected-company\" type=\"radio\" value=\"" + item.id +
                    "\" id=\"" + item.id + "\" />" + "<label for=\"" + item.id +
                    "\">" + item.name + "</label></p>");
            });
        });
    }

    $("#fetch-employees").click(function() {
        $("#employeeHeader").empty();
        $("#employeeContainer").empty();
        $.post(
            $("#fetch-employees-form").attr("action"),
            $("#fetch-employees-form :input").serializeArray(),
            function (result) {
                if (result.length == 0) {
                    $("#employeeHeader").html("<h5>No employees found for this company.</h5>");
                }
                else {
                    $("#employeeHeader").html("<h5>Employee(s) pertaining to this company:</h5>");
                    $("#employeeContainer").append("<form method=\"post\" action=\"helpers/delete-employee.php\" id=\"delete-employee-form\">");
                    $.each(result, function (i, employee) {
                        $("#employeeContainer").append("<p><input type=\"checkbox\" form=\"delete-employee-form\" class=\"filled-in red\" id=\"" + employee.full_name + "\" /><label for=\"" + employee.full_name + "\">" + employee.full_name + "</label></p>");
                    })

                    $("#employeeContainer").append("<button type=\"submit\" id=\"delete-employee-btn\" class=\"waves-effect waves-light btn\">Delete from Company</button>");
                }
            },
            "json"
        );
    });

    $("#delete-employee-btn").click(function () {
        $.post($("#delete-employee-form").attr("action"),
            $("#delete-employee-form :input").serializeArray(),
            function (info) {
                $("#result2").html(info);
            }
        );
    });


    $("#fetch-employees-form").submit(function () {
        return false;
    });


    $('select').material_select();

});