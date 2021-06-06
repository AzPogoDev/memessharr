<?php

namespace App\Controller;

use App\Aware\PdoAware;
use App\Aware\MemeRepositoryAware;
use App\Aware\Twig;
use App\Aware\TwigAware;
use App\Aware\RequestAware;
use App\Entity\Comment;
use App\Entity\Meme;
use PDO;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use App\Repository\MemeRepository;

class HomeController implements PdoAware, RequestAware, TwigAware, MemeRepositoryAware
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

    public function home(): Response
    {

        $meme = null;

        if ($this->request->request->has('memesub')) {

            $memecontent = $this->request->request->get('memecontent');

            $newmeme = new Meme('Anonmye', $memecontent);

            $this->repo->addMeme($newmeme);

        }

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.imgflip.com/get_memes",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
        ]);

        $response = curl_exec($curl);

        $response = json_decode($response,true);
        $response = $response['data']['memes'];

        curl_close($curl);


        return new Response($this->twig->render(
            'home.html.twig',
            ['memes' => $this->repo->getRecentsArticles(10),
                'apimeme' => $response]));
    }

}


