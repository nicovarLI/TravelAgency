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
            $("#airline-select").val('').trigger("change");
            $("#origin-select").val('').trigger("change");
            $("#destination-select").val('').trigger("change");
            loadTable();
            showToast("Flight created successfully", "success", 5);
        })
        .catch(function (error) {
            console.log(error);
            showToast(error.response.data.message, "error", 5);
        });
};

const deleteFlight = (flightId) => {
    axios
        .delete(`${apiURL}/${flightId}`)
        .then(function (response) {
            loadTable();
            showToast("Flight deleted successfully", "success", 5);
        })
        .catch(function (error) {
            showToast(error.response.data.message, "error", 5);
        });
};

const updateFlight = (flightId) => {
    axios
        .put(`${apiURL}/${flightId}`, $("#flight-update-form").serialize(), {
            headers: { "content-type": "application/x-www-form-urlencoded" },
            data: $("#update-flight-form").serialize(),
        })
        .then(function (response) {
            loadTable();
            showToast("Flight updated successfully", "success", 5);
        })
        .catch(function (error) {
            showToast(error.response.data.message, "error", 5);
        });
};

$(document).ready(function () {
    axios
        .get("/api/airlines")
        .then(function (response) {
            const airlines = $.map(response.data.data, function (item) {
                return {
                    id: item.id,
                    text: item.name,
                };
            });
            $('#airline-select, #edit-airline-select').select2({
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
        placeholder: "Select a origin",
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

const loadFlightSelects = (airlineId, originId, destinationId) => {
    handleAirlineSelection( airlineId, "#edit-origin-select", "#edit-destination-select", function () {
            $("#edit-airline-select").val(airlineId).trigger("change");
            $("#edit-origin-select").val(originId).trigger("change");
            $("#edit-destination-select").val(destinationId).trigger("change");
            $("#edit-destination-select").val(destinationId).trigger({
                type : 'select2:select',
                params : {
                    data: {
                        id : destinationId
                    }
                }
            });
            $("#edit-origin-select").val(originId).trigger({
                type : 'select2:select',
                params : {
                    data: {
                        id : originId
                    }
                }
            });
        }
    );
};

const handleAirlineSelection = (airlineId, origin, destination, callback) => {
    $(`${origin}, ${destination}`).prop("disabled", false);

    $.ajax({
        url: `api/airlines/${airlineId}/cities`,
        dataType: "json",
        success: function (data) {
            const cities = $.map(data, function (item) {
                return {
                    id: item.id,
                    text: item.name,
                };
            });
            populateCitySelects(cities, origin, destination, callback);
        },
    });
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

function showToast(message, status, duration) {
    const toastContainer = document.getElementById("toast-container");
    const toast = document.createElement("div");
    const toastBody = document.createElement("div");

    toastSetup(toast, toastBody, status, duration, message);
    toastContainer.appendChild(toast);
    $(toast).toast('show');

    $(toast).on('hidden.bs.toast', function () {
        toast.remove();
    });
}

const toastSetup = (toast, toastBody, status, duration, message) => {
    if (status === "success") {
        toastBody.style.background = "#68d391";
    } else if (status === "error") {
        toastBody.style.background = "#e53e3e";
    }
    $(toast).toast({delay: duration * 1000});
    toast.className = "toast";
    toast.style.width = "300px";
    toast.style.borderRadius = "8px";
    toastBody.className = "toast-body";
    toastBody.style.color = "#fff";
    toastBody.innerHTML = message;
    toast.appendChild(toastBody);
}

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
                        <button @click="show = true; loadFlightSelects(${airline.id},${origin_city.id},${destination_city.id}) ; flightId = '${id}'; departureTime = '${departure_time}'; arrivalTime = '${arrival_time}'" class="text-xs bg-blue-400 text-white hover:bg-white action:bg-red-500r hover:text-blue-500 p-2 px-4 rounded-full">
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
