$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$('form').submit(function(event){
    event.preventDefault();
})

const createCity = () => {
    const currentPage = new URLSearchParams(window.location.search).get('page') || 1;
    const jsonData = formToJson($('#add-city-form'),currentPage);

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
        error: function(xhr) {
            if (xhr.status === 422) {
                var errors = xhr.responseJSON.errors;
                $('#name-error').text(errors.name[0]);
            }
            console.error(xhr.responseText)
        }
    });
}

const deleteCity = (cityId) => {
    const currentPage = new URLSearchParams(window.location.search).get('page') || 1;
    const jsonData = {'page': currentPage};

    $.ajax({
        url: `/${cityId}`,
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
        error: function(xhr) {
            if (xhr.status === 422) {
                let errors = xhr.responseJSON.errors;
            }
            console.error(xhr.responseText)
        }
    });
}
const updateCity = () => {
    const currentPage = new URLSearchParams(window.location.search).get('page') || 1;
    const jsonData = formToJson($('#cities-update-form'),currentPage);

    $.ajax({
        url: `/${jsonData['id']}`,
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
        error: function(xhr) {
            if (xhr.status === 422) {
                let errors = xhr.responseJSON.errors;
            }
            console.error(xhr.responseText)
        }
    });
}
function formToJson(form,page){
    let formData = $(form).serializeArray();
    let jsonData = {};

    $.each(formData, function(_,field){
        jsonData[field.name] = field.value;
    });
    jsonData['page']= page;
    return jsonData;
}
