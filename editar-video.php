<?php

$dbPath = __DIR__ . '/banco.sqlite';
$pdo = new PDO("sqlite:$dbPath");

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if ($id === false || $id === null) {
    header('Location: /?sucesso=0');
    exit();
}

$url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);
if ($url === false) {
    header('Location: /?sucesso=0');
    exit();
}
$titulo = filter_input(INPUT_POST, 'titulo');
if ($titulo === false) {
    header('Location: /?sucesso=0');
    exit();
}

$video = new \Alura\Mvc\Entity\Video($url, $titulo);
$video->setId($id);

$repository = new \Alura\Mvc\Repository\VideoRepository($pdo);

if ($repository->update($video) === false) {
    header('Location: /?sucesso=0');
} else {
    header('Location: /?sucesso=1');
}
