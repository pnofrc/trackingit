<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Dashboard</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

    <link rel="stylesheet" href="style.css" />

    <!-- Leaflet.markercluster CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster/dist/MarkerCluster.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster/dist/MarkerCluster.Default.css" />

    <!-- Leaflet and Leaflet.markercluster JS -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet.markercluster/dist/leaflet.markercluster.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <style>
        .corpus {
            transform: translate3d(-100%, 0, 0)
        }
    </style>
</head>

<body>

    <div id="map"></div>

    <label class="switch" id="apiToggle">
        <p>Toggle Comuni vs SLL</p>
        <input type="checkbox">
        <span class="slider round"></span>
    </label>

    <div id="loadingSpinner" style="display: none;">
        <img src="https://i.gifer.com/ZKZg.gif" alt="Loading Spinner">
    </div>

    <!-- <div id="data-table-container">
        
    </div> -->

    <div id="layers">
        <!-- <span class="title">FILTRI DI RICERCA</span>

        <div class="dataset">
          
            <span>Dataset 1</span>
         

            <p>
                Descrizione breve del dataset e degli obiettivi della raccolta. Descrizione breve del dataset e degli
                obiettivi della raccolta e poi ancora altro.
            </p>

        </div>

        <div class="dataset selected-data">

            <span>Dataset 1</span>


            <div>
                <p>
                    Descrizione breve del dataset e degli obiettivi della raccolta. Descrizione breve del dataset e
                    degli obiettivi della raccolta e poi ancora altro.
                </p>
            </div>

        </div> -->


        <!-- <h2>Area Data</h2> -->
        <table id="data-table" border="1">
            <tbody>
                <tr><th>COD_SLL_2011_2018</th><td id="COD_SLL_2011_2018"></td></tr>
                <tr><th>DEN_SLL_2011_2018</th><td id="DEN_SLL_2011_2018"></td></tr>
                <tr><th>POP11</th><td id="POP11"></td></tr>
                <tr><th>PST11</th><td id="PST11"></td></tr>
                <tr><th>PD11</th><td id="PD11"></td></tr>
                <tr><th>RedMed11</th><td id="RedMed11"></td></tr>
                <tr><th>Dis11</th><td id="Dis11"></td></tr>
                <tr><th>AddTot11</th><td id="AddTot11"></td></tr>
                <tr><th>AddLog11</th><td id="AddLog11"></td></tr>
                <tr><th>QLAdd_IT11</th><td id="QLAdd_IT11"></td></tr>
                <tr><th>ULTot11</th><td id="ULTot11"></td></tr>
                <tr><th>ULLog11</th><td id="ULLog11"></td></tr>
                <tr><th>AddULLog11</th><td id="AddULLog11"></td></tr>
                <tr><th>QLUL_IT11</th><td id="QLUL_IT11"></td></tr>
                <tr><th>PCSuolo12</th><td id="PCSuolo12"></td></tr>
                <tr><th>POP21</th><td id="POP21"></td></tr>
                <tr><th>TPOP11_21</th><td id="TPOP11_21"></td></tr>
                <tr><th>TSM11_21</th><td id="TSM11_21"></td></tr>
                <tr><th>PST21</th><td id="PST21"></td></tr>
                <tr><th>VPST11_21</th><td id="VPST11_21"></td></tr>
                <tr><th>PD21</th><td id="PD21"></td></tr>
                <tr><th>VPD11_21</th><td id="VPD11_21"></td></tr>
                <tr><th>RedMed21</th><td id="RedMed21"></td></tr>
                <tr><th>TRedMed11_21</th><td id="TRedMed11_21"></td></tr>
                <tr><th>Dis21</th><td id="Dis21"></td></tr>
                <tr><th>VDis11_21</th><td id="VDis11_21"></td></tr>
                <tr><th>AddTot21</th><td id="AddTot21"></td></tr>
                <tr><th>TAddTot11_21</th><td id="TAddTot11_21"></td></tr>
                <tr><th>AddLog21</th><td id="AddLog21"></td></tr>
                <tr><th>TAddLog11_21</th><td id="TAddLog11_21"></td></tr>
                <tr><th>QLAdd_IT21</th><td id="QLAdd_IT21"></td></tr>
                <tr><th>VQLAdd_IT11_21</th><td id="VQLAdd_IT11_21"></td></tr>
                <tr><th>ULTot21</th><td id="ULTot21"></td></tr>
                <tr><th>TULTot11_21</th><td id="TULTot11_21"></td></tr>
                <tr><th>AddULTot21</th><td id="AddULTot21"></td></tr>
                <tr><th>VAddULTot11_21</th><td id="VAddULTot11_21"></td></tr>
                <tr><th>ULLog21</th><td id="ULLog21"></td></tr>
                <tr><th>TULLog11_21</th><td id="TULLog11_21"></td></tr>
                <tr><th>AddULLog21</th><td id="AddULLog21"></td></tr>
                <tr><th>VAddULLog11_21</th><td id="VAddULLog11_21"></td></tr>
                <tr><th>QLUL_IT21</th><td id="QLUL_IT21"></td></tr>
                <tr><th>VQLUL_IT11_21</th><td id="VQLUL_IT11_21"></td></tr>
                <tr><th>PCSuolo21</th><td id="PCSuolo21"></td></tr>
                <tr><th>VPCSuolo11_21</th><td id="VPCSuolo11_21"></td></tr>
            </tbody>
        </table>
    </div>

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
            fetch(api)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    data.forEach(place => {
                        var geojson;
                        try {
                            geojson = JSON.parse(place.geom);
                        } catch (e) {
                            console.error('Invalid JSON in place.geom:', place.geom);
                            return;
                        }

                        function getColor(d) {
                            return d > 1000 ? '#800026' :
                                d > 500  ? '#BD0026' :
                                d > 200  ? '#E31A1C' :
                                d > 100  ? '#FC4E2A' :
                                d > 50   ? '#FD8D3C' :
                                d > 20   ? '#FEB24C' :
                                d > 10   ? '#FED976' :
                                            '#FFEDA0';
                        }

                        function style(feature) {
                            return {
                                fillColor: getColor(feature.properties.density),
                                weight: 2,
                                opacity: 1,
                                color: 'white',
                                dashArray: '3',
                                fillOpacity: 0.7
                            };
                        }

                        
                        // Create a Leaflet GeoJSON layer
                        var geojsonLayer = L.geoJSON(geojson, {
                            onEachFeature: function(feature, layer) {
                                // Bind popup with place name (if needed)
                                
                                // Call area data from backend
                                layer.addEventListener('click', () => {
                                    axios.get('/getSllAreaData/' + place.sll_2011)
                                        .then(response => {
                                            // Process and display the data as needed
                                            updateTable(response.data);
                                        })
                                        .catch(error => {
                                            console.error('Error fetching data:',
                                                error);
                                        });
                                });
                            }
                        });
                        // Add the GeoJSON layer to the map
                        geojsonLayer.addTo(map);
                        // Store GeoJSON layer in array
                        geojsonLayers.push({
                            layer: geojsonLayer,
                            bounds: geojsonLayer
                            .getBounds() // Store the bounds of the GeoJSON layer
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
                                // Add layer to map if bounds intersect with visible bounds
                                if (!map.hasLayer(layer)) {
                                    map.addLayer(layer);
                                }
                            } else {
                                // Remove layer from map if not within visible bounds
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
       
                // Function to update the table with fetched data
        function updateTable(data) {
            const fields = [
                'COD_SLL_2011_2018', 'DEN_SLL_2011_2018', 'POP11', 'PST11', 'PD11', 'RedMed11', 'Dis11',
                'AddTot11', 'AddLog11', 'QLAdd_IT11', 'ULTot11', 'ULLog11', 'AddULLog11', 'QLUL_IT11',
                'PCSuolo12', 'POP21', 'TPOP11_21', 'TSM11_21', 'PST21', 'VPST11_21', 'PD21', 'VPD11_21',
                'RedMed21', 'TRedMed11_21', 'Dis21', 'VDis11_21', 'AddTot21', 'TAddTot11_21', 'AddLog21',
                'TAddLog11_21', 'QLAdd_IT21', 'VQLAdd_IT11_21', 'ULTot21', 'TULTot11_21', 'AddULTot21',
                'VAddULTot11_21', 'ULLog21', 'TULLog11_21', 'AddULLog21', 'VAddULLog11_21', 'QLUL_IT21',
                'VQLUL_IT11_21', 'PCSuolo21', 'VPCSuolo11_21'
            ];

            fields.forEach(field => {
                document.getElementById(field).textContent = data[0][field];
            });
        }

    </script>

</body>

</html>