<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <script src="https://d3js.org/d3.v3.min.js"></script>
    <style>
        .corpus {
            transform: translate3d(-100%, 0, 0)
        }

#fakeMenuBackground{
    backdrop-filter: blur(14px);
}

#backMenu {
  background-color: #D4DAD4;
  filter: blur(30px);
  height: 150px;
  width: 9%;
  position: absolute;
  z-index: -2;
  right: -6vw;
} 
    </style>
</head>

<body>

    <span class="visualization-title">Titolo grafico per indicatore numero 2: <br>
        Sottotitolo più lungo esplicativo</span>

    <div id="visualization-dashboard">

        <div class="visualization-navigator">
            <div class="kind-visualization">
                <span class="title">VISUAL MODEL</span>
                <span id='scatterplot' class="model selected-viz">SCATTERPLOT</span>
                <span id='treemap' class="model">TREEMAP</span>
            </div>

            <br>
            <div class="dataset-visualization">

                <span class="title">DATASET</span>
                <div class="dataset">
                    <!-- <div> -->
                    <span>Dataset 1</span>
                    <!-- <span>+</span> -->
                    <!-- </div> -->

                    <p>
                        Descrizione breve del dataset e degli obiettivi della raccolta. Descrizione breve del dataset e
                        degli
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
                            Descrizione breve del dataset e degli obiettivi della raccolta. Descrizione breve del
                            dataset e
                            degli obiettivi della raccolta e poi ancora altro.
                        </p>
                    </div>

                </div>
            </div>

        </div>

        <div class="visualization">

        <!-- <img src="assets/dataviz.png" alt=""> -->
        <div id="chart"></div>

            <!-- qui d3.js injection -->
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
                <b class="selected"><a href="/visualization">INDICATORI</a></b>
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
    <script src="https://d3js.org/d3.v7.min.js"></script>
    <script src="viz.js"></script>
</body>

</html>