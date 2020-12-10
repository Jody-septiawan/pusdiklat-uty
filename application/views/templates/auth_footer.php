    <!-- JavaScript files-->
    <script src="<?= base_url('assets/bubble/'); ?>vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url('assets/bubble/'); ?>vendor/popper.js/umd/popper.min.js"> </script>
    <script src="<?= base_url('assets/bubble/'); ?>vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?= base_url('assets/bubble/'); ?>vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="<?= base_url('assets/bubble/'); ?>vendor/chart.js/Chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
    <script src="<?= base_url('assets/bubble/'); ?>js/front.js"></script>
    <script>
        function ShowPassword() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
    </body>

    </html>