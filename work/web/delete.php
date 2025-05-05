<?php

require('../app/functions.php');

createToken();

define('FILENAME', '../app/messages.txt');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    validateToken();

    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    if ($id !== false) {
        $messages = file(FILENAME, FILE_IGNORE_NEW_LINES);
        unset($messages[$id]);
        file_put_contents(FILENAME, implode(PHP_EOL, $messages) . PHP_EOL);

        header('Location: http://localhost:8000/index.php');
        exit;
    }
}

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if ($id === false) {
    header('Location: http://localhost:8000/index.php');
    exit;
}

$messages = file(FILENAME, FILE_IGNORE_NEW_LINES);
$message = $messages[$id];

include('../app/_parts/_header.php');

?>

<h1>Delete Message</h1>

<p>Are you sure you want to delete the following message?</p>
<p><?= h($message); ?></p>

<form action="" method="post">
    <input type="hidden" name="id" value="<?= $id; ?>">
    <button>Delete</button>
    <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
</form>

<?php

include('../app/_parts/_footer.php');
