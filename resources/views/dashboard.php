<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <!-- <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
        /> -->

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
                <b class="selected"><a href="/dashboard">DASHBOARD</a></b>
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
        // map
        var map = L.map('map').setView([42.682492765949576, 12.552070799113139], 7);
        var tiles = L.tileLayer(
            'https://server.arcgisonline.com/ArcGIS/rest/services/World_Terrain_Base/MapServer/tile/{z}/{y}/{x}', {
                attribution: 'Tiles &copy; Esri &mdash; Source: USGS, Esri, TANA, DeLorme, and NPS',
                maxZoom: 9,
                minZoom: 6
            });
        tiles.addTo(map);
    </script>
</body>

</html>