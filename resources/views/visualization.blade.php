<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Tracking-it | Data</title>
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
-->    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <style>
        .corpus {
            transform: translate3d(-100%, 0, 0)
        }

        .showSelectedDataset {
            background: var(--backOpaque) !important;
        }

        .unselectable {
            background: grey !important;
            pointer-events: none;
            color: white
        }
    </style>
</head>

<body>

    {{-- <span class="visualization-title">Indicatori</span> --}}

    <div id="visualization-dashboard">

        <div class="visualization-navigator">
            <div class="kind-visualization">
                <span class="model">VISUAL MODEL</span>
                <span id='scatterplot'
                    onclick="pickChart('visualization_scatterplot')"class="visualization_scatterplot model selected-viz">SCATTERPLOT</span>
                <span id='treemap' onclick="pickChart('visualization_treemap')"
                    class="visualization_treemap model">TREEMAP</span>
            </div>

            <br>
            <div class="kind-visualization">

                <span class="model">DATASET</span>

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
                <b><a class="selected" href="/data">DATA</a></b>
                <b><a href="/info-sheets">INFO SHEETS</a></b>
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
        let treemap = document.querySelector('.visualization_treemap')
        let scatterplot = document.querySelector('.visualization_scatterplot')
        let chart = document.getElementById('allora')
        let selectedChartType = 'scatterplot'
        let selectedDataset = 0
        let viz = document.querySelector("img");

        let visualizations = {
            'visualization_scatterplot': '',
            'visualization_treemap': ''
        }
        // let charts
        let current = 'visualization_scatterplot'


        // get the other value of the object
        function getOtherVisualization(key) {
            let keys = Object.keys(visualizations);
            return keys.find(k => k !== key);
        }


        // Get the id of the last uploaded (the first in db) dataset' chart
        @foreach ($visualizations as $viz)
            @if ($loop->first)
                selectedDataset = {{ $viz['id'] }}
                @break
            @endif
        @endforeach



        function pickChart(type) {
            current = type
        
            console.log(current)
            document.querySelector(`.${current}`).classList.add('selected-viz')
            document.querySelector(`.${getOtherVisualization(current)}`).classList.remove('selected-viz')

            viz.src = '/storage/' + charts[current]
            viz.alt = `Indicatore di tipo ${selectedChartType} del dataset ${charts['name']}`
        }

        // function to get the two charts
        function getChart() {
                axios.get(`/getCharts/${selectedDataset}`)
                .then(response => {
                    charts = response.data[0];
                    // store data in temp object
                    let treemapData = charts.visualization_treemap
                    let scatterplotData = charts.visualization_scatterplot
                    visualizations.visualization_treemap = treemapData
                    visualizations.visualization_scatterplot = scatterplotData
                    // check if a data visualization is null
                    for (let key in visualizations) {
                        if (visualizations[key] == null) {
                            console.log(visualizations[key])
                            document.querySelector(`.${key}`).classList.add('unselectable')
                            pickChart(getOtherVisualization(key))
                        }
                    }
                    console.log(current)
                    pickChart(current)
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                });
        }



        // select the dataset
        function selectDataset(n, id) {
            // remove unselectable class
            document.querySelectorAll('.model').forEach(model => {
                if (model.classList.contains('unselectable')) {
                    model.classList.remove('unselectable')
                }
            });

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
