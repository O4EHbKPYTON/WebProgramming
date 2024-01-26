<?php
function redirectToBoard(): void
{
    header('Location: /index.php');
    exit();
}
if (false === isset($_POST['email'], $_POST['category'], $_POST['title'], $_POST['description']))
    redirectToBoard();

$email = $_POST['email'];
$title = $_POST['title'];
$description = $_POST['description'];
$category = $_POST['category'];

$mysqli = new mysqli('db','root','helloworld','web');

if(mysqli_connect_errno()){
    printf('Cannot connect to mysql server. Error code: %s', mysqli_connect_error());
    exit();
}

$mysqli->query("INSERT INTO ad (email, title, description, category) VALUES('$email', '$title', '$description', '$category')");
$mysqli->close();

redirectToBoard();