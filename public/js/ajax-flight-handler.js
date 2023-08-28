const apiURL = "/api/flights";

$("form").submit(function (event) {
    event.preventDefault();
});

const createFlight = () => {
    axios
        .post(apiURL, $("#add-flight-form").serialize(), {
            headers: {
                "content-type": "application/x-www-form-urlencoded",
                "X-CSRF-TOKEN": getCsrfToken(),
            },
        })
        .then(function (response) {
            document.forms["add-flight-form"].reset();
            loadTable();
        })
        .catch(function (error) {
            console.log(error);
        });
};

const deleteFlight = (flightId) => {
    axios
        .delete(`${apiURL}/${flightId}`)
        .then(function (response) {
            loadTable();
        })
        .catch(function (error) {
            console.log(error);
        });
};

const updateFlight = (flightId) => {
    axios
        .put(`${apiURL}/${flightId}`,$("#flight-update-form").serialize(), {
            headers: { "content-type": "application/x-www-form-urlencoded" },
            data: $("#update-flight-form").serialize(),
        })
        .then(function (response) {
            loadTable();
        })
        .catch(function (error) {
            console.log(error);
        });
};

$(document).ready(function () {
    $("#airline-select").select2({
        ajax: {
            url: "/api/airlines",
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
        minimumResultsForSearch: Infinity,
    });

    $("#airline-select").on("select2:select", function (e) {
        handleAirlineSelection(e.params.data.id);
    });
    $("#origin-select").select2({
        minimumResultsForSearch: Infinity,
        disabled: true,
    });
    $("#destination-select").select2({
        minimumResultsForSearch: Infinity,
        disabled: true,
    });

    const handleAirlineSelection = (airlineId) => {
        $("#origin-select, #destination-select").prop("disabled", false);

        $.ajax({
            url: `api/airlines/${airlineId}/cities`,
            dataType: "json",
            success: function (data) {
                populateCitySelects(data);
            },
        });
    };

    const populateCitySelects = (data) => {
        $("#origin-select").empty();
        $("#destination-select").empty();

        let cities = $.map(data, function (item) {
            return {
                id: item.id,
                text: item.name,
            };
        });
        $("#origin-select").select2({
            data: cities,
        });

        $("#destination-select").select2({
            data: cities,
        });
    };
});

const loadTable = () => {
    axios(apiURL, { params: { page: currentPage() } })
        .then(function (response) {
            $("#table-body").html(renderTable(response.data.data));
            $("#pagination-links").html(getLinks(response.data, apiURL));
        })
        .catch(function (error) {
            console.log(error);
        });
};

const renderTable = (flights) => {
    let tableBody = "";
    if (flights.length > 0) {
        flights.forEach(
            ({
                id,
                origin_city,
                destination_city,
                airline,
                departure_time,
                arrival_time,
            }) => {
                tableBody += `
                <tr class="hover:bg-gray-300" data-id="${id}">
                    <td class="py-3">
                        <p class="text-sm font-semibold text-gray-900">${id}</p>
                    </td>
                    <td class="py-3 justify-center">
                        <p class="text-sm text-gray-900">${origin_city.name}</p>
                    </td>
                    <td class="py-3 justify-center">
                        <p class="text-sm text-gray-900">${destination_city.name}</p>
                    </td>
                    <td class="py-3 justify-center">
                        <p class="text-sm text-gray-900">${airline.name}</p>
                    </td>
                    <td class="py-3">
                        ${departure_time}
                    </td>
                    <td class="py-3">
                        ${arrival_time}
                    </td>
                    <td>
                        <button @click="show = true; flightId = '${id}'; departureTime = '${departure_time}'; arrivalTime = '${arrival_time}'" class="text-xs bg-blue-400 text-white hover:bg-white action:bg-red-500r hover:text-blue-500 p-2 px-4 rounded-full">
                            Edit
                        </button>
                    </td>
                    <td>
                        <form id="flight-delete-form">
                            <button @click="show = false" onclick="deleteFlight(${id})" type="button" class="text-xs bg-red-400 text-white hover:bg-white hover:text-red-500 p-2 px-4 rounded-full">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>`;
            }
        );
    } else {
        tableBody += `
            <tr>
                <td colspan="6" class="py-2 text-center">
                    <p class="text-gray-400 text-sm">No records found</p>
                </td>
            </tr>`;
    }

    return tableBody;
};
