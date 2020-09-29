<?php
error_reporting(E_ALL & ~E_NOTICE);
include "header.php";

if (!isset($_POST['word'])) {
    $words = [
        'WETTER',
        'ZOFINGEN',
        'INFORMATIKER',
        'HUT',
        'BAUM',
        'ARSENAL',
        'COMPUTER',
    ];

    shuffle($words);
    $word = $words[0];

} else {
    $word = $_POST['word'];
}

$letters        = str_split($word);
$display_submit = str_split($_POST['display']);

$display = "";
$correct = false;
foreach ($letters as $letter_pos => $letter) {
    if ($letter == strtoupper($_POST['letter'])) {
        $display .= $letter;
        $correct = true;
    } else {
        if ($display_submit[$letter_pos] != "_") {
            $display .= $display_submit[$letter_pos];
        } else {
            $display .= "_";
        }
    }
}

if (!$correct) {
    $errors = isset($_POST['errors']) ? $_POST['errors'] + 1 : 0;
} else {
    $errors = $_POST['errors'];
}
?>

<h1>Loreans Hangman Game</h1>


<?php if ($word == $display) {
    ?>
    <h1>Du hast gewonnen!</h1>
    <a href="index.php">neues Spiel starten</a>
    <?php
} else {
    if ($errors < 10) {
        ?>
        <form action="" method="post">
            <input type="hidden" name="errors" value="<?= $errors ?>">
            <input type="hidden" name="word" value="<?= $word ?>">
            <input type="hidden" name="display" value="<?= (strlen($display) == "0") ? str_repeat("_", strlen($word)) : $display ?>  ?>">
            <input type="text" maxlength="1" name="letter" required>
            <input type="submit" value="Senden">
        </form>
    <?php }
} ?>

<?php
?><h1 style="letter-spacing: 10px"><?= $display; ?></h1> <?php

?><h2>Anzahl Fehlversuche: <?= $errors; ?></h2> <?php

if ($errors > 0) {
    ?>
    <img src="hangman<?= $errors; ?>.png"/>  </h2> <?php
}

if ($errors == 10) {
    ?>
    <h1>Du bist tot!</h1>
    <a href="index.php">neues Spiel starten</a>
<?php }

?>
    <br>
    <br>
    <a href="https://github.com/sba/hangman" target="_blank">Programmcode auf Github</a>
<?php

include "footer.php";
