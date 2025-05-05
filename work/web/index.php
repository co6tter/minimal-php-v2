<?php

require('../app/functions.php');

createToken();

define('FILENAME', '../app/messages.txt');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    validateToken();

    $message = trim(filter_input(INPUT_POST, 'message'));
    $message = $message !== '' ? $message : '...';

    $fp = fopen(FILENAME, 'a');
    fwrite($fp, $message . PHP_EOL);
    fclose($fp);

    header('Location: http://localhost:8000/result.php');
    exit;
}

$messages = file(FILENAME, FILE_IGNORE_NEW_LINES);

include('../app/_parts/_header.php');

?>

<h1>Messages</h1>

<ul>
    <?php foreach ($messages as $index => $message) : ?>
        <li>
            <?= h($message); ?>
            <a href="edit.php?id=<?= $index; ?>">Edit</a>
            <a href="delete.php?id=<?= $index; ?>">Delete</a>
        </li>
    <?php endforeach; ?>
</ul>

<form action="" method="post">
    <input type="text" name="message">
    <button>Post</button>
    <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
</form>

<?php

include('../app/_parts/_footer.php');
