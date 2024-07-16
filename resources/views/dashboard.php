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

    <script src="app.js"></script>

    <script>
    var map = L.map('map').setView([42.682492765949576, 12.552070799113139], 7);
    var tiles = L.tileLayer('https://{s}.basemaps.cartocdn.com/light_nolabels/{z}/{x}/{y}{r}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>',
        subdomains: 'abcd',
        maxZoom: 9,
        minZoom: 6
    });
    tiles.addTo(map);



 function addGeoJSON(url) {
            fetch(url)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`Network response was not ok: ${response.statusText}`);
                    }
                    return response.json();
                })
                .then(data => {
                    // Define a style function to customize polygon styles
                    function style(feature) {
                        return {
                            fillColor: 'green',  // Fill color of polygons
                            weight: 2,  // Border thickness in pixels
                            opacity: 1,  // Border opacity (0 = transparent, 1 = fully opaque)
                            color: 'white',  // Border color
                            fillOpacity: 0.7  // Fill opacity (0 = transparent, 1 = fully opaque)
                        };
                    }

                    // Function to handle click events on polygons
                    function onEachFeature(feature, layer) {
                        if (feature.properties && feature.properties.DEN_SL2011) {
                            layer.bindPopup('<b>' + feature.properties.DEN_SL2011 + '</b><br>SLL 2011: ' + feature.properties.SLL_2011);
                        }
                    }

                    // Add GeoJSON layer with custom style and event handlers
                    L.geoJSON(data, {
                        style: style,
                        onEachFeature: onEachFeature
                    }).addTo(map);

                    // Fit the map to the bounds of the GeoJSON layer
                    map.fitBounds(L.geoJSON(data).getBounds());
                })
                .catch(error => {
                    console.error('Error loading GeoJSON data:', error);
                });
        }

        // Call the function with the URL to your GeoJSON file
        addGeoJSON('/datasets/comuni.geojson');


    // var geojsonLayers = []; // Array to store GeoJSON layers

    // // Fetch data from Laravel controller
    // fetch('/geojson') // Adjust the URL endpoint to match your Laravel route
    //     .then(response => response.json())
    //     .then(data => {
    //         data.forEach(place => {
    //             var geojson = JSON.parse(place.geom);
                
    //             // Create a Leaflet GeoJSON layer
    //             var geojsonLayer = L.geoJSON(geojson, {
    //                 onEachFeature: function (feature, layer) {
    //                     layer.bindPopup(place.name); // Bind popup with place name
    //                 }
    //             });

    //             // Store GeoJSON layer in array
    //             geojsonLayers.push({
    //                 layer: geojsonLayer,
    //                 bounds: geojsonLayer.getBounds() // Store the bounds of the GeoJSON layer
    //             });
    //         });

    //         // Function to update visible layers based on map bounds and zoom
    //         function updateVisibleLayers() {
    //             var currentZoom = map.getZoom();
    //             var visibleBounds = map.getBounds();

    //             geojsonLayers.forEach(obj => {
    //                 var layer = obj.layer;
    //                 var bounds = obj.bounds;

    //                 if (currentZoom >= 9 && visibleBounds.intersects(bounds)) {
    //                     // Add layer to map if zoom level is >= 8 and bounds intersect with visible bounds
    //                     if (!map.hasLayer(layer)) {
    //                         map.addLayer(layer);
    //                     }
    //                 } else {
    //                     // Remove layer from map if not within zoom level or bounds
    //                     if (map.hasLayer(layer)) {
    //                         map.removeLayer(layer);
    //                     }
    //                 }
    //             });
    //         }

    //         // Event listener for map zoom and moveend events to update visible layers
    //         map.on('zoomend moveend', updateVisibleLayers);

    //         // Initial call to update visible layers
    //         updateVisibleLayers();
    //     });
</script>

</body>

</html>