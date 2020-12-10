<!-- Footer-->
<footer class="bg-primary py-5">
    <div class="container">
        <div class="small text-center text-light">Copyright © 2020 - Pusdiklat & Sertifikasi UTY</div>
    </div>
</footer>

<!-- Bootstrap core JS-->
<script src="https://static.codepen.io/assets/common/stopExecutionOnTimeout-157cd5b220a5c80d4ff8e0e70ac069bffd87a61252088146915e8726e5d9f147.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
<!-- Third party plugin JS-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
<!-- Core theme JS-->
<script src="<?= base_url('assets/js/beranda/script.js') ?>"></script>
<script>
    function CekNoIdentitas() {
        no = $('input#no_identitas').val();
        $(".no-identitas").text("");

        $.ajax({
            url: '<?= base_url('registration/no_identitas') ?>',
            type: 'post',
            dataType: 'json',
            success: function(data) {
                for (i = 0; i < data.length; i++) {
                    if (no) {
                        if (no == data[i].no_identitas) {
                            $(".no-identitas").text("No Identitas sudah ada!");
                        }
                    }
                }
            }
        });
    }

    function CekEmail() {
        no = $('input#email').val();
        $(".response-email").text("");

        $.ajax({
            url: '<?= base_url('registration/data_email') ?>',
            type: 'post',
            dataType: 'json',
            success: function(data) {
                for (i = 0; i < data.length; i++) {
                    if (no) {
                        if (no == data[i].email) {
                            $(".response-email").text("Email sudah ada!");
                        }
                    }
                }
            }
        });
    }

    function CekUsername() {
        no = $('input#username').val();
        $(".response-username").text("");

        $.ajax({
            url: '<?= base_url('registration/data_username') ?>',
            type: 'post',
            dataType: 'json',
            success: function(data) {
                for (i = 0; i < data.length; i++) {
                    if (no) {
                        if (no == data[i].username) {
                            $(".response-username").text("Username sudah ada!");
                        }
                    }
                }
            }
        });
    }
</script>
</body>

</html>