<script>
    <?php $no = 1;
    foreach ($dataSertifikasi as $ds) : ?>
        new Chart(document.getElementById("doughnut-chart<?= $no++; ?>"), {
            type: 'doughnut',
            data: {
                labels: ["Lulus", "Tidak lulus"],
                datasets: [{
                    label: "Peserta",
                    backgroundColor: ["#5cb85c", "#d9534f"],
                    data: [<?= $ds['lulus'] ?>, <?= $ds['peserta'] - $ds['lulus'] ?>]
                }]
            },
            options: {
                title: {
                    display: true,
                    text: 'Grafik kelulusan'
                }
            }
        });
    <?php endforeach; ?>
</script>