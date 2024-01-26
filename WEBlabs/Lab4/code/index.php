<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lab4</title>
</head>

<body>
<div id="form">
    <form action="table.php" method="post">
        <label for="email">Email</label>
        <label><input type="email" name="email" required></label>

        <label for="category">Category</label>
        <label><select name="category" required>
                <?php
                require __DIR__ . '/vendor/autoload.php';

                $client = new Google_Client();
                $client->setApplicationName('Google Sheets in PHP');
                $client->setScopes([Google_Service_Sheets::SPREADSHEETS]);
                $client->setAccessType('offline');
                $client->setAuthConfig(__DIR__ . '/credentials.json');

                $service = new Google_Service_Sheets($client);
                $range = 'E2:E4';

                $spreadsheetId = '1ZbKq0WGoH-hYI2HGFdgsfFx7_P-l7zoCQ3-W0a59tX4';
                $categories = $service->spreadsheets_values->get($spreadsheetId, $range);

                foreach ($categories as $category)
                    if ($category != '.' && $category != '..')
                        echo "<option value= $category[0] > $category[0] </option>";
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
        <th>Category</th>
        <th>Title</th>
        <th>Description</th>
        </thead>
        <tbody>
        <?php
        $range = 'A:D';

        $datas = $service->spreadsheets_values->get($spreadsheetId, $range);

        foreach ($datas as $data)
            if (!empty($data))
                echo "<tr><td>$data[0]</td><td>$data[1]</td><td>$data[2]</td><td>$data[3]</td></tr>";
        ?>
        </tbody>
    </table>
</div>
</body>
</html>