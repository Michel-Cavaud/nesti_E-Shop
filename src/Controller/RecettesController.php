<?php

namespace App\Controller;

use App\Repository\RecettesRepository;
use App\Repository\CategoriesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RecettesController extends AbstractController
{
    protected $data;

    #[Route('/recettes', name: 'recettes')]
    public function index(RecettesRepository $repo, CategoriesRepository $repo2): Response
    {
        $this->data['btnMenu'] = ['text-noir hover:text-cyanclair', 'hover:text-noir text-cyanclair', 'text-noir hover:text-cyanclair'];
        $this->data['LIEN_IMAGES_RECETTES'] = $_ENV['LIEN_IMAGES_RECETTES'];

        $categories = $repo2->findAll();
        $recettes = $repo->findBy(['etatRecettes' => 'a']);

        foreach ($categories as $categorie) {
            $this->data['recettes'][$categorie->getId()] = [];
            foreach ($recettes as $recette) {
                foreach ($recette->getListCategories() as $categorieRecette) {
                    if ($categorieRecette->getIdCategories()->getId() == $categorie->getId()) {
                        $this->data['recettes'][$categorie->getId()][] = $recette;
                    }
                }
            }
        }
        $this->data['categories'] = $categories;

        //dd($this->data);
        return $this->render('recettes/index.html.twig', $this->data);
    }

    #[Route('/recherche/recettes', name: 'recherche_recettes')]
    public function rechercheRecettes(Request $request, RecettesRepository $repo): response
    {
        $retour['success'] = true;
        if ($request->isMethod('POST')) {
            $mot = $request->request->get('mot');
            $recettes = $repo->rechercheRecettes($mot);
            if (!empty($recettes)) {
                $html = '<div class="container-fluid mx-auto px-4 md:px-12">';
                $html .= '<div class="grid grid-cols-2 md:grid-cols-4 mx-1 lg:mx-4">';
                foreach ($recettes as $recette) {
                    $html .= '<a href="' . $this->generateUrl('recette', ['id' => $recette->getId()]) . '" >';
                    $html .= '<div class="my-1 px-4">';
                    $html .= '<article class="overflow-hidden rounded-lg shadow-md hover:shadow-xl">';
                    $html .= '<div class="mx-1 tooltip">';
                    $html .= '<img src="' . $_ENV['LIEN_IMAGES_RECETTES'] . $recette->getImages()->getNomImages() . '.' . $recette->getImages()->getExtensionImages() . '">';
                    $html .= '<span class="tooltiptext">' . $recette->getNomRecettes() . '</span>';

                    $html .= '<div>Chef : ' . $recette->getIdChef()->getPrenomUtilisateurs() . ' ' .  $recette->getIdChef()->getNomUtilisateurs() . '</div>';
                    if ($recette->getDonneUneNotes()['note']['moyenne'] != 0) {
                        $html .= '<div class="text-right">Note : ' . round($recette->getDonneUneNotes()['note']['moyenne'], 1) . '/5</div>';
                    } else {
                        $html .= '<div class="text-right">&oslash;<div>';
                    }
                    $html .= '</div><h1 class="text-sm lg:text-xl text-center font-croissant m-auto h-20 md:h-20">' . $recette->getNomRecettes() . '</h1>';
                    $html .= '<div class="text-center grid grid-cols-2 font-croissant m-0 text-cyanfonce text-1xl xl:text-2xl mb-3 font-extrabold">';
                    $html .= '<div><img class="inline w-8 lg:w-auto" alt="temps" src="../images/temps.png"/>';
                    $html .=  $recette->getTempsMn() . '<span class="text-sm">mn</span>';
                    $html .= '</div><div> <img class="inline w-8 lg:w-auto" alt="personnes" src="../images/personnes.png" />';
                    $html .=  $recette->getNombrePersonneRecettes();
                    $html .= '</div></div><div class="grid grid-cols-1 text-center font-croissant text-cyanfonce text-xl mb-3 font-extrabold"><div class="flex-1">';
                    $html .=  'Difficultée : ' . $recette->getDifficulteRecettes();
                    $html .=  '</div> </div></article>  </div></a>';
                }
                $html .= '</div></div>';
            } else {
                $html = '<div class="mb-96 font-croissant text-2xl text-center font-extrabold text-cyanfonce">Aucune de recette trouvée !!</div>';
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
