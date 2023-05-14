<?php

declare(strict_types=1);

namespace Alura\Mvc\Controller;

use Alura\Mvc\Repository\VideoRepository;
use Alura\Mvc\Entity\Video;

class JsonVideoListController implements Controller
{

    public function __construct(private VideoRepository $videoRepository)
    {
    }

    public function processaRequisicao(): void
    {
        $videoList = array_map(function (Video $video): array {
            return [
                'url' => $video->url,
                'title' => $video->title,
                'file_path' => '/img/uploads/' . $video->getFilePath(),
            ];
        }, $this->videoRepository->all());
    }
}
