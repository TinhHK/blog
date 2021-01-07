var loginStatus = false;
$("#login").validate({
    rules: {
        'user[name]': {
            required: true,
        },
        'user[email]': {
            required: true,
            email: true,
        },
        'user[password]': {
            required: true,
        }
    },
    messages: {
        'user[name]': {
            required: "required",
        },
        'user[email]': {
            required: "required",
            email: "not an email"
        },
        'user[password]': {
            required: "required",
        }
    }
});
function loadCar() {
    $.ajax({
        type : "GET",
        url : "https://vpic.nhtsa.dot.gov/api/vehicles/getmodelsformakeyear/make/honda/modelyear/2015?format=json",
        dataType : "json",
        error : function (jqXHR, textStatus, errorThrown) {
                alert('Error : ' + jqXHR.responseText);
        },
        success : function (response) {
            var json = jQuery.parseJSON(response);
            if(!json.Count) {
                return;
            }
            var result = json.Results;
            for (var i = 0; i < result.length; i++) {
                tr = $('<tr/>');
                tr.append("<td>" + result[i].Make_ID + "</td>");
                tr.append("<td>" + result[i].Make_Name + "</td>");
                tr.append("<td>" + result[i].Model_ID + "</td>");
                tr.append("<td>" + result[i].Model_Name + "</td>");
                $('#dataTables-car tbody').append(tr);
            }
            $(".car-display").removeClass('d-none');
            $(".login-center").addClass('d-none');
        }
    });
}
