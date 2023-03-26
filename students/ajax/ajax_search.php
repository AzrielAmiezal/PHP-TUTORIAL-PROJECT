<?php

require '../functions.php';
$students = search($_GET['keyword']);
?>

<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>No.</th>
        <th>Picture</th>
        <th>Student No</th>
        <th>Student Name</th>
        <th>Action</th>
    </tr>

    <?php if (empty($students)) : ?>
        <tr>
            <td colspan="5">
                <p style="color: red; font-style:italic; text-align:center;">Student information not available</p>
            </td>
        </tr>
    <?php endif; ?>
    <?php $i = 1;

    foreach ($students as $std) : ?>
        <tr>
            <td><?= $i++; ?></td>
            <td><img src="img/<?= $std['pictures']; ?>" width="60"></td>
            <td><?= $std['stdNo']; ?></td>
            <td><?= $std['stdName']; ?></td>
            <td>
                <a href="details.php?id=<?= $std['id']; ?>">view details</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>