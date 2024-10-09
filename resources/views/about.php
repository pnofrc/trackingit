<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <title>Tracking-it | About</title>
    <meta name="description"
        content="TRACKING-IT is a research project invastigating the new Italian Geographies of logistics.">
    <meta name="author" content="Politecnico di Torino, Politecnico di Milano, Gran Sasso Science Institute">
    <meta name="robots" content="index, follow">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <meta name="og:image" content="http://tr.acking.it/assets/up-mobile.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
<!--     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
-->    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <style>
        .corpus {
            transform: translate3d(-100%, 0, 0)
        }

        body {
            background-color: var(--lighter);
        }

       
    .colophonNoi a{
    color: 'black' !important
    }

    </style>
</head>

<body>

    <span class="colophon"><b>TRACKING-IT is a research project</b> investigating the new Italian geographies of logistics. The project focuses on the new spatial articulations of the logistics sector in Italy, assuming that the logistics sector has grown significantly over the last 20 years and that this growth has determined several effects on the spatial organization of various places along the peninsula.
    </span>

    <!-- <b class="margin chapter">Avanzamento e fasi del progetto</b>
    <img class="margin" src="assets/fasiprogett.png" alt=""> -->

    <b class="chapter margin">Unità locali e partecipanti</b>

    <div class="column units">

        <div class="uni">

            <span class="uniNames">Politecnico di Torino</span>
            <div class="logo-container">
                <img src="assets/polito.png" alt="logo" class="logo">
            </div>

            <div class="row portraits">
                <div class="column portrait">
                    <img src="assets/grigio.png" alt="">
                    <span>Giancarlo Cotella<!--<br>POSIZIONE--></span>
                </div>
                <div class="column portrait">
                    <img src="assets/grigio.png" alt="">
                    <span>Carlo Salone<!--<br>POSIZIONE--></span>
                </div>
                <div class="column portrait">
                    <img src="assets/grigio.png" alt="">
                    <span>Elisabetta Vitale Brovarone<!--<br>POSIZIONE--></span>
                </div>
                <div class="column portrait">
                    <img src="assets/grigio.png" alt="">
                    <span>Elena Camilla Pede<!--<br>POSIZIONE--></span>
                </div>
                <div class="column portrait">
                    <img src="assets/grigio.png" alt="">
                    <span>Erblin Berisha<!--<br>POSIZIONE--></span>
                </div>
                <div class="column portrait">
                    <img src="assets/grigio.png" alt="">
                    <span>Alberto Valz Gris<!--<br>POSIZIONE--></span>
                </div>
                <div class="column portrait">
                    <img src="assets/grigio.png" alt="">
                    <span>Elia Silvestro<!--<br>POSIZIONE--></span>
                </div>
            </div>
        </div>

        <div class="uni">

            <span class="uniNames">Politecnico di Milano</span>

            <div class="logo-container">
                <img src="assets/polimi.png" alt="logo" class="logo">
            </div>

            <div class="row portraits">
                <div class="column portrait">
                    <img src="assets/grigio.png" alt="">
                    <span>Simonetta Armondi<!--<br>POSIZIONE--></span>
                </div>
                <div class="column portrait">
                    <img src="assets/grigio.png" alt="">
                    <span>Beatrice Galimberti<!--<br>POSIZIONE--></span>
                </div>
                <div class="column portrait">
                    <img src="assets/grigio.png" alt="">
                    <span>Fabio Manfredini<!--<br>POSIZIONE--></span>
                </div>
                <div class="column portrait">
                    <img src="assets/grigio.png" alt="">
                    <span>Marco Vedoà<!--<br>POSIZIONE--></span>
                </div>

            </div>
        </div>

        <div class="uni">

            <span class="uniNames">Gran Sasso Science Institute</span>

            <div class="logo-container">
                <img src="assets/gssi.png" alt="logo" class="logo">
            </div>

            <div class="row portraits">
                <div class="column portrait">
                    <img src="assets/grigio.png" alt="">
                    <span>Fabiano Compagnucci<!--<br>POSIZIONE--></span>
                </div>
                <div class="column portrait">
                    <img src="assets/grigio.png" alt="">
                    <span>Alena Myshko<!--<br>POSIZIONE--></span>
                </div>
                <div class="column portrait">
                    <img src="assets/grigio.png" alt="">
                    <span>Arsène Perrot<!--<br>POSIZIONE--></span>
                </div>
                <!-- <div class="column portrait">
                    <img src="assets/grigio.png" alt="">
                    <span></span>
                </div> -->
            </div>
        </div>


        <span class="colophonNoi">
           <a href="http://instagram/600mt">Graphic Design: Matteo Bettini</a><br>
           <a href="http://federicoponi.it/computomanzia">Coding: Computomanzia [Federico Poni]</a>
           <br><br><br><br><br><br><br><br><br>
        </span>
    </div>

    </div>

    <div class="layeredBack mobile fixed"></div>

    <div class="mobile blackDotContainer fixed ">
        <div class="blackDot" onclick="openMenuMobile()"></div>
    </div>

    <div id="menu-mobile" class="animate__animate fixed mobile">
        <div class="tondo"></div>
        <div class="flex">
            <b><a href="/">HOME</a></b>
            <b><a href="/news">NEWS</a></b>
            <b><a class="selected" href="/about">ABOUT</a></b>
        </div>
    </div>

    <div id="corpus" class="corpus animate__animated ">

        <div id="fakeMenuBackground"></div>

        <div class="blackDot start clickMenu"></div>
        <div id="menu">
            <div id="backMenu"></div>

            <div class="internMenu">
                <b><a href="/">HOME</a></b>
                <b><a href="/dashboard">DASHBOARD</a></b>
                <b><a href="/data">DATA</a></b>
                <b><a href="/materiali">INFO SHEETS</a></b>
                <b><a href="/news">NEWS</a></b>
                <b><a class="selected" href="/about">ABOUT</a></b>
            </div>
        </div>

        <div class="burger animate__animated clickMenu">
            <div id="backBurger"></div>
            <div class="blackDot"></div>
            <span>MENU</span>
        </div>
    </div>

    <script src="app.js"></script>

    <script>
        function openMenuMobile() {
            // document.querySelector('#menu').classList.remove()
            // document.querySelector('#menu').classList.add('animate__slideInUp')

            // document.querySelector('.layeredBack').classList.remove()
            // document.querySelector('.layeredBack').classList.add()

            document.querySelector('#menu-mobile').style.display = 'flex'

            document.querySelector('.layeredBack').style.display = 'block'
        }

        var x = window.matchMedia("(max-width: 800px)")

        if (x.matches) { // If media query matches
            document.querySelector('.layeredBack').addEventListener('click', () => {
                // document.querySelector('#menu').classList.remove()
                // document.querySelector('#menu').classList.add()

                // document.querySelector('.layeredBack').classList.remove()
                // document.querySelector('.layeredBack').classList.add()
                document.querySelector('#menu-mobile').style.display = 'none'
                document.querySelector('.layeredBack').style.display = 'none'
            })
        }
    </script>


</body>

</html>