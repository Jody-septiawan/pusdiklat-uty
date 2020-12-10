<?php
date_default_timezone_set('Asia/Jakarta');
$no = 0;
?>

<div class="container-fluid mb-5 ">
    <div class="row">
        <div class="col-md-12">

            <div class="card shadow">
                <div class="card-header bg-primary border-bottom-warning text-right">
                    <form action="<?= base_url('user/resethistory') ?>" method="post">
                        <button class="btn btn-success">Reset</button>
                    </form>
                </div>
                <div class="card-body">
                    <?php if ($history) : ?>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Username</th>
                                        <th>Ip Address</th>
                                        <th>Browser</th>
                                        <th>Sistem Operasi</th>
                                        <th>Pukul (WIB)</th>
                                        <th>Tanggal</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($history as $h) : ?>
                                        <tr class="<?php if ($h['status'] == 'login') {
                                                        echo 'table-info';
                                                    }  ?>">
                                            <td><?= $no + 1; ?></td>
                                            <td><?= $h['username'] ?></td>
                                            <td><?= $h['ip_address'] ?></td>
                                            <td><?= $h['browser'] ?></td>
                                            <td><?= $h['sistem_operasi'] ?></td>
                                            <td><?= date('H:i:s', $h['time']) ?></td>
                                            <td><?= date('d-m-Y', $h['time']) ?></td>
                                            <td><?= $h['status'] ?></td>
                                        </tr>
                                    <?php $no++;
                                    endforeach; ?>
                                    <tr>
                                        <td colspan="8" class="text-center p-2">
                                            <form action="<?= base_url('User/history') ?>" method="post">
                                                <?php if ($see == 0) { ?>
                                                    <input type="hidden" name="see" value="1">
                                                    <button class="btn btn-link p-0">See more</button>
                                                <?php } else { ?>
                                                    <input type="hidden" name="see" value="0">
                                                    <button class="btn btn-link p-0">Hide</button>
                                                <?php } ?>
                                            </form>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    <?php else : ?>
                        <h4>No data</h4>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>