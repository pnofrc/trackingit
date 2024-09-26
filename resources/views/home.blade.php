<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tracking-it</title>
    <meta name="description"
        content="TRACKING-IT is a research project invastigating the new Italian Geographies of logistics.">
    <meta name="author" content="Politecnico di Torino, Politecnico di Milano, Gran Sasso Science Institute">
    <meta name="robots" content="index, follow">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <meta name="og:image" content="http://tr.acking.it/assets/up-mobile.png" />
    <meta name="viewport" content="width=device-widthÌß, initial-scale=1">
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="back ">
        <img src="assets/back.png" alt="">
    </div>

    <div class="layeredBack mobile fixed"></div>

    <div class="mobile blackDotContainer fixed ">
        <div class="blackDot" onclick="openMenuMobile()"></div>
    </div>

    <div id="menu-mobile" class="animate__animate fixed mobile">
        <div class="tondo"></div>
        <div class="flex">
            <b><a class="selected" href="/">HOME</a></b>
            <b><a href="/news">NEWS</a></b>
            <b><a href="/about">ABOUT</a></b>
        </div>
    </div>

    <p class="mobile alert">Visitaci da uno schermo più grande per accedere a tutte le pagine di questo sito</p>



    <div class="corpus animate__animated">

        <div id="slide-update" class="desktop">
            <marquee scrollamount="5" behavior="smooth" direction="left" id="latests">
                @foreach ($latests as $latest)
                    <span>{{ $latest['latests'] }}</span>
                @endforeach
            </marquee>
        </div>

        <div class="description-platform ">
            <p><b>TRACKING-IT</b> is a research project invastigating the new <i>Italian Geographies of logistics</i>.
            </p>
        </div>

        <div id="menu" class="animate__animated">
            <b><a class="selected" href="/">HOME</a></b>
            <b><a href="/dashboard">DASHBOARD</a></b>
            <b><a href="/indicatori">INDICATORI</a></b>
            <b><a href="/materiali">MATERIALI</a></b>
            <b><a href="/news">NEWS</a></b>
            <b><a href="/about">ABOUT</a></b>
        </div>

        <div class="void"></div>

        <img class="footer" src="assets/down.png" alt="">
        <img src="assets/loghi-mobile.png" class="header-mobile" alt="">

    </div>

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
