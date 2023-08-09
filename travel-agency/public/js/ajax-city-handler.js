$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$('form').submit(function(event){
    event.preventDefault();
})
function createCity(){
    var currentPage = new URLSearchParams(window.location.search).get('page') || 1;
    var form = $('#add-city-form');
    var formData = $(form).serializeArray();
    var jsonData = {};

    $.each(formData, function(_,field){
        jsonData[field.name] = field.value;
    });
    jsonData['page']= currentPage;

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
            $('#name-error').text('');
            $('#cities-table').html(response.updatedCitiesTable)
            $('#pagination-links').html(response.updatedPaginationLinks);
        },
        error: function(xhr, status, error) {
            if (xhr.status === 422) {
                var errors = xhr.responseJSON.errors;
                $('#name-error').text(errors.name[0]);
            }
            console.error(xhr.responseText)
        }
    });
}

function deleteCity(cityId){
    var currentPage = new URLSearchParams(window.location.search).get('page') || 1;
    var jsonData = {'id': cityId,
                    'page': currentPage};

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
            if (xhr.status === 422) {
                var errors = xhr.responseJSON.errors;
            }
            console.error(xhr.responseText)
        }
    });
}

function updateCity(){
    var currentPage = new URLSearchParams(window.location.search).get('page') || 1;
    var form = $('#cities-update-form');
    var formData = $(form).serializeArray();
    var jsonData = {};

    $.each(formData, function(_,field){
        jsonData[field.name] = field.value;
    });
    jsonData['page']= currentPage;

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
            if (xhr.status === 422) {
                var errors = xhr.responseJSON.errors;
            }
            console.error(xhr.responseText)
        }
    });
}
