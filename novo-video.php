<?php

$dbPath = __DIR__ . "/banco.sqlite";
$pdo = new PDO("sqlite:$dbPath");

$url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);
if ($url === false) {
    header('Location: /index.php?sucesso=0');
    exit;
}
$title = filter_input(INPUT_POST, 'titulo');
if ($title === false) {
    header('Location: /index.php?sucesso=0');
    exit;
}

$sql = "INSERT INTO videos (url, title) VALUES (?, ?)";

$statement = $pdo->prepare($sql);
$statement->bindParam(1, $_POST['url']);
$statement->bindParam(2, $_POST['titulo']);

if ($statement->execute() === false) {
    header('Location: /index.php?sucesso=0');
} else {
    header('Location: /index.php?sucesso=1');
}
