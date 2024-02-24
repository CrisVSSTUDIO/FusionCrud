@extends('home')
@section('crud-content')
    <script src="{{ asset('assets\js\chart.js') }}"></script>

    <div class="container py-4 ">
        <div class="row">
            <div class="col-xl-6">
                <x-card title="Number of products per category">


                    <canvas id="myChart"></canvas>
                </x-card>
            </div>
            <div class="col-xl-6">
                <x-card title="Trend of the evolution of the number of products per year">
                    <canvas id="perYearEvolution"></canvas>
                </x-card>
            </div>
        </div>
        <div class="row">

            <div class="col-xl-6">
                <x-card title="Average of ">
                    <p><mark>{{ $averageProductsPerDay }}</mark> {{ $averageProductsPerDay > 1 ? 'products' : 'product' }}
                        created per day
                    </p>
                </x-card>
            </div>
            <div class="col-xl-6">
                <x-card title="Apriori algorithm">

                    <p>{{ $apriori }}
                    </p>
                </x-card>
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
                    label: 'Number of products per category',
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
                    label: 'Trend of the evolution of the number of products per year',
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
