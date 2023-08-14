$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
    }
});

$('form').submit(function(event){
    event.preventDefault();
})

const createCity = () => {
    const page = currentPage();
    $.ajax({
        url: `/?page=${page}`,
        method: 'POST',
        data: $('#add-city-form').serialize(),
        cache: false,
        success:function(response)
        {
            document.forms["add-city-form"].reset();
            $('#name-error').text('');
            $('#cities-table').html(response.updatedCitiesTable)
            $('#pagination-links').html(response.updatedPaginationLinks);
        },
        error: function(xhr) {
            let errors = xhr.responseJSON.errors;
            console.error(xhr.responseText)
        }
    });
}

const deleteCity = (cityId) => {
    const page = currentPage();
    $.ajax({
        url: `/${cityId}?page=${page}`,
        method: 'DELETE',
        cache: false,
        success:function(response)
        {
            $('#cities-table').html(response.updatedCitiesTable)
            $('#pagination-links').html(response.updatedPaginationLinks);
        },
        error: function(xhr) {
            let errors = xhr.responseJSON.errors;
            console.error(xhr.responseText)
        }
    });
}

const updateCity = (cityId) => {
    const page =  currentPage();
    $.ajax({
        url: `/${cityId}?page=${page}`,
        method: 'PATCH',
        data: $('#cities-update-form').serialize(),
        cache: false,
        success:function(response)
        {
            $('#cities-table').html(response.updatedCitiesTable)
            $('#pagination-links').html(response.updatedPaginationLinks);
        },
        error: function(xhr) {
            let errors = xhr.responseJSON.errors;
            console.error(xhr.responseText)
        }
    });
}

const currentPage = () => new URLSearchParams(window.location.search).get('page') || 1;
