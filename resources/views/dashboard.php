<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Tracking-it | Dashboard</title>
    <meta name="description"
        content="TRACKING-IT is a research project invastigating the new Italian Geographies of logistics.">
    <meta name="author" content="Politecnico di Torino, Politecnico di Milano, Gran Sasso Science Institute">
    <meta name="robots" content="index, follow">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <meta name="og:image" content="http://tr.acking.it/assets/up-mobile.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

    <link rel="stylesheet" href="style.css" />

    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster/dist/MarkerCluster.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster/dist/MarkerCluster.Default.css" />

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


        .indicators_dropdown {
            position: relative;
            z-index: 100;
            display: flex;
            gap: 1rem;
        }

        select,
        .viz, #translate {
            background: none;
            border: none;
            background:  #00000066;
            width: 13vw


            border-radius: 1rem;
            display: flex;
            flex-direction: column;
            border-radius: 1rem;
            background: #B9C0C2;
            padding-left: 14px;
            color: white;
            height: 25px;
            display: flex;
            align-items: center;
            justify-content: center
        }

        #translate{
            height: unset
        }

        .viz {
            background: #839196;
            padding-left: 0
        }

        .switch {
            position: relative;
            width: 420px;
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
            width: 200px;
            background: #839196;
            -webkit-transition: .4s;
            transition: .4s;
        }


        input:checked+.slider:before {
            -webkit-transform: translateX(220px);
            -ms-transform: translateX(220px);
            transform: translateX(220px);
        }

        

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 1rem;
        }

        .switch .selection {
            position: relative;
            display: flex;
            z-index: 100;
            width: 100%;
            align-items: center;
            height: 100%;
            color: #839196;

        }


        .switch .selection p, .switch .selection a{
            text-align: center;
            width: 100%;
            margin: 0 auto;
            z-index: 100000 ;
            color: var(--text);
        text-decoration: none        }

        #indicatorSelect1,option{
            text-align: center;
        }


        .indicators_dropdown div select,
        button,
        .switch {
            cursor: pointer
        }

        .download{
            cursor: pointer;
        }

        .stanchezza{
            display: flex;
            flex-direction: column;
        }

        .picking {
            display: flex;
            top: 3rem;
            position: relative;
            left: 2rem;
            gap: 1rem;
            width: 90%;
            flex-direction: column;
        }

        .selected {
            color: white;

        }

        select {
            display: flex;
            align-items: center;
        }

        .corpus {
            z-index: 100000;
        }


        .leaflet-control-zoom{
            display: none
        }
    </style>
</head>

<body>

    <div id="corpus" class="corpus animate__animated ">

        <div id="fakeMenuBackground"></div>

        <div class="blackDot start clickMenu"></div>

        <div id="menu">
            <div id="backMenu"></div>

            <div class="internMenu">
                <b><a href="/">HOME</a></b>
                <b><a class="selected" href="/dashboard">DASHBOARD</a></b>
                <b><a href="/data">DATA</a></b>
                <b><a href="/info-sheets">INFO SHEETS</a></b>
                <b><a href="/news">NEWS</a></b>
                <b><a href="/about">ABOUT</a></b>
            </div>
        </div>

        <div class="burger animate__animated clickMenu">
            <div id="backBurger"></div>
            <div class="blackDot"></div>
            <span>MENU</span>
        </div>
    </div>

    <div class="picking">

        <div class="stanchezza">
        <label class="switch">
                <div class="selection">
                    <a href="/datasets/DB_SSL_TRACKING-IT_Dahsboard.csv" download class="download">Download Dataset</a>
                    <a href="/datasets/dbComuni_LOGISTICA_dashboard.csv" download class="download">Download Dataset</a>
                </div>
            </label>


            <label class="switch" id="apiToggle">
                <div class="selection">
                    <p id='sll' class="selected">SLL</p>
                    <p id='comuni'>MUNICIPALITIES</p>
                </div>
                <input type="checkbox">
                <span class="slider round"></span>
            </label>
        </div>

        <div class="indicators_dropdown">
                <select id="indicatorSelect1">
                    <option value="POP21">Popolazione Totale 2021</option>
                    <option value="TPOP01_21">Trend Popolazione Totale 2001-2021</option>
                    <option value="TPOP11_21">Trend Popolazione Totale 2011-2021</option>
                    <option value="PST21">Perc. Pop. Straniera Residente 2021</option>
                    <option value="VPST01_21">Variazione Perc. Pop. Straniera Residente 2001-2021</option>
                    <option value="VPST11_21">Variazione Perc. Pop. Straniera Residente 2011-2021</option>
                    <option value="PIS21">Perc. Pop. con Istruzione Superiore 2021</option>
                    <option value="VPIS01_21">Variazione Perc. Pop. con Istruzione Superiore 2001-2021</option>
                    <option value="VPIS11_21">Variazione Perc. Pop. con Istruzione Superiore 2011-2021</option>
                    <option value="RedMed21">Reddito Medio 2021</option>
                    <option value="TRedMed01_21">Trend Reddito Medio 2001-2021</option>
                    <option value="TRedMed11_21">Trend Reddito Medio 2011-2021</option>
                    <option value="Dis21">Tasso di Disoccupazione 2021</option>
                    <option value="VDis11_21">Variazione Tasso di Disoccupazione 2011-2021</option>
                    <option value="AddLog21">Addetti Logistica 2021</option>
                    <option value="TAddLog01_21">Trend Addetti Logistica 2001-2021</option>
                    <option value="TAddLog11_21">Trend Addetti Logistica 2011-2021</option>
                    <option value="XAdd_21">Perc. Addetti Logistica sul Totale Addetti 2021</option>
                    <option value="VXAdd_01_21">Variazione Perc. Addetti Logistica 2001-2021</option>
                    <option value="VXAdd_11_21">Variazione Perc. Addetti Logistica 2011-2021</option>
                    <option value="QLAdd_IT01">Quoziente di Localizzazione 2001</option>
                    <option value="QLAdd_IT11">Quoziente di Localizzazione 2011</option>
                    <option value="QLAdd_IT21">Quoziente di Localizzazione 2021</option>
                    <option value="VQLAdd_IT01_21">Variazione QL 2001-2021</option>
                    <option value="VQLAdd_IT11_21">Variazione QL 2011-2021</option>
                    <option value="StCAT21">Stock Catastale D01/D07 sulle UIU 2021</option>
                    <option value="UIU13_21">Variazione UIU su Stock Totale 2013-2021</option>
                    <option value="Imm21">Valori Immobiliari Capannoni 2021</option>
                    <option value="VImm13_21">Variazione Valori Immobiliari Capannoni 2013-2021</option>
                </select>
        </div>

    </div>

    <div id="map"></div>

    <div id="loadingSpinner" style="display: none;">
        <img src="https://i.gifer.com/ZKZg.gif" alt="Loading Spinner">
    </div>

    <div class="info-container">
        <div id="info-box">Current Area </div>

        <div id="layers">

            <table id="data-table" border="1">
                <tbody>

                    <!-- <tr>
                        <th id="ID">ID</th> <td id="id-data"></td>
                    </tr> -->
                    <tr>
                        <th id="Nome">NOME</th> <td id="name-data"></td>
                    </tr>
                    <tr>
                        <th id="Popolazione Totale 2021">Popolazione Totale 2021</th>
                        <td id="POP21"></td>
                    </tr>
                    <tr>
                        <th id="Trend Popolazione Totale 2001-2021">Trend Popolazione Totale 2001-2021</th>
                        <td id="TPOP01_21"></td>
                    </tr>
                    <tr>
                        <th id="Trend Popolazione Totale 2011-2021">Trend Popolazione Totale 2011-2021</th>
                        <td id="TPOP11_21"></td>
                    </tr>
                    <tr>
                        <th id="Percentuale Popolazione Straniera Residente 2021">Perc. Pop. Straniera Residente 2021</th>
                        <td id="PST21"></td>
                    </tr>
                    <tr>
                        <th id="Variazione Percentuale Popolazione Straniera Residente 2001-2021">Variazione Perc. Pop. Straniera Residente 2001-2021</th>
                        <td id="VPST01_21"></td>
                    </tr>
                    <tr>
                        <th id="Variazione Percentuale Popolazione Straniera Residente 2011-2021">Variazione Perc. Pop. Straniera Residente 2011-2021</th>
                        <td id="VPST11_21"></td>
                    </tr>
                    <tr>
                        <th id="Percentuale Popolazione con Istruzione Superiore (Diplomati + Laureati) 2021">Perc. Pop. con Istruzione Superiore 2021</th>
                        <td id="PIS21"></td>
                    </tr>
                    <tr>
                        <th id="Variazione Percentuale popolazione con Istruzione Superiore (Diplomati + Laureati) 2001-2021">Variazione Perc. Pop. con Istruzione Superiore 2001-2021</th>
                        <td id="VPIS01_21"></td>
                    </tr>
                    <tr>
                        <th id="Variazione Percentuale popolazione con Istruzione Superiore (Diplomati + Laureati) 2001-2021">Variazione Perc. Pop. con Istruzione Superiore 2011-2021</th>
                        <td id="VPIS11_21"></td>
                    </tr>
                    <tr>
                        <th id="Reddito Medio 2021">Reddito Medio 2021</th>
                        <td id="RedMed21"></td>
                    </tr>
                    <tr>
                        <th id="Trend Reddito Medio 2001-2021">Trend Reddito Medio 2001-2021</th>
                        <td id="TRedMed01_21"></td>
                    </tr>
                    <tr>
                        <th id="Trend Reddito Medio 2011-2021">Trend Reddito Medio 2011-2021</th>
                        <td id="TRedMed11_21"></td>
                    </tr>
                    <tr>
                        <th id="Tasso di Disoccupazione 2021">Tasso di Disoccupazione 2021</th>
                        <td id="Dis21"></td>
                    </tr>
                    <tr>
                        <th id="Variazione Tasso di Disoccupazione 2011-2021">Variazione Tasso di Disoccupazione 2011-2021</th>
                        <td id="VDis11_21"></td>
                    </tr>
                    <tr>
                        <th id="Addetti Logistica 2021">Addetti Logistica 2021</th>
                        <td id="AddLog21"></td>
                    </tr>
                    <tr>
                        <th id="Trend Addetti Logistica 2001-2021">Trend Addetti Logistica 2001-2021</th>
                        <td id="TAddLog01_21"></td>
                    </tr>
                    <tr>
                        <th id="Trend Addetti Logistica 2011-2021">Trend Addetti Logistica 2011-2021</th>
                        <td id="TAddLog11_21"></td>
                    </tr>
                    <tr>
                        <th id="Addetti Logistica sul Totale Addetti Comunale 2021">Perc. Addetti Logistica sul Totale Addetti 2021</th>
                        <td id="XAdd_21"></td>
                    </tr>
                    <tr>
                        <th id="Variazione Addetti Logistica sul Totale Addetti Comunale 2001-2021">Variazione Perc. Addetti Logistica 2001-2021</th>
                        <td id="VXAdd_01_21"></td>
                    </tr>
                    <tr>
                        <th id="Variazione Addetti Logistica sul Totale Addetti Comunale 2011-2021">Variazione Perc. Addetti Logistica 2011-2021</th>
                        <td id="VXAdd_11_21"></td>
                    </tr>
                    <tr>
                        <th id="Quoziente di Localizzazione Addetti Comunale in Relazione all'Indice Nazionale 2001">Quoziente di Localizzazione 2001</th>
                        <td id="QLAdd_IT01"></td>
                    </tr>
                    <tr>
                        <th id="Quoziente di Localizzazione Addetti Comunale in Relazione all'Indice Nazionale 2011">Quoziente di Localizzazione 2011</th>
                        <td id="QLAdd_IT11"></td>
                    </tr>
                    <tr>
                        <th id="Quoziente di Localizzazione Addetti Comunale in Relazione all'Indice Nazionale 2021">Quoziente di Localizzazione 2021</th>
                        <td id="QLAdd_IT21"></td>
                    </tr>
                    <tr>
                        <th id="Variazione Quoziente di Localizzazione Addetti Comunale in Relazione all'Indice Nazionale 2001-2021">Variazione QL 2001-2021</th>
                        <td id="VQLAdd_IT01_21"></td>
                    </tr>
                    <tr>
                        <th id="Variazione Quoziente di Localizzazione Addetti Comunale in Relazione all'Indice Nazionale 2011-2021">Variazione QL 2011-2021</th>
                        <td id="VQLAdd_IT11_21"></td>
                    </tr>
                    <tr>
                        <th id="Stock Catastale D01 e D07 sulle UIU 2013-2021">Stock Catastale D01/D07 sulle UIU 2021</th>
                        <td id="StCAT21"></td>
                    </tr>
                    <tr>
                        <th id="Variazione UIU su Stock Totale 2021-2013">Variazione UIU su Stock Totale 2013-2021</th>
                        <td id="UIU13_21"></td>
                    </tr>
                    <tr>
                        <th id="Valori Immobiliari Capannoni 2021">Valori Immobiliari Capannoni 2021</th>
                        <td id="Imm21"></td>
                    </tr>
                    <tr>
                        <th id="Variazione Valori Immobiliari Capannoni 2013-2021">Variazione Valori Immobiliari Capannoni 2013-2021</th>
                        <td id="VImm13_21"></td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>

    <script src="app.js"></script>
    <script defer async>

        const indicatorMap = {
            'POP21': 'Popolazione Totale 2021',
            'TPOP01_21': 'Trend Popolazione Totale 2001-2021',
            'TPOP11_21': 'Trend Popolazione Totale 2011-2021',
            'PST21': 'Perc. Pop. Straniera Residente 2021',
            'VPST01_21': 'Variazione Perc. Pop. Straniera Residente 2001-2021',
            'VPST11_21': 'Variazione Perc. Pop. Straniera Residente 2011-2021',
            'PIS21': 'Perc. Pop. con Istruzione Superiore 2021',
            'VPIS01_21': 'Variazione Perc. Pop. con Istruzione Superiore 2001-2021',
            'VPIS11_21': 'Variazione Perc. Pop. con Istruzione Superiore 2011-2021',
            'RedMed21': 'Reddito Medio 2021',
            'TRedMed01_21': 'Trend Reddito Medio 2001-2021',
            'TRedMed11_21': 'Trend Reddito Medio 2011-2021',
            'Dis21': 'Tasso di Disoccupazione 2021',
            'VDis11_21': 'Variazione Tasso di Disoccupazione 2011-2021',
            'AddLog21': 'Addetti Logistica 2021',
            'TAddLog01_21': 'Trend Addetti Logistica 2001-2021',
            'TAddLog11_21': 'Trend Addetti Logistica 2011-2021',
            'XAdd_21': 'Perc. Addetti Logistica sul Totale Addetti 2021',
            'VXAdd_01_21': 'Variazione Perc. Addetti Logistica 2001-2021',
            'VXAdd_11_21': 'Variazione Perc. Addetti Logistica 2011-2021',
            'QLAdd_IT01': 'Quoziente di Localizzazione 2001',
            'QLAdd_IT11': 'Quoziente di Localizzazione 2011',
            'QLAdd_IT21': 'Quoziente di Localizzazione 2021',
            'VQLAdd_IT01_21': 'Variazione QL 2001-2021',
            'VQLAdd_IT11_21': 'Variazione QL 2011-2021',
            'StCAT21': 'Stock Catastale D01/D07 sulle UIU 2021',
            'UIU13_21': 'Variazione UIU su Stock Totale 2013-2021',
            'Imm21': 'Valori Immobiliari Capannoni 2021',
            'VImm13_21': 'Variazione Valori Immobiliari Capannoni 2013-2021'
        };


fetch('/comuni')
            .then(response => response.json())
            .then(data => {
                console.log(data)
            })


        // get mapped colors
        function mixColor(min1, max1, value1, color1) {
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
            
            // Calculate the weight for value1 (normalized between 0 and 1)
            let weight1 = (value1 - min1) / (max1 - min1);

            // Define the minimum color (light gray/white) for interpolation
            const rgbMin = [240, 240, 240]; 
            // Define the maximum color (color1: '#3FC692')
            const rgbMax = hexToRgb(color1);

            // Linear interpolation: (1 - weight) * min_color + weight * max_color
            let r = Math.round(rgbMin[0] * (1 - weight1) + rgbMax[0] * weight1);
            let g = Math.round(rgbMin[1] * (1 - weight1) + rgbMax[1] * weight1);
            let b = Math.round(rgbMin[2] * (1 - weight1) + rgbMax[2] * weight1);

            return rgbToHex(r, g, b);
        }
        
        // Initialize the map
        var map = L.map('map').setView([42.682492765949576, 12.552070799113139], 6);
        var tiles = L.tileLayer('https://{s}.basemaps.cartocdn.com/light_nolabels/{z}/{x}/{y}{r}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>',
            subdomains: 'abcd',
            maxZoom: 15,
            minZoom: 6
        }).addTo(map);




        // Show interports on the map

        map.createPane('topPane');
        map.getPane('topPane').style.zIndex = 650;
        fetch('/getInterports')
            .then(response => response.json())
            .then(data => {
                data.forEach(interport => {
                    const geoJSONGeom = JSON.parse(interport.geom);

                    // Assumi che sia un Point (per usare L.circleMarker su punti)
                    if (geoJSONGeom.type === 'Point') {
                        const coordinates = geoJSONGeom.coordinates;

                        // Crea il marker nel pane 'topPane' per mantenerlo in cima
                        const marker = L.circleMarker([coordinates[1], coordinates[0]], {
                            pane: 'topPane',   // Specifica che questo marker va nel pane 'topPane'
                            radius: 8,         // Dimensione del cerchio
                            color: '#800080',  // Colore del bordo (viola)
                            fillColor: '#800080', // Colore di riempimento (viola)
                            fillOpacity: 0.7   // Trasparenza del riempimento
                        }).addTo(map);

                        // Aggiungi un popup con il nome e la città dell'interport
                        marker.bindPopup(`
                    <strong>${interport.name}</strong><br>
                    <em>${interport.city}</em>
                `);
                    }
                });
            })
            .catch(error => console.error('Error loading interports:', error));


        map.createPane('topPane2');
        map.getPane('topPane2').style.zIndex = 640;

        // Show highways on the map
        fetch('/getHighways')
            .then(response => response.json())
            .then(data => {
                data.forEach(highway => {
                    const geoJSONGeom = JSON.parse(highway.geom); // Converte da stringa JSON a oggetto GeoJSON
                    L.geoJSON(geoJSONGeom, {
                        style: {
                            pane: 'topPane2',
                            color: '#8668B2',
                            weight: 2,
                            opacity: 1,
                            fillOpacity: 1
                        }
                    }).addTo(map);
                })
            }).catch(error => console.error('Error loading static GeoJSON 1:', error));



        // Global variables
        let geotoggle = false;
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

        function getIndicatorsData(indicator1Name) { // Funzione modificata per un solo indicatore
            // Show the loading spinner
            showLoadingSpinner();
            // Clear existing GeoJSON layers from the map
            geojsonLayers.forEach(obj => {
                if (map.hasLayer(obj.layer)) {
                    map.removeLayer(obj.layer);
                }
            });
            geojsonLayers = []; // Reset the layers array
            // Fetch the range (min and max) for the indicator
            // Chiamata modificata per includere il tipo di API (Sll/Comuni)
            const range1Promise = axios.get(`/getIndicatorRange/${api}/${indicator1Name}`).then(response => response.data);
            
            // Wait for the promise to resolve
            Promise.all([range1Promise]).then(([range1]) => {
                const min1 = range1.min;
                const max1 = range1.max;
                const color= '#3FC692';

                updateDynamicLegend(indicator1Name, min1, max1, color);

                // Modificata la rotta per recuperare i dati solo del primo indicatore
                fetch('/get' + api + 'IndicatorsData/' + indicator1Name) 
                    .then(response => {
                         if (!response.ok) {
                            // Se la risposta non è OK, lancia un errore con il testo della risposta
                            return response.text().then(text => { 
                                throw new Error('Server returned an error status. Response body (HTML/Text) received: ' + text.substring(0, 200) + '...');
                            });
                        }
                        return response.json();
                    })
                    .then(data => {
                        data.forEach(place => {
                            if (!place.geom) {
                                console.warn('Missing geom for place:', place);
                                return; 
                            }
                            let geojson;
                            try {
                                geojson = JSON.parse(place.geom);
                            } catch (e) {
                                console.error('Error parsing GeoJSON geometry:', e, 'Data:', place.geom);
                                return; // Skip this place if JSON is invalid
                            }
                            
                            // Call mixColor with a single indicator
                            let color = mixColor(min1, max1, place[indicator1Name], '#3FC692');

                            function style(feature) {
                                return {
                                    fillColor: color, // Fill color based on the value
                                    weight: 1,
                                    opacity: 1,
                                    color: '#ffffff', // Border color set to white
                                    dashArray: '1',
                                    fillOpacity: 1,
                                };
                            }
                            // Reference to the external div
                            let infoBox = document.getElementById('info-box');

                            function onEachFeature(feature, layer) {
                                // Define the behavior for when the mouse is over the layer
                                layer.on('mouseover', (e) => { 
                                
                                    // Show the external div and update its content
                                    if (api == 'Sll') {
                                        infoBox.innerHTML = 'Current Area: ' + place.DEN_SLL_2011_2018;
                                       
                                    } else {
                                        infoBox.innerHTML = 'Current Area: ' + place.COMUNE;
                                    }
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
                                        fillOpacity: 1
                                    });
                                });
                                // Define the behavior for when the layer is clicked
                                layer.on('click', () => {
                                    document.getElementById('layers').style.display =
                                        'block'
                                    if (api == 'Sll') {
                                        axios.get('/get' + api + 'AreaData/' + place.sll_2011)
                                            .then(response => {
                                                updateTable(response.data);
                                            })
                                            .catch(error => {
                                                console.error('Error fetching data:',
                                                    error);
                                            });
                                    } else {
                                        axios.get('/get' + api + 'Data/' + place.municipality_code)
                                            .then(response => {
                                                updateTable(response.data);
                                            })
                                            .catch(error => {
                                                console.error('Error fetching data:',
                                                    error);
                                            });
                                    }

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
            // Chiamata a getIndicatorsData con un solo argomento
            getIndicatorsData(indicator1Name)
        }

        // CHIAMATA INIZIALE
        pickIndicators()

        // Event listener per cambiare la mappa quando si cambia l'indicatore
        document.getElementById('indicatorSelect1').addEventListener('change', pickIndicators);

        // Function to toggle between APIs
        function toggleGeo() {
            // Leggi lo stato del checkbox per decidere l'API
            const checkbox = document.querySelector('#apiToggle input[type="checkbox"]');
            geotoggle = checkbox.checked; // true se checked (Comuni), false se unchecked (Sll)
            
            // Aggiorna la variabile globale api
            api = geotoggle ? 'Comuni' : 'Sll' 
            
            // Aggiorna le classi 'selected' basandosi sul nuovo stato 'api'
            document.getElementById('comuni').classList.toggle('selected', api === 'Comuni');
            document.getElementById('sll').classList.toggle('selected', api === 'Sll');
            
            // Fetch and update data with the new API endpoint
            pickIndicators()
        }   

        // Add event listener for the toggle switch
document.querySelector('#apiToggle input[type="checkbox"]').addEventListener('change', toggleGeo);

        // Funzione per aggiornare la tabella con i dati recuperati
        function updateTable(data) {
            const fields = [
                 'name-data', 'POP21', 'TPOP01_21', 'TPOP11_21', 'PST21',
                'VPST01_21', 'VPST11_21', 'PIS21', 'VPIS01_21', 'VPIS11_21', 'RedMed21', 'TRedMed01_21',
                'TRedMed11_21', 'Dis21', 'VDis11_21', 'AddLog21', 'TAddLog01_21', 'TAddLog11_21',
                'XAdd_21', 'VXAdd_01_21', 'VXAdd_11_21', 'QLAdd_IT01', 'QLAdd_IT11', 'QLAdd_IT21',
                'VQLAdd_IT01_21', 'VQLAdd_IT11_21', 'StCAT21', 'UIU13_21', 'Imm21', 'VImm13_21'
            ];
            fields.forEach(field => {
                let originalField = field
                if(field == "id-data"){
                    if (api == 'Sll') {
                        field = 'COD_SLL_2011_2018'
                    } else {
                        field = 'PRO_COM'
                    }
                    
                    
                    
                } else if(field == 'name-data'){

                    if (api == 'Sll') {
                        field = 'DEN_SLL_2011_2018'
                    } else {
                        field = 'COMUNE'
                    }
                }
                document.getElementById(originalField).textContent = data[0][field];
            });
        }




        // Global variable to store the legend control
        let legend;

        // Funzione per creare e aggiungere il controllo legenda
        function addLegendControl() {
            // Rimuovi la legenda esistente se presente
            if (legend && map.hasControl(legend)) {
                map.removeControl(legend);
            }

            legend = L.control({ position: 'bottomleft' });

            legend.onAdd = function (map) {
                // Crea il div contenitore della legenda
                const div = L.DomUtil.create('div', 'info legend');
                div.style.backgroundColor = 'white';
                div.style.padding = '10px';
                div.style.marginLeft = '0px';
                div.style.borderRadius = '5px';
                div.style.boxShadow = '0 0 15px rgba(0,0,0,0.2)';
                div.style.width = '190px'; // Limita la larghezza
                div.innerHTML = '<div id="dynamic-indicator-legend"></div>' +
                                '<div id="fixed-layers-legend"></div>';
                return div;
            };

            legend.addTo(map);

            // Popola le voci fisse per gli shapefile sovraimpressi
            updateFixedLayersLegend();
        }

        // Chiama la funzione per aggiungere la legenda all'avvio
        addLegendControl();

        // Funzione per aggiornare le voci fisse (Highways e Interports)
        function updateFixedLayersLegend() {
            const fixedDiv = document.getElementById('fixed-layers-legend');
            if (!fixedDiv) return;

                // <span style="margin-bottom: 5px; display: block;">Overlay Layers:</span>

            fixedDiv.innerHTML = `
            <br>
                <i style="background: #800080; width: 10px; height: 10px; border-radius: 50%; display: inline-block; margin-right: 5px;"></i> Interports<br>
                <i style="background: #8668B2; width: 15px; height: 3px; display: inline-block; margin-right: 5px;"></i> Highways
            `;
        }




        // Funzione per aggiornare la parte dinamica (indicatore selezionato) della legenda
function updateDynamicLegend(indicatorCode, minVal, maxVal, color) {
    const dynamicDiv = document.getElementById('dynamic-indicator-legend');
    if (!dynamicDiv) return;

    // Recupera il nome leggibile dall'oggetto indicatorMap
    const indicatorName = indicatorMap[indicatorCode] || indicatorCode;

    const minColor = 'rgb(240, 240, 240)';
    const maxColor = color; 
    let m = parseFloat(minVal).toFixed(2)
    let M = parseFloat(maxVal).toFixed(2)

    dynamicDiv.innerHTML = `
        <span style="margin-bottom: 5px; display: block;">${indicatorName}</span>
        <div style="
            height: 15px; 
            background: linear-gradient(to right, ${minColor}, ${maxColor});
            border: 1px solid #ccc;
            margin-bottom: 3px;
        "></div>
        <div style="display: flex; justify-content: space-between; font-size: 12px;">
            <span style="font-weight: bold;">${m}</span>
            <span style="font-weight: bold;">${M}</span>
        </div>
    `;
}
    </script>

</body>

</html>