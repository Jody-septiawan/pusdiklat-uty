<style>
    body {
        background-color: rgb(8, 10, 41);
    }
</style>
<!-- Masthead-->
<!-- Masthead-->
<header class="musthead pb-5">
    <div class="container pb-5">
        <div class="row align-items-center justify-content-center text-center pb-5">
            <div class="col-md-8">
                <form id="msform" action="<?= base_url('registration/addmember') ?>" method="post">
                    <ul id="progressbar">
                        <li class="active"> Personal Information</li>
                        <li>Contact & Category</li>
                        <li>Account Setup</li>
                    </ul>

                    <fieldset style="transform: scale(1);  opacity: 1; display: block;" class="tab">
                        <h2 class="fs-title " style="margin-bottom: 30px;">Personal Information</h2>
                        <input type="text" name="nama_lengkap" class="form-control nama" placeholder="Full name" required>
                        <small class="no-identitas text-danger"></small>
                        <input type="number" id="no_identitas" oninput="CekNoIdentitas()" name="no_identitas" class="form-control" placeholder="No Identitas" required>
                        <input type="text" name="tgl_lahir" class="form-control" placeholder="Date of birth" onfocus="(this.type='date')" onblur="(this.type='text')" required>
                        <select class="text-left form-control " name="gender" required style="padding-right: 100px; width: 100%;">
                            <option value="0">gender</option>
                            <option value="1">Laki-laki</option>
                            <option value="2">Perempuan</option>
                        </select>
                        <button type="button" name="next" class="next action-button py-1 mt-4">Next</button>
                    </fieldset>
                    <fieldset style="display: none; left: 50%; opacity: 0;" class="tab">
                        <h2 class="fs-title" style="margin-bottom: 30px;">Contact & Category</h2>
                        <input type="number" name="no_hp" class="form-control" placeholder="Phone number (WA)">
                        <select class="form-control " name="kategori" id="cek" oninput="CekInput()" style="margin-bottom: 10px;">
                            <option value="0">--Category--</option>
                            <?php foreach ($kategori as $k) : ?>
                                <option value="<?= $k['id'] ?>"><?= $k['nama_jenis'] ?></option>
                            <?php endforeach; ?>
                            <option value="99999">lainnya</option>
                        </select>
                        <select class="form-control " name="institusi" style="margin-bottom: 10px;">
                            <option value="0">--Institusi--</option>
                            <?php foreach ($institusi as $i) : ?>
                                <option value="<?= $i['id'] ?>"><?= $i['nama'] ?></option>
                            <?php endforeach; ?>
                            <option value="99999">lainnya</option>
                        </select>
                        <span class="" id="cek2">
                            <select class="form-control " name="prodi">
                                <option value="0">--Program Studi--</option>
                                <?php foreach ($prodi as $p) : ?>
                                    <option value="<?= $p['id'] ?>"><?= $p['nama'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </span>
                        <button type="button" name="previous" class="previous action-button-previous py-1 mt-4">Previous</button>
                        <button type="button" name="next" class="next action-button py-1 mt-4">Next</button>
                    </fieldset>
                    <fieldset class="tab">
                        <h2 class="fs-title">Create your account</h2>
                        <small class="response-email text-danger"></small>
                        <input type="email" id="email" oninput="CekEmail()" class="form-control" name="email" placeholder="Email">
                        <small class="response-username text-danger"></small>
                        <input type="text" id="username" oninput="CekUsername()" class="form-control" name="username" placeholder="Username">
                        <input type="password" class="form-control" name="password" placeholder="Password" id="pw1">
                        <small class="Confirm-pw text-danger"></small>
                        <input type="password" class="form-control mb-0" oninput="ConfirmPW()" id="pw2" name="cpass" placeholder="Confirm Password">
                        <button type="button" name="previous" class="previous action-button-previous py-1 mt-4">Previous</button>
                        <button type="submit" name="submit" class="submit action-button py-1 mt-4">Submit</button>
                    </fieldset>
                </form>
            </div>
            <!-- </div>
                    </div> -->
            <!-- </section> -->
        </div>
    </div>
</header>