<form action="" method="get">
        <textarea name="text" placeholder="Enter text"></textarea>
        <input type="submit" value="Calculate   ">
</form>
<?php
if (isset($_GET['text'])) {
    $text = $_GET['text'];
    echo "Word count: ", str_word_count($text, $format = 0), "<br>";
    echo "Characters count: ", strlen($text);
}
?>
<form action="index.php" method="get">
    <input type="submit" value="Back">
</form>
