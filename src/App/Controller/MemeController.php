<?php

namespace App\Controller;

use App\Aware\PdoAware;
use App\Aware\MemeRepositoryAware;
use App\Aware\Twig;
use App\Aware\TwigAware;
use App\Aware\RequestAware;
use App\Entity\Comment;
use PDO;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use App\Repository\MemeRepository;
use Symfony\Component\HttpFoundation\ParameterBag;

class MemeController implements PdoAware, RequestAware, TwigAware, MemeRepositoryAware
{

    private ?MemeRepository $repo = null;

    private ?PDO $pdo = null;

    private ?Request $request = null;

    private ?Environment $twig = null;

    public function setMemeRepository(MemeRepository $repository)
    {
        $this->repo = $repository;
    }


    public function setPdo(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function setRequest(Request $request)
    {
        $this->request = $request;
    }

    public function setTwig(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function memes(): Response
    {

        return new Response($this->twig->render(
            'memes.html.twig',
            ['memes' => $this->repo->getAll()]));
    }

    public function show(): Response
    {
        $comment = null;

        if ($this->request->request->has('commentadd')) {

            $comment = $this->request->request->get('commentairemg');

            $newcomment = new Comment('Anonyme', $comment, $this->request->query->get('id'));

            $this->repo->addComment($newcomment);

        }


        return new Response($this->twig->render(
            'meme.html.twig',
            [
                'memesingle' => $this->repo->getById($this->request->query->get('id')),
                'comments' => $this->repo->GetComments($this->request->query->get('id')),
            ],


        ));
    }


}
