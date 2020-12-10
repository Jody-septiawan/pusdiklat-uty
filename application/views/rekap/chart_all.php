<!-- Chart.js -->
<?php
$Temp['labels'] = [];
$Temp['peserta'] = [];
$Temp['lulus'] = [];
foreach ($hasilCek as $h) :
    array_push($Temp['labels'], $h['alias']);
    array_push($Temp['peserta'], $h['peserta']);
    array_push($Temp['lulus'], $h['lulus']);
endforeach;
?>

<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    Chart.defaults.scale.ticks.beginAtZero = true;
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'bar',

        // The data for our dataset
        data: {
            labels: <?= json_encode($Temp['labels']) ?>,
            datasets: [{
                label: 'Peserta',
                backgroundColor: 'rgb(0, 85, 255, 0.6)',
                borderColor: 'rgb(39, 152, 232)',
                fill: false,
                data: <?= json_encode($Temp['peserta']) ?>
            }, {
                label: 'Lulus',
                backgroundColor: 'rgb(26, 255, 0, 0.6)',
                borderColor: 'rgb(46, 219, 86)',
                fill: false,
                data: <?= json_encode($Temp['lulus']) ?>
            }]
        },

        // Configuration options go here
        options: {
            scales: {
                xAxes: [{
                    scaleLabel: {
                        display: true,
                        labelString: 'Ujian sertifikasi'
                    }
                }],
                yAxes: [{
                    scaleLabel: {
                        display: true,
                        labelString: 'Peserta'
                    }
                }]
            }
        }
    });
</script>