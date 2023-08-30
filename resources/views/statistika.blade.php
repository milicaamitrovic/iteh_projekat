<!DOCTYPE html>
<html>
<head>
    <title>Statistika evidencije prisustva nastavi</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <canvas id="myChart"></canvas>
    <script>
        var formattedLabels = {!! $labels->toJson() !!}.map(function(date) {
            var parts = date.split('-');
            return parts[2] + '.' + parts[1] + '.' + parts[0] + '.';
        });

        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: formattedLabels,
            datasets: [{
                label: 'Broj prisustava',
                data: {!! json_encode($data) !!},
                backgroundColor: 'rgba(54, 162, 235, 0.2)', // Svetlo plava unutrašnjost
                borderColor: 'rgba(54, 162, 235, 1)', // Tamno plavi okvir
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1,
                        precision: 0
                    },
                    title: {
                        display: true,
                        text: 'Broj prisustava'
                    }
                },
                x: {
                    type: 'category',
                    title: {
                        display: true,
                        text: 'Datum'
                    }
                }
            }
        }
    });
        </script>
</body>
</html>
