head>
<meta charset="UTF-8">
<meta name="viewport"
      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Board</title>
</head>
<body>
<div id="form">
    <form action="3.php" method="post">
        <label for="email">Email</label>
        <input type="email" name="email" required>

        <label for="category">Category</label>
        <select name="category" required>
            <?php
            $categories = scandir("categories");
            foreach ($categories as $category)
                if ($category != '.' && $category != '..') {
                    $capital = ucfirst($category);
                    echo "<option value=\"$category\">$capital</option>";
                }
            ?>
        </select>

        <label for="title">Title</label>
        <input type="text" name="title">

        <label for="description">Description</label>
        <textarea rows="3" name="description"></textarea>

        <input type="submit" value="Save">
    </form>

    <form action="index.php" method="get">
        <input type="submit" value="Back">
    </form>
</div>
<div id="table">
    <table>
        <thead>
        <th>Category</th>
        <th>Title</th>
        <th>Description</th>
        </thead>
        <tbody>
        <?php
        $categories = scandir("categories");
        foreach ($categories as $category)
            if ($category != '.' && $category != '..') {
                $capital = ucfirst($category);
                $specificCategory = scandir("categories/$category");
                foreach ($specificCategory as $ad)
                    if($ad != '.' && $ad != '..') {
                        $title = mb_substr($ad, 0, -4);
                        $desc = file_get_contents("categories/{$category}/{$ad}");
                        echo "<tr><td>$capital</td><td>$title</td><td>$desc</td></tr>";
                    }
            }
        ?>
        </tbody>
    </table>
</div>
</body>