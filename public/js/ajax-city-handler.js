$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
    }
});

$('form').submit(function(event){
    event.preventDefault();
})

const createCity = () => {
    $.ajax({
        url: `api/cities`,
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
        url: `/api/cities/${cityId}`,
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
        url: `/api/cities/${cityId}`,
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
    const page = currentPage();

    $.ajax({
        url: `/api/cities?page=${page}`,
        method: 'GET',
        success:function(response)
        {
            const cities = response.data;
            const links = response.links;

            $('#table-body').html(renderTable(cities))
            $('#pagination-links').html(renderLinks(response));
        },
        error: function(xhr) {
            let errors = xhr.responseJSON.errors;
            console.error(xhr.responseText);
        }
    });
}

const renderTable = (cities) => {
    let tableBody = '';
    cities.forEach(city => {
        tableBody += `
            <tr class="hover:bg-gray-300" data-id="${city.id}">
                <td class="py-3">
                    <p class="text-sm font-semibold text-gray-900">${city.id}</p>
                </td>
                <td class="py-3 flex justify-center">
                    <p class="text-sm text-gray-900">${city.name}</p>
                </td>
                <td class="py-3">
                    ${city.arrivals.length}
                </td>
                <td class="py-3">
                    ${city.departures.length}
                </td>
                <td>
                    <button @click="show = true; cityName = '${city.name}'; cityId = '${city.id}'" class="text-xs bg-blue-400 text-white hover:bg-white action:bg-red-500r hover:text-blue-500 p-2 px-4 rounded-full">
                        Edit
                    </button>
                </td>
                <td>
                    <form id="cities-delete-form">
                        <input type="hidden" name="id" value="${city.id}"/>
                        <button @click="show = false" onclick="deleteCity(${city.id})" type="button" class="text-xs bg-red-400 text-white hover:bg-white hover:text-red-500 p-2 px-4 rounded-full">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>`;
    });
    return tableBody;
}

const renderLinks = (linkData) => {
    newLinks = customizePaginationLinks(linkData.links);
    linksNav = `
    <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between">

    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
        <div>
            <p class="text-sm text-gray-700 leading-5">
                Showing
                <span class="font-medium">${linkData.from}</span>
                to
                <span class="font-medium">${linkData.to}</span>
                of
                <span class="font-medium">${linkData.total}</span>
                results
            </p>
        </div>

        <div>
            <span class="relative z-0 inline-flex shadow-sm rounded-md">

                <a href="${newLinks[0].url}" rel="prev" class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-l-md leading-5 hover:text-gray-400 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150" aria-label="&amp;laquo; Previous">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                </a>`;
    newLinks.pop();
    newLinks.slice(1).forEach(link => {
        linksNav += `
        <a href="${link.url}" class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 hover:text-gray-500 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150" aria-label="Go to page ${link.label}">${link.label}</a>`;
    });
    linksNav += `
        <a href="${newLinks[newLinks.length-1].url}" rel="next" class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-r-md leading-5 hover:text-gray-400 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150" aria-label="Next &amp;raquo;">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
        </svg>
        </a>
    `;
    return linksNav;
}

const currentPage = () => new URLSearchParams(window.location.search).get('page') || 1;

const customizePaginationLinks = (links) => {
    return links.map(link => {
        if (link.url) {
            link.url = link.url.replace('/api/cities', '');
        }
        return link;
    });
}