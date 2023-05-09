<?php

$dbPath = __DIR__ . "/banco.sqlite";
$pdo = new PDO("sqlite:$dbPath");

$url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);
if ($url === false) {
    header('Location: /?sucesso=0');
    exit;
}
$title = filter_input(INPUT_POST, 'titulo');
if ($title === false) {
    header('Location: /?sucesso=0');
    exit;
}

$repository = new Alura\Mvc\Repository\VideoRepository($pdo);

if ($repository->add(new \Alura\Mvc\Entity\Video($url, $title)) === false) {
    header(header: 'Location: /?sucesso=0');
} else {
    header(header: 'Location: /?sucesso=1');
}
