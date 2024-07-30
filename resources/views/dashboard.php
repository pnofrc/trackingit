<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

<!-- Leaflet.markercluster CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster/dist/MarkerCluster.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster/dist/MarkerCluster.Default.css" />

<!-- Leaflet and Leaflet.markercluster JS -->
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet.markercluster/dist/leaflet.markercluster.js"></script>

    <style>
        .corpus {
            transform: translate3d(-100%, 0, 0)
        }
    </style>
</head>

<body>

    <div id="map"></div>

    <div id="layers">
        <span class="title">FILTRI DI RICERCA</span>

        <div class="dataset">
            <!-- <div> -->
            <span>Dataset 1</span>
            <!-- <span>+</span> -->
            <!-- </div> -->

            <p>
                Descrizione breve del dataset e degli obiettivi della raccolta. Descrizione breve del dataset e degli
                obiettivi della raccolta e poi ancora altro.
            </p>

        </div>

        <div class="dataset selected-data">
            <!-- <div> -->
            <span>Dataset 1</span>
            <!-- <span>+</span> -->
            <!-- </div> -->

            <div>
                <p>
                    Descrizione breve del dataset e degli obiettivi della raccolta. Descrizione breve del dataset e
                    degli obiettivi della raccolta e poi ancora altro.
                </p>
            </div>

        </div>

    </div>

    <div id="corpus" class="corpus animate__animated">

        <div id="fakeMenuBackground"></div>

        <!-- <div class="blackDot start clickMenu -->
        <div id="menu">
            <div id="backMenu"></div>

            <div class="internMenu">
                <b><a href="/">HOME</a></b>
                <b><a class="selected" href="/dashboard">DASHBOARD</a></b>
                <b><a href="/visualization">INDICATORI</a></b>
                <b><a href="/blog">MATERIALI</a></b>
                <b><a href="/news">NEWS</a></b>
                <b><a href="/about">ABOUT</a></b>
            </div>
        </div>

        <div class="burger clickMenu">
            <div id="backBurger"></div>
            <div class="blackDot"></div>
            <span>MENU</span>
        </div>
    </div>

    <label class="switch" id="apiToggle">
        <p>Toggle Comuni vs SLL</p>
        <input type="checkbox">
        <span class="slider round"></span>
    </label>

    <div id="loadingSpinner">
        <img src="https://i.gifer.com/ZKZg.gif" alt="Loading Spinner">
    </div>

    <script src="app.js"></script>

    <script>
  // Initialize the map
var map = L.map('map').setView([42.682492765949576, 12.552070799113139], 7);
var tiles = L.tileLayer('https://{s}.basemaps.cartocdn.com/light_nolabels/{z}/{x}/{y}{r}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>',
    subdomains: 'abcd',
    maxZoom: 9,
    minZoom: 8
}).addTo(map);

// Global variables
let geotoggle = true;
let api = '/sll';
let geojsonLayers = [];

// Function to show the loading spinner
function showLoadingSpinner() {
    document.getElementById('loadingSpinner').style.display = 'block';
}

// Function to hide the loading spinner
function hideLoadingSpinner() {
    document.getElementById('loadingSpinner').style.display = 'none';
}

// Function to fetch and update GeoJSON layers
function fetchAndUpdateGeoJSON() {
    // Show the loading spinner
    showLoadingSpinner();

    // Clear existing GeoJSON layers from the map
    geojsonLayers.forEach(obj => {
        if (map.hasLayer(obj.layer)) {
            map.removeLayer(obj.layer);
        }
    });
    geojsonLayers = []; // Reset the layers array

    // Fetch data from the API
    fetch(api)
        .then(response => response.json())
        .then(data => {
            data.forEach(place => {
                var geojson = JSON.parse(place.geom);

                // Create a Leaflet GeoJSON layer
                var geojsonLayer = L.geoJSON(geojson, {
                    onEachFeature: function (feature, layer) {
                        layer.bindPopup(place.name); // Bind popup with place name
                    }
                });

                // Store GeoJSON layer in array
                geojsonLayers.push({
                    layer: geojsonLayer,
                    bounds: geojsonLayer.getBounds() // Store the bounds of the GeoJSON layer
                });
            });

            // Function to update visible layers based on map bounds and zoom
            function updateVisibleLayers() {
                var currentZoom = map.getZoom();
                var visibleBounds = map.getBounds();

                geojsonLayers.forEach(obj => {
                    var layer = obj.layer;
                    var bounds = obj.bounds;

                    if (visibleBounds.intersects(bounds)) {
                        // Add layer to map if zoom level is >= 9 and bounds intersect with visible bounds
                        if (!map.hasLayer(layer)) {
                            map.addLayer(layer);
                        }
                    } else {
                        // Remove layer from map if not within zoom level or bounds
                        if (map.hasLayer(layer)) {
                            map.removeLayer(layer);
                        }
                    }
                });
            }

            // Event listener for map zoom and moveend events to update visible layers
            map.on('zoomend moveend', updateVisibleLayers);

            // Initial call to update visible layers
            updateVisibleLayers();

            // Hide the loading spinner once the data is processed
            hideLoadingSpinner();
        })
        .catch(error => {
            console.error('Error fetching GeoJSON data:', error);
            // Hide the loading spinner if there's an error
            hideLoadingSpinner();
        });
}

// Initial data fetch
fetchAndUpdateGeoJSON();

// Function to toggle between APIs
function toggleGeo() {
    geotoggle = !geotoggle;
    api = geotoggle ? '/sll' : '/comuni';

    // Fetch and update data with the new API endpoint
    fetchAndUpdateGeoJSON();
}

// Add event listener for the toggle switch
document.getElementById('apiToggle').addEventListener('change', toggleGeo);


</script>

</body>

</html>