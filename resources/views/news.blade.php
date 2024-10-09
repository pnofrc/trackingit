<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Tracking-it | News</title>
    <meta name="description"
        content="TRACKING-IT is a research project invastigating the new Italian Geographies of logistics.">
    <meta name="author" content="Politecnico di Torino, Politecnico di Milano, Gran Sasso Science Institute">
    <meta name="robots" content="index, follow">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <meta name="og:image" content="http://tr.acking.it/assets/up-mobile.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
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

        #backMenu {
            height: 150px;
            width: 115%;
            position: absolute;
            z-index: -2;
            right: -6vw;
        }

    </style>
</head>

<body>

    <div class="news-header">
        <span class="visualization-title title">News</span>

        <div class="news-contents">
            <span onclick="filtering('all')" class="model">CONTENTS</span>
            <span onclick="filtering('Evento')" class="model">EVENT</span>
            <span onclick="filtering('Pubblicazione')" class="model">PUBLICATION</span>
            <span onclick="filtering('Altro')" class="model">OTHER</span>
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
            <b><a class="selected" href="/news">NEWS</a></b>
            <b><a href="/about">ABOUT</a></b>
        </div>
    </div>

    <div id="blog">

        @foreach ($news as $new)
            <hr class="{{ $new['news_type'] }} news">


            <div class="desktop article news {{ $new['news_type'] }}">

                <div class="blog-image">
                    <span class="title">{{ $new['title'] }}</span>
                    <img src="/storage/{{ $new['picture'] }}">
                </div>

                <div class="blog-info">
                    {!! $new['content'] !!}
                </div>

                <div class="row news-ext">
                    <div class="column info-news">
                        <span>{{ $new['news_type'] }}</span>
                        <span>{{ $new->date->format('d-m-Y') }}</span>
                        <span>{{ $new['city'] }}</span>
                    </div>

                    <a href="{{ $new['external_link'] }}" target="_blank">
                        <button class="button-ext">LINK ESTERNO</button>
                    </a>
                </div>

            </div>



            <div class="mobile article news {{ $new['news_type'] }}">

                <span class="title">{{ $new['title'] }}</span>

                <div class="column info-news">
                    <span>{{ $new['news_type'] }}</span>
                    <span>{{ $new->date->format('d-m-Y') }}</span>
                    <span>{{ $new['city'] }}</span>
                </div>

                <div class="blog-image">
                    @if ($new['picture'])
                        <img src="/storage/{{ $new['picture'] }}">
                    @endif
                </div>

                <div class="blog-info">
                    {!! $new['content'] !!}
                </div>

                <div class="row news-ext">
                    <a href="{{ $new['external_link'] }}" target="_blank">
                        <button class="button-ext">LINK ESTERNO</button>
                    </a>
                </div>

            </div>
        @endforeach
    </div>


    <div id="menu-mobile" class="animate__animated mobile">
        <b><a href="/">HOME</a></b>
        <b><a class="selected" href="/news">NEWS</a></b>
        <b><a href="/about">ABOUT</a></b>
    </div>

    <div id="corpus" class="corpus animate__animated ">

        <div id="fakeMenuBackground"></div>

        <div class="blackDot start clickMenu"></div>

        <div id="menu" class="desktop">
            <div id="backMenu"></div>

            <div class="internMenu">
                <b><a href="/">HOME</a></b>
                <b><a href="/dashboard">DASHBOARD</a></b>
                <b><a href="/data">DATA</a></b>
                <b><a href="/info-sheets">INFO SHEETS</a></b>
                <b><a class="selected" href="/news">NEWS</a></b>
                <b><a href="/about">ABOUT</a></b>
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

var x = window.matchMedia("(max-width: 800px)")

        // Filter for contents type

        function filtering(type) {

           
            let news_array = document.querySelectorAll('.news')
         
            if (type == 'all') {
                news_array.forEach(element => {
                    element.style.display = "flex"
                });
            } else {
                news_array.forEach(element => {
                    element.style.display = "none"
                });
                document.querySelectorAll(`.${type}`).forEach(element => {
                    element.style.display = 'flex'
                });

            }

            if (!x.matches) { 
                document.querySelectorAll('.mobile').forEach(element => {
                    element.style.display ='none'
                    console.log('dca')
                });
            }

        }


        function openMenuMobile() {
            document.querySelector('#menu-mobile').style.display = 'flex'
            document.querySelector('.layeredBack').style.display = 'block'
            document.body.style.overflowY = 'hidden';

        }



        if (x.matches) { // If media query matches
            document.querySelector('.layeredBack').addEventListener('click', () => {
                document.querySelector('#menu-mobile').style.display = 'none'
                document.querySelector('.layeredBack').style.display = 'none'
                document.body.style.overflowY = 'unset';

            })
        }
    </script>
</body>

</html>
