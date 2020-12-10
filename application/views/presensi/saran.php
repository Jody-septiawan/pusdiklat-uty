<div class="container my-bg">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="card mt-5">
                <div class="mx-5 my-3">
                    <form action="<?= base_url('presensi/saran') ?>" method="post">
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1" class="text-dark h3">Kritik & Saran</label>
                            <textarea name="content" class="form-control shadow" id="exampleFormControlTextarea1" rows="5"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>