<?php

namespace App\Controller;

use App\Repository\ArticlesRepository;
use Symfony\Component\HttpFoundation\Request;
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

    #[Route('/recherche/articles', name: 'recherche_articles')]
    public function rechercheArticles(Request $request, ArticlesRepository $repo): Response
    {
        $retour['success'] = true;
        if ($request->isMethod('POST')) {
            $mot = $request->request->get('mot');
            $articles = $repo->rechercheArticles($mot);
            if (!empty($articles)) {
                $html = '<div class="container-fluid mx-auto px-4 md:px-12">';
                $html .= '<div class="grid grid-cols-2 md:grid-cols-5 mx-1 lg:mx-4 gap-10">';
                foreach ($articles as $article) {
                    $html .= '<article class="overflow-hidden flex flex-col justify-between h-full rounded-lg shadow-md hover:shadow-xl">';
                    $html .= '<a href="">';
                    $html .= '<div class="aspect-w-3 aspect-h-2">';
                    $html .= '<img class="object-cover" src="' . $_ENV['LIEN_IMAGES_RECETTES'] . $article->getIdImages()->getNomImages() .  '.' .  $article->getIdImages()->getExtensionImages() . '">';
                    $html .= '</div><div class="grid grid-cols-2  font-croissant text-cyanfonce font-extrabold text-lg my-4">';
                    $html .= '<div class="ml-2">' . $article->getNomUsageArticles() . '</div>';
                    $html .= '<div class="place-self-end mr-2">' . $article->getPrixArticle()->getPrixPrixArticle() . '€</div>';
                    $html .= '</div></a> <div>';
                    if ($article->getStock() < 1) {
                        $html .= '<div class="text-center  font-croissant text-xs lg:text-sm">Article en rupture de stock</div>';
                    } else {
                        $html .= '<div class="text-center fonct-croissant">&nbsp;</div>';
                    }
                    $html .= '</div><div class="flex flex-col  xl:flex-row justify-around text-center font-croissant my-4 content-center "><div class="self-center"><label for="quantity">Quantité&nbsp;:&nbsp;</label></div>';
                    $html .= '<div class="self-center">
                            <input class="pl-1 quantity text-center appearance-none block w-full border-gray-200 rounded leading-tight focus:outline-none 
                            focus:ring-1 focus:ring-blue-500 focus:border-blue-500';
                    if ($article->getStock() < 1) {
                        $html .= 'disabled:opacity-50" disabled';
                    } else {
                        $html .= '"';
                    }
                    $html .= ' id="artId' . $article->getId() . '" name="quantity" type="number" value="';
                    if ($article->getStock() > 0) {
                        $html .= '0" ';
                    } else {
                        $html .= '"';
                    }
                    $html .= 'min="0" max="' . $article->getStock() . '">';
                    $html .= '</div><div class="text-2xl self-center"><div class="text-blanc hover:text-cyanclair">';
                    $html .= '<i data-id="' . $article->getId() . '"  data-nom="' . $article->getNomUsageArticles() . '"';
                    $html .= 'data-prix="' . $article->getPrixArticle()->getPrixPrixArticle() . '" data-stock="' . $article->getStock() . '"';
                    $html .= 'data-image="' . $_ENV['LIEN_IMAGES_RECETTES'] . $article->getIdImages()->getNomImages() . '.' . $article->getIdImages()->getExtensionImages() . '"';
                    $html .= 'class="fas fa-cart-plus';
                    if ($article->getStock() < 1) {
                        $html .= 'opacity-50';
                    } else {
                        $html .= ' panier cursor-pointer';
                    }
                    $html .= '"></i>
                            </div>
                        </div>
                    </div>
                    </article>  ';
                }
            } else {
                $html = '<div class="mb-96 font-croissant text-2xl text-center font-extrabold text-cyanfonce">Aucun article trouvé !!</div>';
            }
            $retour['html'] = $html;
        } else {
            $retour['success'] = false;
        }

        $response = new Response(json_encode($retour));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}
