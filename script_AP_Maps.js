
cep = document.querySelector("#location").value

// API de Mapas
const axios = require('axios/dist/browser/axios.cjs'); // browser
import axios from 'axios';

const map = {
  method: 'GET',
  url: 'https://google-map-places.p.rapidapi.com/maps/api/geocode/json',
  params: {
    address: cep,
    language: 'pt-br',
    region: 'pt-br',
    result_type: 'administrative_area_level_1',
    location_type: 'APPROXIMATE'
  },
  headers: {
    'x-rapidapi-key': '076e9ccd84mshdbc7b64a1ec6910p104a3djsnfd294e2c1ae5',
    'x-rapidapi-host': 'google-map-places.p.rapidapi.com'
  }
};

try {
	const response = await axios.request(map);
	console.log(response.data);
} catch (error) {
	console.error(error);
}    