<h1>List sertifikasi</h1>

<table border='1' cellpadding="10" cellspacing="0">
    <tr>
        <th>No</th>
        <th>Sertifikasi</th>
        <th>Ket</th>
    </tr>
    <?php foreach ($sertifikasi as $sr) : ?>
        <tr>
            <td><?= $sr['id']; ?></td>
            <td><?= $sr['nama_sertifikasi']; ?></td>
            <td><?= $sr['alias']; ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<h1>List spesifikasi</h1>

<table border='1' cellpadding="10" cellspacing="0">
    <tr>
        <th>No</th>
        <th>Spesifikasi</th>
    </tr>
    <?php foreach ($spesifikasi as $sp) : ?>
        <tr>
            <td><?= $sp['id'] ?></td>
            <td><?= $sp['spesifikasi'] ?></td>
        </tr>
    <?php endforeach; ?>
</table>