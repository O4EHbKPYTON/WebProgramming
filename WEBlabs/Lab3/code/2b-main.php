<?php
session_start();
if (empty($_SESSION)) {
    header('Location /');
    exit();
}
if (!empty($_SESSION)) {
    echo "Your surname: ", $_SESSION['surname'], "<br>";
    echo "Name: ", $_SESSION['name'], "<br>";
    echo "Age: ", $_SESSION['age'], "<br>";
}
?>
<title>Form</title>
<form action="index.php" method="get">
    <input type="submit" value="Back">
</form>