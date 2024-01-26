<?php
session_start();
if (!empty($_GET)) {
    $_SESSION['mas'] = $_GET;
    header('Location: /2c-main.php');
    exit();
}
?>
<title>HardForm</title>
<form action="" method="get">
    <label for="name">Name</label>
    <input type="text" name="name" required>

    <label for="age">Age</label>
    <input type="number" name="age" min="0" max="150" maxlength="3" required>

    <label for="salary">Salary</label>
    <input type="number" name="salary" min="0" required>

    <label for="cat">Cat name</label>
    <input type="text" name="cat" required>

    <input type="submit" value="Accept">
</form>
<form action="index.php" method="get">
    <input type="submit" value="Back">
</form>