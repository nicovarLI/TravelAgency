$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$('form').submit(function(event){
    event.preventDefault();
    console.log("prevented default");
})
function createCity(){
    var form = $('#add-city-form');
    var formData = $(form).serializeArray();
    var jsonData = {};

    $.each(formData, function(_,field){
        jsonData[field.name] = field.value;
    });

    $.ajax({
        url: '/',
        method: 'POST',
        data: JSON.stringify(jsonData),
        dataType: 'JSON',
        contentType: 'application/json',
        cache: false,
        processData: false,
        success:function(response)
        {
            document.forms["add-city-form"].reset();
            $('#cities-table').html(response.updatedCitiesTable)
            $('#pagination-links').html(response.updatedPaginationLinks);
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText)
        }
    });
}

function deleteCity(){
    var form = $('#cities-delete-form');
    var formData = $(form).serializeArray();
    var jsonData = {};

    $.each(formData, function(_,field){
        jsonData[field.name] = field.value;
    });

    $.ajax({
        url: '/',
        method: 'DELETE',
        data: JSON.stringify(jsonData),
        dataType: 'JSON',
        contentType: 'application/json',
        cache: false,
        processData: false,
        success:function(response)
        {
            $('#cities-table').html(response.updatedCitiesTable)
            $('#pagination-links').html(response.updatedPaginationLinks);
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText)
        }
    });
}

function updateCity(){
    var form = $('#cities-update-form');
    var formData = $(form).serializeArray();
    var jsonData = {};

    $.each(formData, function(_,field){
        jsonData[field.name] = field.value;
    });

    $.ajax({
        url: '/',
        method: 'PATCH',
        data: JSON.stringify(jsonData),
        dataType: 'JSON',
        contentType: 'application/json',
        cache: false,
        processData: false,
        success:function(response)
        {
            $('#cities-table').html(response.updatedCitiesTable)
            $('#pagination-links').html(response.updatedPaginationLinks);
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText)
        }
    });
}
