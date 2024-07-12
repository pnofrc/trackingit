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
    </style>
</head>

<body>

    <div class="news-header">
        <span class="visualization-title">Titolo pagina<br>
            Sottotitolo più lungo esplicativo</span>

        <div class="news-contents">
            <span class="title">TIPO DI CONTENUTI</span>
            <span onclick="filtering('Evento')" class="model">EVENTO</span>
            <span onclick="filtering('Pubblicazione')" class="model">PUBBLICAZIONE</span>
            <span onclick="filtering('Altro')" class="model">ALTRO</span>
        </div>

    </div>

    <div id="blog">

        @foreach ($news as $new)
        <hr class="{{$new['news_type']}} news">
        <div class="article news {{$new['news_type']}}">

            <div class="blog-image">
                <span class="title">{{ $new['title'] }}</span>
                <img src="{{ $new['picture'] }}">
            </div>

            <div class="blog-info">
                {!! $new['content' ]!!}
            </div>

            <div class="row news-ext">
                <div class="column info-news">
                    <span>{{ $new['news_type'] }}</span>
                    <span>{{ $new['date'] }}</span>
                    <span>{{ $new['city'] }}</span>
                </div>

                <a href="{{ $new['external_link'] }}" target="_blank">
                    <button class="button-ext">LINK ESTERNO</button>
                </a>
            </div>

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
                <b><a href="/blog">MATERIALI</a></b>
                <b class="selected"><a href="/news">NEWS</a></b>
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

        // Filter for contents type
        
        function filtering(type) {
            let news_array = document.querySelectorAll('.news')
            news_array.forEach(element => {
                element.style.display = "none"
            });
            document.querySelectorAll(`.${type}`).forEach(element => {
                element.style.display = 'flex'
            });
        }
    </script>
</body>

</html>