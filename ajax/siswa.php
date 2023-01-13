<?php
require '../fungsi.php';
$keyword = $_GET["keyword"];
$query = "SELECT * FROM siswasiswi 
WHERE
nama LIKE '%$keyword%' OR
nisn LIKE '%$keyword%' OR
email LIKE '%$keyword%' OR
jurusan LIKE '%$keyword%'

";
$siswa = query($query);
?>
<table cellpadding="10" border="1" cellspacing="0">
    <tr>
        <th>no</th>
        <th>aksi</th>
        <th>gambar</th>
        <th>nama</th>
        <th>nisn</th>
        <th>jurusan</th>
        <th>email</th>
    </tr>

    <form method="post" action="">
        <?php $i = 1; ?>
        <?php foreach ($siswa as $wa) : ?>
            <tr>
                <td>
                    <?= $i; ?>
                </td>
                <td>
                    <a href="ubah.php?id=<?= $wa["id"]; ?>">ubah</a> |
                    <a href="hapus.php?id=<?= $wa["id"]; ?>" onclick="return confirm('yakin');">hapus</a>
                </td>
                <td><img src="img/<?= $wa["gambar"]; ?>" width="50"></td>
                <td><?= $wa["nama"]; ?></td>
                <td><?= $wa["nisn"]; ?></td>
                <td><?= $wa["jurusan"]; ?></td>
                <td><?= $wa["email"]; ?></td>
            </tr>
            <?php $i++; ?>
        <?php endforeach; ?>


    </form>
</table>