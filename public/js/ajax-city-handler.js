$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': getCsrfToken()
    }
});

$('form').submit(function(event){
    event.preventDefault();
})

const baseURL = 'api/cities';

const createCity = () => {
    $.ajax({
        url: baseURL,
        method: 'POST',
        data: $('#add-city-form').serialize(),
        cache: false,
        success:function(response)
        {
            document.forms["add-city-form"].reset();
            $('#name-error').text('');
            loadTable();
        },
        error: function(xhr) {
            let errors = xhr.responseJSON.errors;
            console.error(xhr.responseText)
        }
    });
}

const deleteCity = (cityId) => {
    $.ajax({
        url: `${baseURL}/${cityId}`,
        method: 'DELETE',
        cache: false,
        success:function(response)
        {
            loadTable();
        },
        error: function(xhr) {
            let errors = xhr.responseJSON.errors;
            console.error(xhr.responseText)
        }
    });
}

const updateCity = (cityId) => {
    $.ajax({
        url: `${baseURL}/${cityId}`,
        method: 'PUT',
        data: $('#cities-update-form').serialize(),
        cache: false,
        success:function(response)
        {
            loadTable();
        },
        error: function(xhr) {
            let errors = xhr.responseJSON.errors;
            console.error(xhr.responseText)
        }
    });
}

const loadTable = () => {
    $.ajax({
        url: `${baseURL}?page=${currentPage()}`,
        method: 'GET',
        success:function(response)
        {
            $('#table-body').html(renderTable(response.data))
            $('#pagination-links').html(getLinks(response, '/api/cities', '/cities'));
        },
        error: function(xhr) {
            let errors = xhr.responseJSON.errors;
            console.error(xhr.responseText);
        }
    });
}

const renderTable = (cities) => {
    let tableBody = '';
    if(cities.length > 0){
        cities.forEach(({ id, name, arrivals_count, departures_count })=> {
            tableBody += `
                <tr class="hover:bg-gray-300" data-id="${id}">
                    <td class="py-3">
                        <p class="text-sm font-semibold text-gray-900">${id}</p>
                    </td>
                    <td class="py-3 flex justify-center">
                        <p class="text-sm text-gray-900">${name}</p>
                    </td>
                    <td class="py-3">
                        ${arrivals_count}
                    </td>
                    <td class="py-3">
                        ${departures_count}
                    </td>
                    <td>
                        <button @click="show = true; cityName = '${name}'; cityId = '${id}'" class="text-xs bg-blue-400 text-white hover:bg-white action:bg-red-500r hover:text-blue-500 p-2 px-4 rounded-full">
                            Edit
                        </button>
                    </td>
                    <td>
                        <form id="cities-delete-form">
                            <input type="hidden" name="id" value="${id}"/>
                            <button @click="show = false" onclick="deleteCity(${id})" type="button" class="text-xs bg-red-400 text-white hover:bg-white hover:text-red-500 p-2 px-4 rounded-full">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>`;
        });
    } else {
        tableBody += `
        <tr>
            <td colspan="6" class="py-2 text-center">
                <p class="text-gray-400 text-sm">No records found</p>
            </td>
        </tr>`;
    }

    return tableBody;
}
