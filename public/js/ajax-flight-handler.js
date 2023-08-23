import axios from 'axios';

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

const deleteFlight = (flightId) => {

    axios.Delete(apiURL, {
        params : { id: flightId },
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

const updateFlight = (flightId) => {

    axios.Put(apiURL, {
        params : { id: flightId },
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


