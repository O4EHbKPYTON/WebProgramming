<?php
session_start();
if (!empty($_GET)) {
    $_SESSION['surname'] = $_GET['surname'];
    $_SESSION['name'] = $_GET['name'];
    $_SESSION['age'] = $_GET['age'];
    header('Location: /2b-main.php');
    exit();
}
?>
<title>Form</title>
<form action="" method="get">
    <label for="surname">Surname</label>
    <input type="text" name="surname" required>

    <label for="name">Name</label>
    <input type="text" name="name" required>

    <label for="age">Age</label>
    <input type="number" name="age" min="0" max="150" maxlength="3" required>

    <input type="submit" value="Accept">
</form>
<form action="index.php" method="get">
    <input type="submit" value="Back">
</form>