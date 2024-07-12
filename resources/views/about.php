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

    <style>
        .corpus {
            transform: translate3d(-100%, 0, 0)
        }

        body {
            background-color: var(--lighter);
        }

        #backMenu {
            height: 150px;
            width: 9%;
            position: absolute;
            z-index: -2;
            right: -6vw;
        }
    </style>
</head>

<body>

    <span class="colophon"><b>TRACKING-IT is a research project</b> invastigating the new Italian Geographies of
        logistics. Nelle prossime settimane verranno inoltre analizzati i dati delle superfici dedicate alla logistica
        (capannoni e superfici libere) derivanti dall’incrocio del database EUBUCCO e con i dati forniti da ISPRA sul
        consumo di suolo della logistica, disponibili grazie all’incontro con il dott. Munafò e i dati forniti dal suo
        gruppo di ricerca. 
    </span>

    <b class="margin chapter">Avanzamento e fasi del progetto</b>
    <img class="margin" src="assets/fasiprogett.png" alt="">

    <b class="chapter margin">Unità locali e partecipanti</b>

    <div class="column units">

        <div class="row uni">

            <div class="logo-container">
                <img src="assets/polito.png" alt="logo" class="logo">
            </div>

            <div class="row portraits">
                <div class="column portrait">
                    <img src="assets/grigio.png" alt="">
                    <span>NOME COGNOME<br>POSIZIONE</span>
                </div>
                <div class="column portrait">
                    <img src="assets/grigio.png" alt="">
                    <span>NOME COGNOME<br>POSIZIONE</span>
                </div>
                <div class="column portrait">
                    <img src="assets/grigio.png" alt="">
                    <span>NOME COGNOME<br>POSIZIONE</span>
                </div>
                <div class="column portrait">
                    <img src="assets/grigio.png" alt="">
                    <span>NOME COGNOME<br>POSIZIONE</span>
                </div>
                <div class="column portrait">
                    <img src="assets/grigio.png" alt="">
                    <span>NOME COGNOME<br>POSIZIONE</span>
                </div>
            </div>
        </div>

        <div class="row uni">

            <div class="logo-container">
                <img src="assets/polimi.png" alt="logo" class="logo">
            </div>

            <div class="row portraits">
                <div class="column portrait">
                    <img src="assets/grigio.png" alt="">
                    <span>NOME COGNOME<br>POSIZIONE</span>
                </div>
                <div class="column portrait">
                    <img src="assets/grigio.png" alt="">
                    <span>NOME COGNOME<br>POSIZIONE</span>
                </div>
                <div class="column portrait">
                    <img src="assets/grigio.png" alt="">
                    <span>NOME COGNOME<br>POSIZIONE</span>
                </div>
                <div class="column portrait">
                    <img src="assets/grigio.png" alt="">
                    <span>NOME COGNOME<br>POSIZIONE</span>
                </div>

            </div>
        </div>

        <div class="row uni">

            <div class="logo-container">
                <img src="assets/gssi.png" alt="logo" class="logo">
            </div>

            <div class="row portraits">
                <div class="column portrait">
                    <img src="assets/grigio.png" alt="">
                    <span>NOME COGNOME<br>POSIZIONE</span>
                </div>
                <div class="column portrait">
                    <img src="assets/grigio.png" alt="">
                    <span>NOME COGNOME<br>POSIZIONE</span>
                </div>
                <div class="column portrait">
                    <img src="assets/grigio.png" alt="">
                    <span>NOME COGNOME<br>POSIZIONE</span>
                </div>

            </div>
        </div>
    </div>

    </div>

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
                <b><a href="/news">NEWS</a></b>
                <b class="selected"><a href="/about">ABOUT</a></b>
            </div>
        </div>

        <div class="burger clickMenu">
            <div id="backBurger"></div>
            <div class="blackDot"></div>
            <span>MENU</span>
        </div>
    </div>

    <script src="app.js"></script>


</body>

</html>