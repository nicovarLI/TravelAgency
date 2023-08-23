const apiURL = '/api/flights';

const createFlight = () => {

    axios.Post(apiURL, {
        headers: { 'content-type': 'application/x-www-form-urlencoded'},
        data: $('#add-flight-form').serialize(),
    })
    .then(function (response){
        console.log(response.data);
        console.log(response.headers);
        console.log(response.status);
        console.log(response.config);
    })
    .catch(function (error){
        console.log(error);
    })
}
//TODO Agregar load table y paginator al loop para recargar actualizaciones.
const deleteFlight = (flightId) => {
    axios.delete(`${apiURL}/${flightId}`)
    .then(function (response){
        console.log(response);
    })
    .catch(function (error){
        console.log(error);
    })
}

const updateFlight = (flightId) => {

    axios.Put(`${apiURL}/${flightId}`, {
        headers: { 'content-type': 'application/x-www-form-urlencoded'},
        data: $('#update-flight-form').serialize()
    })
    .then(function (response){
        console.log(response.data);
        console.log(response.headers);
        console.log(response.status);
        console.log(response.config);
    })
    .catch(function (error){
        console.log(error);
    })
}


