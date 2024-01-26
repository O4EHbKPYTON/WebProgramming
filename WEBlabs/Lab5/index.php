<?php
$mysqli = new mysqli('db','root','helloworld','web');

if(mysqli_connect_errno()){
    printf('Cannot connect to mysql server. Error code: %s', mysqli_connect_error());
    exit();
}

$content = array();

if($result = $mysqli->query('SELECT * from ad')) {
    $i = 0;
    $j = 0;
    while ($row = $result->fetch_assoc()) {
        $content[$i][$j] = $row['email'];
        $j++;
        $content[$i][$j] = $row['title'];
        $j++;
        $content[$i][$j] = $row['description'];
        $j++;
        $content[$i][$j] = $row['category'];
        $i++;
        $j = 0;
    }
    $result->close();
}
$mysqli->close();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lab5</title>
</head>

<body>
<div id="form">
    <form action="index2.php" method="post">
        <label for="email">Email</label>
        <label><input type="email" name="email" required></label>

        <label for="category">Category</label>
        <label><select name="category" required>
                <?php
                $categories = array();
                $categories[0] = 'Games';
                $categories[1] = 'Music';
                $categories[2] = 'Sports';
                foreach ($categories as $category){
                    $capital = ucfirst($category);
                    echo "<option value=\"$category\">$capital</option>";
                }
                ?>
            </select></label>


        <label for="title">Title</label>
        <label><input type="text" name="title" required></label>

        <label for="description">Description</label>
        <label><textarea rows="3" name="description" required></textarea></label>

        <input type="submit" value="Save">
    </form>
</div>

<div id="table">
    <table>
        <thead>
        <th>Email</th>
        <th>Title</th>
        <th>Description</th>
        <th>Category</th>
        </thead>
        <tbody>
        <?php
        foreach ($content as $cont)
            if (!empty($cont))
                echo "<tr><td>$cont[0]</td><td>$cont[1]</td><td>$cont[2]</td><td>$cont[3]</td></tr>";
        ?>
        </tbody>
    </table>
</div>
</body>
</html>