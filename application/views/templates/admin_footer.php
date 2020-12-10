<!-- Footer -->
</div>

<footer class="sticky-footer text-secondary">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Pusdiklat & Sertifikasi UTY <?= date('Y'); ?></span>
        </div>
    </div>
</footer>

</div>
<!-- End of Content Wrapper -->

</div>

<!-- End of Page Wrapper -->
<!-- End of Footer -->



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
<!-- <script src="sertifikasi/assets/js/dataTables.bootstrap.js"></script>
<script src="sertifikasi/assets/js/jquery.dataTables.js"></script> -->
<!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script> -->

<script>
    //datatables
    $(document).ready(function() {
        $('#example').DataTable();
    });

    //datatables
    $(document).ready(function() {
        $('#example0').DataTable();
    });

    //datatables
    $(document).ready(function() {
        $('#example1').DataTable();
    });
    //datatables
    $(document).ready(function() {
        $('#example2').DataTable();
    });
    //datatables
    $(document).ready(function() {
        $('#example3').DataTable();
    });
    //datatables
    $(document).ready(function() {
        $('#example4').DataTable();
    });
    //datatables
    $(document).ready(function() {
        $('#example5').DataTable();
    });
    //datatables
    $(document).ready(function() {
        $('#example6').DataTable();
    });
    //datatables
    $(document).ready(function() {
        $('#example7').DataTable();
    });
    //datatables
    $(document).ready(function() {
        $('#example8').DataTable();
    });
    //datatables
    $(document).ready(function() {
        $('#example9').DataTable();
    });
    //datatables
    $(document).ready(function() {
        $('#example10').DataTable();
    });

    // UpdateUserActive
    $('.sidebar-switch').on('click', function() {
        $.ajax({
            url: '<?= base_url('user/UpdateSidebar') ?>',
            method: 'post',
            dataType: 'json',
            success: function(data) {
                console.log(data);
            }
        });
    });

    // UpdateUserActive
    $('.btn-switch').on('click', function() {
        var id = $(this).attr('data');
        $.ajax({
            url: '<?= base_url('user/UserActived') ?>',
            method: 'post',
            dataType: 'json',
            data: {
                id: id
            },
            success: function(data) {
                console.log(data);
            }
        });
    });

    // UpdateUserActive menu
    $('.btn-switch-menu').on('click', function() {
        var id = $(this).attr('data');
        $.ajax({
            url: '<?= base_url('kelola_web/UserActivedMenu') ?>',
            method: 'post',
            dataType: 'json',
            data: {
                id: id
            },
            success: function(data) {
                console.log(data);
            }
        });
    });

    // UpdateUserActive submenu
    $('.btn-switch-submenu').on('click', function() {
        var id = $(this).attr('data');
        $.ajax({
            url: '<?= base_url('kelola_web/UserActived') ?>',
            method: 'post',
            dataType: 'json',
            data: {
                id: id
            },
            success: function(data) {
                console.log(data);
            }
        });
    });

    // CHART =========
    var ctx = document.getElementById('myChart').getContext('2d');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'bar',

        // The data for our dataset
        data: {
            labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
            datasets: [{
                label: 'MOS',
                backgroundColor: 'rgb(0, 85, 255, 0.6)',
                borderColor: 'rgb(255, 255, 255)',
                data: [3, 15, 13, 8, 3, 3, 6, 2, 7, 9, 11, 8]
            }, {
                label: 'MTA',
                backgroundColor: 'rgb(26, 255, 0, 0.6)',
                borderColor: 'rgb(46, 219, 86)',
                data: [1, 4, 3, 9, 15, 13, 8, 3, 3, 6, 13, 8, 3]
            }, {
                label: 'MCE',
                backgroundColor: 'rgb(54, 185, 204, 0.6)',
                borderColor: 'rgb(54, 185, 204)',
                data: [2, 10, 5, 15, 8, 4, 3, 9, 15, 13, 8, 3, 3]
            }, {
                label: 'MTA',
                backgroundColor: 'rgb(246, 194, 62, 0.6)',
                borderColor: 'rgb(255, 194, 62)',
                data: [10, 3, 6, 1, 4, 10, 5, 15, 8, 4, 3, 9, 15]
            }]
        },

        // Configuration options go here
        options: {
            scales: {
                xAxes: [{
                    scaleLabel: {
                        display: true,
                        labelString: 'Bulan'
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
<script src="<?= base_url('assets/sbadmin/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('assets/sbadmin/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('assets/sbadmin/'); ?>js/sb-admin-2.min.js"></script>

<!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<script src="<?= base_url('assets/js/script-rekap.js') ?>"></script>
<script src="<?= base_url('assets/js/script-admin.js') ?>"></script>


<script>
    $('.custom-file-input').on('change', function() {
        let filename = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(filename);
    });

    function ConfirmPW() {
        pw1 = $('input#pw1').val();
        pw2 = $('input#pw2').val();
        console.log("pw1 : " + pw1);
        console.log("pw2 : " + pw2);
        if (pw1 != pw2) {
            $(".Confirm-pw").text("Konfirmasi password salah!");
        } else {
            $(".Confirm-pw").text("");
        }
    }
</script>

</body>

</html>