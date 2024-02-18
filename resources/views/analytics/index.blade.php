@extends('home')
@section('crud-content')
    <script src="{{ asset('assets\js\chart.js') }}"></script>
    <x-alert-success />

    <x-alert-error />
    <div class="container py-4 ">
        <div class="row">
            <div class="col-xl-6">
                <div class="card  border-0 shadow mt-2 p-2">
                    <span class="text-center p-2 ">Número de assets por categorias</span>

                    <canvas id="myChart"></canvas>
                </div>

            </div>
            <div class="col-xl-6">
                <div class="card  border-0 shadow p-3 mt-2">
                    <span class="text-center p-2">Evolução do número de assets por ano </span>
                    <canvas id="perYearEvolution"></canvas>
                </div>

            </div>
        </div>
        <div class="row">

            <div class="col-xl-6">
                <div class="card  border-0 shadow p-3 mt-2">
                    <span class="text-center p-2">
                        <p class="text-muted">Média de
                        <p><mark>{{ $averageProductsPerDay }}</mark> {{ $averageProductsPerDay > 1 ? 'assets' : 'asset' }}
                            criado por dia
                        </p>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card  border-0 shadow p-3 mt-2">
                    <span class="text-center p-2">
                        <p class="text-muted">Algoritmo apriori
                        <p>{{ $apriori }}
                        </p>
                </div>
            </div>

        </div>
    </div>

    <script>
        var xValues = <?php echo $created_at; ?>;
        var yValues = <?php echo $rowcount; ?>;
        var xPerYear = <?php echo $perYear; ?>;
        var yYearCount = <?php echo $yearCount; ?>;
        var media = 0
        console.log(
            media =
            yValues.reduce((a, b) => a + b, 0) / xValues.length
        )

        let backgroundColors = [];

        function getRandomColor() {
            var letters = '0123456789ABCDEF'.split('');
            var color = '#';
            for (var i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }

        for (let i = 0; i < yValues.length; i++) {
            backgroundColors.push(getRandomColor());
        }


        new Chart("myChart", {
            type: "bar",
            data: {
                labels: xValues,
                datasets: [{
                    data: yValues,
                    label: 'Número de assets por categoria',
                    backgroundColor: backgroundColors

                }],


            },
            options: {
                responsive: true,
                maintainAspectRatio: true

            },
        });

        new Chart("perYearEvolution", {
            type: "line",
            data: {
                labels: yYearCount,

                datasets: [{
                    data: xPerYear,
                    label: 'Evolução do número de assets por ano com Regressão Linear',
                    backgroundColor: '#3b71ca'
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
            },
            tooltips: {
                mode: 'index'
            },
            legend: {
                position: 'bottom'
            },
        });
        Chart.plugins.register({
            afterDraw: function(chart) {
                if (chart.data.datasets[0].data.every(item => item === 0)) {
                    let ctx = chart.chart.ctx;
                    let width = chart.chart.width;
                    let height = chart.chart.height;

                    chart.clear();
                    ctx.save();
                    ctx.textAlign = 'center';
                    ctx.textBaseline = 'middle';
                    ctx.fillText('No data to display', width / 2, height / 2);
                    ctx.restore();
                }
            }
        });
    </script>
@endsection
