<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <title>Tracking-it | Materiali</title>
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

        .blog-title{
            margin-top: 0;
        }
    </style>
</head>

<body>

    <span class="visualization-title title">Materiali e approfondimenti</span>

    <div id="blog">

        @foreach ($blogs as $blog)
            <hr>
            <div class="article">



                <img class="blog-image" src="/storage/{{ $blog['picture'] }}">

                <div class="blog-info">

                    {{-- <p class="blog-date subtitle">DATA {{ $blog['date'] }}</p> --}}

                    <p class="blog-title title"> {{ $blog['title'] }} <br>{{ $blog['author'] }}</p>
                    {!! $blog['content'] !!}
                </div>

                <a class="link-blog-download-pdf" href="/storage/{{ $blog['pdf'] }}" download>
                    <button class="blog-download-pdf button-ext">
                        <span>DOWNLOAD PDF</span>
                        <img class="arrow" src="assets/download.png" alt="">
                    </button>
                </a>

            </div>
        @endforeach

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
                <b><a class="selected" href="/materiali">INFO SHEETS</a></b>
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

    <script src="app.js"></script>
    <script>
        document.querySelectorAll('.link-blog-download-pdf').forEach(element => {
            element.addEventListener('mouseover', () => {
                element.style.filter = 'invert'
                element.querySelector(".arrow").style.filter = "invert()"
            })
            element.addEventListener('mouseleave', () => {
                element.style.filter = 'invert'
                element.querySelector(".arrow").style.filter = "unset"
            })
        });
    </script>

</body>

</html>
