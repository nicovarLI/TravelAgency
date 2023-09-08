$('form').submit(function(event){
    event.preventDefault();
})

const baseURL = '/api/airlines'

const createAirline = () => {
    fetch(baseURL, {
        method: 'POST',
        headers: {
            'Content-type': 'application/x-www-form-urlencoded',
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': getCsrfToken()
        },
        body: new URLSearchParams($('#add-airline-form').serialize() + '&cityIds=' + $("#city-select").val().join(','))
    })
    .then(response => {
        if (response.ok) {
            $('#name-error').text('');
            $('#description-error').text('');
            document.forms["add-airline-form"].reset();
            $("#city-select").val([]).trigger("change");
            return response.json();
        }
        return response.json().then(data => {
            handleValidationErrors(data.errors);
            throw new Error('Validation Error');
        });
    })
    .then(result => loadTable())
    .catch(error => console.error);
}

const deleteAirline = (airlineId) => {
    fetch(`${baseURL}/${airlineId}`, {
        method: 'DELETE',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': getCsrfToken()
        },
    })
    .then(response => response.json())
    .then(result => loadTable())
    .catch(error => console.error)
}

const updateAirline = (airlineId) => {
    fetch(`${baseURL}/${airlineId}`, {
        method: 'PUT',
        headers: {
            'Content-type': 'application/x-www-form-urlencoded',
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': getCsrfToken()
        },
        body: new URLSearchParams($('#airlines-update-form').serialize()+ '&cityIds=' + $("#edit-city-select").val().join(','))
    })
    .then(response => response.json())
    .then(result =>
        loadTable(),
        deleteCityAirline(airlineId, $("#edit-location-select").val()),
        $("#edit-city-select").val([]).trigger("change")
    )
    .catch(error => console.error);
}

const deleteCityAirline = (airlineId, cities) => {
    fetch(`${baseURL}/${airlineId}/cities`,{
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': getCsrfToken()
        },
        body: JSON.stringify({ cityIds: cities })
    })
    .then(response => response.json())
    .then(result => $("#edit-location-select").val([]).trigger("change"))
    .catch(error => console.error)
}

const loadTable = () => {
    fetch(`${baseURL}?page=${currentPage()}`)
    .then(response => response.json())
    .then(result => {
        $('#table-body').html(renderTable(result.data))
        $('#pagination-links').html(getLinks(result, '/api/airlines', '/airlines'));
    })
     .catch(error => {console.error('Load table error: ', error);})
}

$(document).ready(function () {
    $("#city-select").select2({
        ajax: {
            url: "/api/cities",
            dataType: "json",
            processResults: function (response) {
                return {
                    results: $.map(response.data, function (item) {
                        return {
                            id: item.id,
                            text: item.name,
                        };
                    }),
                };
            },
        },
        placeholder: "Select cities",
        multiple: true,
        minimumResultsForSearch: Infinity,
    });
});

const renderTable = (airlines) => {
    let tableBody = '';
    if(airlines.length > 0){
        airlines.forEach(({ id, name, description, flights_count })=> {
            tableBody += `
                <tr class="hover:bg-gray-300" data-id="${id}">
                    <td class="py-3">
                        <p class="text-sm font-semibold text-gray-900">${id}</p>
                    </td>
                    <td class="py-3 flex justify-center">
                        <p class="text-sm text-gray-900">${name}</p>
                    </td>
                    <td class="py-3">
                        ${description}
                    </td>
                    <td class="py-3">
                        ${flights_count}
                    </td>
                    <td>
                        <button @click="show = true; airlineName = '${name}'; airlineId = '${id}'; airlineDescription = '${description}';" onclick="loadCitySelect('${id}')" class="text-xs bg-blue-400 text-white hover:bg-white action:bg-red-500r hover:text-blue-500 p-2 px-4 rounded-full">
                            Edit
                        </button>
                    </td>
                    <td>
                        <form id="airline-delete-form">
                            <button @click="show = false" onclick="deleteAirline(${id})" type="button" class="text-xs bg-red-400 text-white hover:bg-white hover:text-red-500 p-2 px-4 rounded-full">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>`;
        });
    }else{
        tableBody += `
            <tr>
                <td colspan="6" class="py-2 text-center">
                    <p class="text-gray-400 text-sm">No records found</p>
                </td>
            </tr>`;
    }

    return tableBody;
}

const loadCitySelect = (airlineId) => {
    $("#edit-location-select").select2({
        ajax: {
            url: `/api/airlines/${airlineId}/cities`,
            dataType: "json",
            processResults: function (response) {
                return {
                    results: $.map(response, function (item) {
                        return {
                            id: item.id,
                            text: item.name,
                        };
                    }),
                };
            },
        },
        placeholder: "Select locations",
        multiple: true,
        minimumResultsForSearch: Infinity,
    });
    $("#edit-city-select").select2({
        ajax: {
            url: "/api/cities",
            dataType: "json",
            processResults: function (response) {
                return {
                    results: $.map(response.data, function (item) {
                        return {
                            id: item.id,
                            text: item.name,
                        };
                    }),
                };
            },
        },
        placeholder: "Select cities",
        multiple: true,
        minimumResultsForSearch: Infinity,
    });
};
