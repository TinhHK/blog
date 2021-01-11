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
        dataType : "html",
        error : function (jqXHR, textStatus, errorThrown) {
                alert('Error : ' + jqXHR.responseText);
        },
        success : function (response) {
            var json = jQuery.parseJSON(response);
            if(!json.Count) {
                return;
            }
            let cars = json.Results;
            cars.sort((a, b) => a.Model_Name.localeCompare(b.Model_Name, 'es', { sensitivity: 'base' }));
            cars.sort((a, b) => {
                if(a.Model_Name[0] === b.Model_Name[0]) {
                    if(a.Model_ID < b.Model_ID) return -1;
                    if(a.Model_ID > b.Model_ID) return 1;
                }
                return 0;
            });
            let data = cars.reduce((r, c) => {

                // get first letter of name of current element
                let alphabet = c.Model_Name[0];

                // if there is no property in accumulator with this letter create it
                if (!r[alphabet]) r[alphabet] = { alphabet, record: [c] }

                // if there is push current element to children array for that letter
                else r[alphabet].record.push(c);

                // return accumulator
                return r;
            }, {});
            console.log(data);
            for(i in data) {
                html = '<ul>';
                html += "<li>" + data[i].alphabet + "</li>";
                html += "<ul>";
                for(j in data[i].record) {
                    html += "<li>"+data[i].record[j].Model_Name+" "+data[i].record[j].Model_ID+'</li>';
                }
                html += "</ul>";
                $('#car-list').append(html);
            }
            $(".car-display").removeClass('d-none');
            $(".login-center").addClass('d-none');
        }
    });
}
