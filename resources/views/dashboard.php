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

        /* Edit ZOOM leaflet */

        .leaflet-bar a {
            border-bottom: none !important
        }

        .leaflet-top,
        .leaflet-left {
            bottom: 3rem !important;
            left: 2rem !important;
            top: unset !important
        }

        .leaflet-control-zoom {
            border: none;
            scale: 1.3;
        }

        .leaflet-control-zoom-in {
            border-top-left-radius: 1rem !important;
            border-top-right-radius: 1rem !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            height: 40px !important;
        }

        .leaflet-control-zoom-out {
            border-bottom-left-radius: 1rem !important;
            border-bottom-right-radius: 1rem !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            height: 40px !important;
        }

        .leaflet-touch .leaflet-bar {
            border: none !important;
        }

        /* Indicators */


        .indicators_dropdown{
            position: relative;
            z-index: 100;
            display: flex;
            gap: 1rem;
        }

        select, .viz{
            background: none;
  border: none;
  background: background: #00000066;


  border-radius: 1rem;
  font-family: 'bold';
  display: flex;
  flex-direction: column;
  width: 200px;
  border-radius: 1rem;
  background: #B9C0C2;
  padding-left: 14px;
  color: white;
  height: 25px;
  display: flex;
  align-items: center;
  justify-content: center
        }

        .viz{
            background: #839196;
            padding-left: 0

        }

        .switch {
            position: relative;
            width: 300px;
            height: 25px;
            z-index: 1000;
        }

        /* .switch p {
            margin-top: 2.5rem;
            width: max-content;
        } */

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
            display: flex;
            align-items: center;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 25px;
            width: 150px;
            background: #839196;
            -webkit-transition: .4s;
            transition: .4s;
        }


        input:checked+.slider:before {
            -webkit-transform: translateX(150px);
            -ms-transform: translateX(150px);
            transform: translateX(150px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 1rem;
        }

        .switch .selection{
            position: relative;
            display: flex;
            z-index: 100;
            justify-content: space-around;
            width: 100%;
            align-items: center;
            height: 100%;
            font-family: 'bold';
            color: #839196
            
        }



        .picking{
            display: flex;
            top: 3rem;
            position: relative;
            left: 2rem;
            gap: 2rem;
            width: 90%;
        }

        .selected{
            color: white;

        }

        select{
            display: flex;
            align-items: center;
        }

        .corpus{
            z-index: 100000;
        }

    </style>
</head>

<body>

<div id="corpus" class="corpus animate__animated">

<div id="fakeMenuBackground"></div>

<div class="blackDot start clickMenu"></div>

<div id="menu">
    <div id="backMenu"></div>

    <div class="internMenu">
        <b><a href="/">HOME</a></b>
        <b><a href="/dashboard">DASHBOARD</a></b>
        <b><a href="/visualization">INDICATORI</a></b>
        <b><a href="/blog">MATERIALI</a></b>
        <b><a class="selected" href="/news">NEWS</a></b>
        <b><a href="/about">ABOUT</a></b>
    </div>
</div>

<div class="burger clickMenu">
    <div id="backBurger"></div>
    <div class="blackDot"></div>
    <span>MENU</span>
    </div>
    </div>

    <div class="picking">

        <label class="switch" id="apiToggle">
            <div class="selection">
                <p id='sll' class="selected">SLL</p><p id='comuni'>COMUNI</p>
            </div>
            <input type="checkbox">
            <span class="slider round"></span>
        </label>

        <div class="indicators_dropdown">
            <div>
                <select id="indicatorSelect1">
                    <option value="POP11">POP11</option>
                    <option value="PST11">PST11</option>
                    <option value="PD11">PD11</option>
                    <option value="RedMed11">RedMed11</option>
                    <!-- Add other indicators as needed -->
                </select>
            </div>
            <div>
                <select id="indicatorSelect2">
                    <option value="NONE">Indicatore 2</option>
                    <option value="POP21">POP21</option>
                    <option value="PST21">PST21</option>
                    <option value="PD21">PD21</option>
                    <option value="RedMed21">RedMed21</option>
                    <!-- Add other indicators as needed -->
                </select>
            </div>
            <button class='viz' onclick="pickIndicators()">Visualizza</button>
        </div>

    </div>

    <div id="map"></div>

    <div id="loadingSpinner" style="display: none;">
        <img src="https://i.gifer.com/ZKZg.gif" alt="Loading Spinner">
    </div>

    <!-- <div id="data-table-container">
        
    </div> -->

    <div class="info-container">
        <div id="info-box">Current Area </div>

        <div id="layers">

            <table id="data-table" border="1">
                <tbody>
                    <tr>
                        <th>COD_SLL_2011_2018</th>
                        <td id="COD_SLL_2011_2018"></td>
                    </tr>
                    <tr>
                        <th>DEN_SLL_2011_2018</th>
                        <td id="DEN_SLL_2011_2018"></td>
                    </tr>
                    <tr>
                        <th>POP11</th>
                        <td id="POP11"></td>
                    </tr>
                    <tr>
                        <th>PST11</th>
                        <td id="PST11"></td>
                    </tr>
                    <tr>
                        <th>PD11</th>
                        <td id="PD11"></td>
                    </tr>
                    <tr>
                        <th>RedMed11</th>
                        <td id="RedMed11"></td>
                    </tr>
                    <tr>
                        <th>Dis11</th>
                        <td id="Dis11"></td>
                    </tr>
                    <tr>
                        <th>AddTot11</th>
                        <td id="AddTot11"></td>
                    </tr>
                    <tr>
                        <th>AddLog11</th>
                        <td id="AddLog11"></td>
                    </tr>
                    <tr>
                        <th>QLAdd_IT11</th>
                        <td id="QLAdd_IT11"></td>
                    </tr>
                    <tr>
                        <th>ULTot11</th>
                        <td id="ULTot11"></td>
                    </tr>
                    <tr>
                        <th>ULLog11</th>
                        <td id="ULLog11"></td>
                    </tr>
                    <tr>
                        <th>AddULLog11</th>
                        <td id="AddULLog11"></td>
                    </tr>
                    <tr>
                        <th>QLUL_IT11</th>
                        <td id="QLUL_IT11"></td>
                    </tr>
                    <tr>
                        <th>PCSuolo12</th>
                        <td id="PCSuolo12"></td>
                    </tr>
                    <tr>
                        <th>POP21</th>
                        <td id="POP21"></td>
                    </tr>
                    <tr>
                        <th>TPOP11_21</th>
                        <td id="TPOP11_21"></td>
                    </tr>
                    <tr>
                        <th>TSM11_21</th>
                        <td id="TSM11_21"></td>
                    </tr>
                    <tr>
                        <th>PST21</th>
                        <td id="PST21"></td>
                    </tr>
                    <tr>
                        <th>VPST11_21</th>
                        <td id="VPST11_21"></td>
                    </tr>
                    <tr>
                        <th>PD21</th>
                        <td id="PD21"></td>
                    </tr>
                    <tr>
                        <th>VPD11_21</th>
                        <td id="VPD11_21"></td>
                    </tr>
                    <tr>
                        <th>RedMed21</th>
                        <td id="RedMed21"></td>
                    </tr>
                    <tr>
                        <th>TRedMed11_21</th>
                        <td id="TRedMed11_21"></td>
                    </tr>
                    <tr>
                        <th>Dis21</th>
                        <td id="Dis21"></td>
                    </tr>
                    <tr>
                        <th>VDis11_21</th>
                        <td id="VDis11_21"></td>
                    </tr>
                    <tr>
                        <th>AddTot21</th>
                        <td id="AddTot21"></td>
                    </tr>
                    <tr>
                        <th>TAddTot11_21</th>
                        <td id="TAddTot11_21"></td>
                    </tr>
                    <tr>
                        <th>AddLog21</th>
                        <td id="AddLog21"></td>
                    </tr>
                    <tr>
                        <th>TAddLog11_21</th>
                        <td id="TAddLog11_21"></td>
                    </tr>
                    <tr>
                        <th>QLAdd_IT21</th>
                        <td id="QLAdd_IT21"></td>
                    </tr>
                    <tr>
                        <th>VQLAdd_IT11_21</th>
                        <td id="VQLAdd_IT11_21"></td>
                    </tr>
                    <tr>
                        <th>ULTot21</th>
                        <td id="ULTot21"></td>
                    </tr>
                    <tr>
                        <th>TULTot11_21</th>
                        <td id="TULTot11_21"></td>
                    </tr>
                    <tr>
                        <th>AddULTot21</th>
                        <td id="AddULTot21"></td>
                    </tr>
                    <tr>
                        <th>VAddULTot11_21</th>
                        <td id="VAddULTot11_21"></td>
                    </tr>
                    <tr>
                        <th>ULLog21</th>
                        <td id="ULLog21"></td>
                    </tr>
                    <tr>
                        <th>TULLog11_21</th>
                        <td id="TULLog11_21"></td>
                    </tr>
                    <tr>
                        <th>AddULLog21</th>
                        <td id="AddULLog21"></td>
                    </tr>
                    <tr>
                        <th>VAddULLog11_21</th>
                        <td id="VAddULLog11_21"></td>
                    </tr>
                    <tr>
                        <th>QLUL_IT21</th>
                        <td id="QLUL_IT21"></td>
                    </tr>
                    <tr>
                        <th>VQLUL_IT11_21</th>
                        <td id="VQLUL_IT11_21"></td>
                    </tr>
                    <tr>
                        <th>PCSuolo21</th>
                        <td id="PCSuolo21"></td>
                    </tr>
                    <tr>
                        <th>VPCSuolo11_21</th>
                        <td id="VPCSuolo11_21"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <script src="app.js"></script>
    <script>
        // get mapped colors
        function mixColor(min1, max1, min2, max2, value1, value2, color1, color2) {
            // Helper function to convert hex color to RGB
            function hexToRgb(hex) {
                let bigint = parseInt(hex.slice(1), 16);
                let r = (bigint >> 16) & 255;
                let g = (bigint >> 8) & 255;
                let b = bigint & 255;
                return [r, g, b];
            }
            // Helper function to convert RGB to hex color
            function rgbToHex(r, g, b) {
                return "#" + ((1 << 24) + (r << 16) + (g << 8) + b).toString(16).slice(1).toUpperCase();
            }
            // If value2 is not provided, use color1 for both colors
            if (value2 === undefined || color2 === undefined) {
                // Convert color1 to RGB
                let rgb1 = hexToRgb(color1);
                // Calculate the weight for value1
                let weight1 = (value1 - min1) / (max1 - min1);
                // Compute the resulting color based only on color1
                let r = Math.round(rgb1[0] * (1 - weight1));
                let g = Math.round(rgb1[1] * (1 - weight1));
                let b = Math.round(rgb1[2] * (1 - weight1));
                return rgbToHex(r, g, b);
            }
            // Calculate the weight for each value in its range
            let weight1 = (value1 - min1) / (max1 - min1);
            let weight2 = (value2 - min2) / (max2 - min2);
            // Average the two weights
            let mixWeight = (weight1 + weight2) / 2;
            // Convert colors to RGB
            let rgb1 = hexToRgb(color1);
            let rgb2 = hexToRgb(color2);
            // Mix the two colors based on the mixWeight
            let mixedR = Math.round(rgb1[0] * (1 - mixWeight) + rgb2[0] * mixWeight);
            let mixedG = Math.round(rgb1[1] * (1 - mixWeight) + rgb2[1] * mixWeight);
            let mixedB = Math.round(rgb1[2] * (1 - mixWeight) + rgb2[2] * mixWeight);
            // Convert the mixed RGB color back to hex
            return rgbToHex(mixedR, mixedG, mixedB);
        }
        // Initialize the map
        var map = L.map('map').setView([42.682492765949576, 12.552070799113139], 7);
        var tiles = L.tileLayer('https://{s}.basemaps.cartocdn.com/light_nolabels/{z}/{x}/{y}{r}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>',
            subdomains: 'abcd',
            maxZoom: 9,
            minZoom: 7
        }).addTo(map);
        // Global variables
        let geotoggle = true;
        let api = 'Sll';
        let geojsonLayers = [];
        // Function to show the loading spinner
        function showLoadingSpinner() {
            document.getElementById('loadingSpinner').style.display = 'block';
        }
        // Function to hide the loading spinner
        function hideLoadingSpinner() {
            document.getElementById('loadingSpinner').style.display = 'none';
        }

        function getIndicatorsData(indicator1Name, indicator2Name) {
            // Show the loading spinner
            showLoadingSpinner();
            // Clear existing GeoJSON layers from the map
            geojsonLayers.forEach(obj => {
                if (map.hasLayer(obj.layer)) {
                    map.removeLayer(obj.layer);
                }
            });
            geojsonLayers = []; // Reset the layers array
            // Fetch the range (min and max) for both indicators
            const range1Promise = axios.get(`/getIndicatorRange/${indicator1Name}`).then(response => response.data);
            const range2Promise = axios.get(`/getIndicatorRange/${indicator2Name}`).then(response => response.data);
            // Wait for both promises to resolve
            Promise.all([range1Promise, range2Promise]).then(([range1, range2]) => {
                const min1 = range1.min;
                const max1 = range1.max;
                const min2 = range2.min;
                const max2 = range2.max;
                fetch('/get' + api + 'IndicatorsData/' + indicator1Name + '+' + indicator2Name)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(place => {
                            var geojson;
                            try {
                                geojson = JSON.parse(place.geom);
                            } catch (e) {
                                console.error('Invalid JSON in place.geom:', place.geom);
                                return;
                            }
                            let place2data
                            // Assuming place has 'value1' and 'value2' for the two indicators
                            if (place[indicator2Name]) {
                                place2data = place[indicator2Name]
                            } else {
                                place2data = undefined
                            }
                            let color = mixColor(min1, max1, min2, max2, place[indicator1Name],
                                place2data, '#ff0000', '#00ff00');

                            function style(feature) {
                                return {
                                    fillColor: color, // Fill color based on the first value
                                    weight: 2,
                                    opacity: 1,
                                    color: '#ffffff', // Border color set to white
                                    dashArray: '3',
                                    fillOpacity: 0.7,
                                };
                            }
                            // Reference to the external div
                            let infoBox = document.getElementById('info-box');

                            function onEachFeature(feature, layer) {
                                // Define the behavior for when the mouse is over the layer
                                layer.on('mouseover', (e) => {
                                    // Show the external div and update its content
                                    infoBox.innerHTML = 'Current Area: ' + place
                                        .DEN_SLL_2011_2018;
                                    // Optionally, change the style of the layer
                                    e.target.setStyle({
                                        fillOpacity: 0.2
                                    });
                                });
                                // Define the behavior for when the mouse leaves the layer
                                layer.on('mouseout', (e) => {
                                    // Hide the external div
                                    infoBox.innerHTML = 'Current Area: '
                                    // Reset the style of the layer
                                    e.target.setStyle({
                                        fillOpacity: 0.7
                                    });
                                });
                                // Define the behavior for when the layer is clicked
                                layer.on('click', () => {
                                    document.getElementById('layers').style.display =
                                        'block'
                                    axios.get('/get' + api + 'AreaData/' + place.sll_2011)
                                        .then(response => {
                                            updateTable(response.data);
                                        })
                                        .catch(error => {
                                            console.error('Error fetching data:',
                                                error);
                                        });
                                });
                            }
                            var geojsonLayer = L.geoJSON(geojson, {
                                style: style,
                                onEachFeature: onEachFeature
                            });
                            geojsonLayer.addTo(map);
                            geojsonLayers.push({
                                layer: geojsonLayer,
                                bounds: geojsonLayer.getBounds()
                            });
                        });

                        function updateVisibleLayers() {
                            var currentZoom = map.getZoom();
                            var visibleBounds = map.getBounds();
                            geojsonLayers.forEach(obj => {
                                var layer = obj.layer;
                                var bounds = obj.bounds;
                                if (visibleBounds.intersects(bounds)) {
                                    if (!map.hasLayer(layer)) {
                                        map.addLayer(layer);
                                    }
                                } else {
                                    if (map.hasLayer(layer)) {
                                        map.removeLayer(layer);
                                    }
                                }
                            });
                        }
                        map.on('zoomend moveend', updateVisibleLayers);
                        updateVisibleLayers();
                        hideLoadingSpinner();
                    })
                    .catch(error => {
                        console.error('Error fetching GeoJSON data:', error);
                        hideLoadingSpinner();
                    });
            }).catch(error => {
                console.error('Error fetching indicator ranges:', error);
                hideLoadingSpinner();
            });
        }

        function pickIndicators() {
            const indicator1Name = document.getElementById('indicatorSelect1').value;
            const indicator2Name = document.getElementById('indicatorSelect2').value;
            getIndicatorsData(indicator1Name, indicator2Name)
        }
        pickIndicators()
        // Function to toggle between APIs
        function toggleGeo() {
            geotoggle = !geotoggle;
            api = geotoggle ? 'Sll' : 'comuni';
            document.getElementById('comuni').classList.toggle('selected')
            document.getElementById('sll').classList.toggle('selected')
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