<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="back ">
        <img src="assets/back.png" alt="">
    </div>

    <div class="corpus">

        <div id="slide-update">
            <marquee behavior="smooth" direction="left" id="latests">
                @foreach ($lat as $latest) <span>{{$latest['latests']}}</span> @endforeach
            </marquee>
        </div>

        <div class="description-platform ">
            <p><b>TRACKING-IT</b> is a research project invastigating the new <i>Italian Geographies of logistics</i>.
            </p>
        </div>

        <div id="menu">
            <b class="selected"><a href="/">HOME</a></b>
            <b><a href="/dashboard">DASHBOARD</a></b>
            <b><a href="/visualization">INDICATORI</a></b>
            <b><a href="/blog">MATERIALI</a></b>
            <b><a href="/news">NEWS</a></b>
            <b><a href="/about">ABOUT</a></b>
        </div>

        <div class="void"></div>

        <img class="footer" src="assets/down.png" alt="">

    </div>

</body>

</html>