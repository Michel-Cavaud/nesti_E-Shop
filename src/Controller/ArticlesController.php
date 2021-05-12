<?php

namespace App\Controller;

use App\Repository\ArticlesRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArticlesController extends AbstractController
{
    protected $data;

    #[Route('/articles', name: 'articles')]
    public function index(ArticlesRepository $repo): Response
    {
        $this->data['btnMenu'] = ['text-noir hover:text-cyanclair', 'text-noir hover:text-cyanclair', 'hover:text-noir text-cyanclair'];
        $this->data['LIEN_IMAGES_RECETTES'] = $_ENV['LIEN_IMAGES_RECETTES'];

        $this->data['articles'] = $repo->findBy(['etatArticles' => 'a']);
        //dd($articles[0]->getStock());

        return $this->render('articles/index.html.twig', $this->data);
    }
}
