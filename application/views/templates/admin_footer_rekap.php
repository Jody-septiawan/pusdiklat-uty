</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->
<!-- <footer class="sticky-footer bg-secondary text-light">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Pusdiklat & Sertifikasi UTY <?= date('Y'); ?></span>
        </div>
    </div>
</footer> -->
<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <h5 class="modal-title" id="exampleModalLabel">Logout?</h5> -->
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Pilih "Logout" dibawah jika ingin meninggalkan laman dan mengakhiri sesi</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="<?= base_url('auth/logout') ?>">Logout</a>
            </div>
        </div>
    </div>
</div>
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


<!-- Bootstrap core JavaScript-->
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="<?= base_url('assets/sbadmin/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('assets/sbadmin/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('assets/sbadmin/'); ?>js/sb-admin-2.min.js"></script>

<!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="<?= base_url('assets/js/script-rekap.js') ?>"></script>


<script>
    $('.custom-file-input').on('change', function() {
        let filename = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(filename);
    });
</script>

</body>

</html>