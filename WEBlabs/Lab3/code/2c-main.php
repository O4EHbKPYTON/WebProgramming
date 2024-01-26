<?php
session_start();
if (empty($_SESSION)) {
    header('Location /');
    exit();
}
?>

<title>HardForm</title>
<ul>
    <?php
    echo 'Info:';
    foreach ($_SESSION['mas'] as $elem):
        ?>
        <li>
            <?php
            echo $elem, ' ';
            ?>
        </li>
    <?php
    endforeach;
    ?>
</ul>
<form action="index.php" method="get">
    <input type="submit" value="Back">
</form>