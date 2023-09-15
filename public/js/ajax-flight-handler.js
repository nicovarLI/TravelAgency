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
            $("#airline-select").val("").trigger("change");
            $("#origin-select").val("").trigger("change");
            $("#destination-select").val("").trigger("change");
            loadTable();
            showToast(response.data.message, response.data.status, 5);
        })
        .catch(function (error) {
            showToast(error.response.data.message, "error", 5);
        });
};

const deleteFlight = (flightId) => {
    if (confirm("Are you sure you want to delete this?")) {
        axios
            .delete(`${apiURL}/${flightId}`)
            .then(function (response) {
                loadTable();
                showToast(response.data.message, response.data.status, 5);
            })
            .catch(function (error) {
                showToast(error.response.data.message, "error", 5);
            });
    } else {
        showToast("Deletion aborted", "info", 5);
    }
};

const updateFlight = (flightId) => {
    axios
        .put(`${apiURL}/${flightId}`, $("#flight-update-form").serialize(), {
            headers: { "content-type": "application/x-www-form-urlencoded" },
        })
        .then(function (response) {
            loadTable();
            showToast(response.data.message, response.data.status, 5);
        })
        .catch(function (error) {
            showToast(error.response.data.message, "error", 5);
        });
};

$(document).ready(function () {
    axios.get("/api/airlines/all").then(function (response) {
        const airlines = $.map(response.data, function (item) {
            return {
                id: item.id,
                text: item.name,
            };
        });
        $("#airline-select, #edit-airline-select").select2({
            data: airlines,
            placeholder: "Select an airline",
        });
    });

    $("#airline-select, #edit-airline-select").select2({
        minimumResultsForSearch: Infinity,
    });
    $("#airline-select").on("select2:select", function (e) {
        handleAirlineSelection(
            e.params.data.id,
            "#origin-select",
            "#destination-select"
        );
    });
    $("#edit-airline-select").on("select2:select", function (e) {
        handleAirlineSelection(
            e.params.data.id,
            "#edit-origin-select",
            "#edit-destination-select"
        );
    });
    $("#origin-select").select2({
        minimumResultsForSearch: Infinity,
        disabled: true,
        placeholder: "Select an origin",
    });
    $("#destination-select").select2({
        minimumResultsForSearch: Infinity,
        disabled: true,
        placeholder: "Select a destination",
    });
    $("#edit-origin-select, #edit-destination-select").select2({
        minimumResultsForSearch: Infinity,
    });
});

const loadFlightSelects = (flight) => {
    const flightData = JSON.parse(flight);
    const airlineId = flightData.airline_id;
    const originId = flightData.origin_city_id;
    const destinationId = flightData.destination_city_id;

    handleAirlineSelection( airlineId, "#edit-origin-select", "#edit-destination-select",
        function () {
            $("#edit-airline-select").val(airlineId).trigger("change");
            $("#edit-origin-select").val(originId).trigger("change");
            $("#edit-destination-select").val(destinationId).trigger("change");
            $("#edit-destination-select").val(destinationId).trigger({
                    type: "select2:select",
                    params: {data: {id: destinationId}}
                });
            $("#edit-origin-select").val(originId).trigger({
                    type: "select2:select",
                    params: {data: {id: originId}}
                });
        }
    );
};

const handleAirlineSelection = (airlineId, origin, destination, callback) => {
    $(`${origin}, ${destination}`).prop("disabled", false);

    axios.get(`/api/airlines/${airlineId}/cities`).then(function (response) {
        const cities = $.map(response.data, function (item) {
            return {
                id: item.id,
                text: item.name,
            };
        });
        populateCitySelects(cities, origin, destination, callback);
    })
};

const populateCitySelects = (cities, origin, destination, callback) => {
    $(`${origin}`).empty();
    $(`${destination}`).empty();
    cities.unshift({ id: "" });
    $(`${origin}`).select2({
        data: cities,
        placeholder: "Select an origin",
    });
    $(`${destination}`).select2({
        data: cities,
        placeholder: "Select a destination",
    });
    if (callback) {
        callback();
    }
};

$("#origin-select").on("select2:select", function (e) {
    disableSelection("#destination-select", e.params.data.id);
});

$("#destination-select").on("select2:select", function (e) {
    disableSelection("#origin-select", e.params.data.id);
});

$("#edit-origin-select").on("select2:select", function (e) {
    disableSelection("#edit-destination-select", e.params.data.id);
});

$("#edit-destination-select").on("select2:select", function (e) {
    disableSelection("#edit-origin-select", e.params.data.id);
});

$("#origin-select").on("select2:unselect", function (e) {
    enableOnUnselect("#destination-select", e.params.data.id);
});

$("#destination-select").on("select2:unselect", function (e) {
    enableOnUnselect("#origin-select", e.params.data.id);
});

$("#edit-origin-select").on("select2:unselect", function (e) {
    enableOnUnselect("#edit-destination-select", e.params.data.id);
});

$("#edit-destination-select").on("select2:unselect", function (e) {
    enableOnUnselect("#edit-origin-select", e.params.data.id);
});

const disableSelection = (select, value) => {
    $(`${select} > option`).each(function () {
        $(this).prop("disabled", false);
    });
    $(`${select} option[value='${value}']`).prop("disabled", true);
};

const enableOnUnselect = (select, value) => {
    $(`${select} option[value='${value}']`).prop("disabled", false);
};

const showToast = (message, type, durationInSeconds) => {
    const toast = document.getElementById("toast");
    const toastMessage = document.getElementById("toast-message");

    toastMessage.textContent = message;
    toast.className = `p-4 rounded-md shadow-lg ${ type === "success" ? "bg-green-500" : "bg-red-500" } text-white`;
    toast.style.display = "block";

    setTimeout(() => { toast.style.display = "none"; }, durationInSeconds * 1000);
};

const loadTable = () => {
    axios(apiURL, { params: { page: currentPage() } })
        .then(function (response) {
            $("#table-body").html(renderTable(response.data.data));
            $("#pagination-links").html(getLinks(response.data, apiURL, '/flights'));
        })
        .catch(function (error) {
            console.log(error);
        });
};

const renderTable = (flights) => {
    let tableBody = "";
    if (flights.length > 0) {
        flights.forEach(
            ({id, origin_city, destination_city, airline, departure_at, arrival_at}) => {
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
                        ${departure_at}
                    </td>
                    <td class="py-3">
                        ${arrival_at}
                    </td>
                    <td>
                        <button @click="show = true; loadFlightSelects(${airline.id},${origin_city.id},${destination_city.id}) ; flightId = '${id}'; departureTime = '${departure_at}'; arrivalTime = '${arrival_at}'" class="text-xs bg-blue-400 text-white hover:bg-white action:bg-red-500r hover:text-blue-500 p-2 px-4 rounded-full">
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
