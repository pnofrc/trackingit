<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Tracking-it | Indicatori</title>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <style>
        .corpus {
            transform: translate3d(-100%, 0, 0)
        }

        .showSelectedDataset {
            border: solid 1px !important;
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

    {{-- <span class="visualization-title">Indicatori</span> --}}

    <div id="visualization-dashboard">

        <div class="visualization-navigator">
            <div class="kind-visualization">
                <span class="title">VISUAL MODEL</span>
                <span id='scatterplot' class="model selected-viz">SCATTERPLOT</span>
                <span id='treemap' class="model">TREEMAP</span>
            </div>

            <br>
            <div ">

                <span class="title">DATASET</span>

                 @foreach ($visualizations as $viz)
                <div class="dataset @if ($loop->first) showSelectedDataset @endif"
                    id={{ str_replace(' ', '_', $viz['name']) }}
                    onclick="selectDataset({{ $viz['id'] }},{{ str_replace(' ', '_', $viz['name']) }})">
                    <span>{{ $viz['name'] }}</span>

                    {!! $viz['description'] !!}
                </div>
                @endforeach

            </div>


        </div>

        <div class="visualization">

            <div id="allora">
                <img src="" alt="">
            </div>

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
                <b><a class="selected" href="/indicatori">INDICATORI</a></b>
                <b><a href="/materiali">MATERIALI</a></b>
                <b><a href="/news">NEWS</a></b>
                <b><a href="/about">ABOUT</a></b>
            </div>
        </div>

        <div class="burger animate__animated clickMenu">
            <div id="backBurger"></div>
            <div class="blackDot "></div>
            <span>MENU</span>
        </div>
    </div>

    <script src="app.js"></script>

    <script>
        let treemap = document.getElementById('treemap')
        let scatterplot = document.getElementById('scatterplot')
        let chart = document.getElementById('allora')
        let selectedChartType = 'scatterplot'
        let selectedDataset = 0
        let viz = document.querySelector("img");
        let charts

        // Get the id of the last uploaded (the first in db) dataset' chart
        @foreach ($visualizations as $viz)
            @if ($loop->first)
                selectedDataset = {{ $viz['id'] }}
                @break
            @endif
        @endforeach


        // function to show on the page the selecte data viz

        function showChart() {
            let current = 'visualization_' + selectedChartType
            viz.src = '/storage/' + charts[0][current]
            viz.alt = `Indicatore di tipo ${selectedChartType} del dataset ${charts[0]['name']}`
        }

        // function to get the two charts
        function getChart() {
            axios.get(`/getCharts/${selectedDataset}`)
                .then(response => {
                    charts = response.data;
                    showChart()
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                });
        }

        // toggle the selected chart type and get visualized
        treemap.addEventListener('click', () => {
            if (scatterplot.classList.contains('selected-viz')) {
                scatterplot.classList.remove('selected-viz')
                treemap.classList.add("selected-viz")
                selectedChartType = 'treemap'
                showChart()
            }
        })

        scatterplot.addEventListener('click', () => {
            if (treemap.classList.contains('selected-viz')) {
                treemap.classList.remove('selected-viz')
                scatterplot.classList.add("selected-viz")
                selectedChartType = 'scatterplot'
                showChart()
            }
        })

        // select the dataset
        function selectDataset(n, id) {
            if (selectedDataset != n) {
                selectedDataset = n
                document.querySelectorAll('.dataset').forEach(dataset => {
                    dataset.classList.remove('showSelectedDataset')
                });
                document.querySelector('#' + id.id).classList.add('showSelectedDataset')
                getChart()
            }
        }

        // call the function as the page load
        getChart()
    </script>
</body>

</html>
