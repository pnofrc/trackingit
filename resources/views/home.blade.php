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

    <div class="blackDot mobile"></div>



    <div class="corpus animate__animated">

        <div id="slide-update" class="desktop">
            <marquee scrollamount="5" behavior="smooth" direction="left" id="latests">
                @foreach ($latests as $latest) <span>{{$latest['latests']}}</span> @endforeach
            </marquee>
        </div>

        <div class="description-platform ">
            <p><b>TRACKING-IT</b> is a research project invastigating the new <i>Italian Geographies of logistics</i>.
            </p>
        </div>

        <div id="menu">
            <b><a class="selected" href="/">HOME</a></b>
            <b class="desktop"><a href="/dashboard">DASHBOARD</a></b>
            <b class="desktop"><a href="/indicatori">INDICATORI</a></b>
            <b class="desktop"><a href="/materiali">MATERIALI</a></b>
            <b><a href="/news">NEWS</a></b>
            <b><a href="/about">ABOUT</a></b>
        </div>

        <div class="void"></div>

        <img class="footer" src="assets/down.png" alt="">
        <img src="assets/loghi-mobile.png" class="header-mobile" alt="">

    </div>

</body>

</html>