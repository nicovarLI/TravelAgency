$('form').submit(function(event){
    event.preventDefault();
})

const createAirline = () => {
    fetch('api/airlines', {
        method: 'POST',
        headers: {
            'Content-type': 'application/x-www-form-urlencoded',
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        body: new URLSearchParams($('#add-airline-form').serialize())
    })

    .then(response => response.json())
    .then(result => {
        loadTable();
        document.forms["add-airline-form"].reset();
        $('#name-error').text('');
    })
    .catch(error =>
        console.error(response.message));
}

const deleteAirline = (airlineId) => {
    fetch(`api/airlines/${airlineId}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    })

    .then(response => response.json())
    .then(result=>
        loadTable())
    .catch(error =>
        console.error(error));
}

const updateAirline = (airlineId) => {
    fetch(`api/airlines/${airlineId}`, {
        method: 'PUT',
        headers: {
            'Content-type': 'application/x-www-form-urlencoded',
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        body: new URLSearchParams($('#airlines-update-form').serialize())
    })

    .then(response => response.json())
    .then(result=>
        loadTable())
    .catch(error =>
        console.error(error));
}

const loadTable = () => {
    const page = currentPage();
    fetch(`/api/airlines?page=${page}`)

    .then(response => response.json())
    .then(result => {
        const airlines = result.data;
        $('#table-body').html(renderTable(airlines))
        $('#pagination-links').html(getLinks(result, '/api/airlines'));
    })
     .catch(error => {
        console.error('Load table error: ', error);
    })
}

const renderTable = (airlines) => {
    let tableBody = '';

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
                    <button @click="show = true; airlineName = '${name}'; airlineId = '${id}'; airlineDescription = '${description}';" class="text-xs bg-blue-400 text-white hover:bg-white action:bg-red-500r hover:text-blue-500 p-2 px-4 rounded-full">
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

    return tableBody;
}

const currentPage = () => new URLSearchParams(window.location.search).get('page') || 1;


