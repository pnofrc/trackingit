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

    <span class="visualization-title">Materiali e approfondimenti <br>
    Sottotitolo più lungo esplicativo</span>

    <div id="blog">

    @foreach ($blogs as $blog)
        <hr>
        <div class="article">


            <img class="blog-image" src="assets/dataviz.png">

            <div class="blog-info">

                <h3>DATA {{$blog['date']}}</h3>
                   
                <h2> {{$blog['title']}} <br>{{$blog['author']}}</h2>
                {!! $blog['content'] !!}
            </div>

            <a class="link-blog-download-pdf" href="{{$blog['pdf']}}" download>
                <button class="blog-download-pdf button-ext">
                    <span>DOWNLOAD PDF</span>
                    <img src="assets/download.png" alt="">
                </button>
            </a>

        </div>
    @endforeach

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
                <b class="selected"><a href="/blog">MATERIALI</a></b>
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

</body>

</html>