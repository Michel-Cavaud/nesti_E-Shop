<?php

namespace App\Controller;

use App\Repository\RecettesRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    protected $data;

    /**
     * @Route("/", name="home")
     */

    //#[Route('/', name: 'home')]
    public function index(SerializerInterface $serializer, RecettesRepository $repo): Response
    {

        $this->data['btnMenu'] = ['hover:text-noir text-cyanclair', 'text-noir hover:text-cyanclair', 'text-noir hover:text-cyanclair'];

        $recettes = $repo->findBy(['etatRecettes' => 'a']);

        //créer le json
        $this->data['jsonContent'] = $serializer->serialize($recettes, 'json', ['groups' => 'json_recette']);
        //return $this->json($recettes, 200, ['groups' => 'json_recette']);
        $this->data['recettes'] = $recettes;
        $this->data['LIEN_IMAGES_RECETTES'] = $_ENV['LIEN_IMAGES_RECETTES'];
        return $this->render('home/index.html.twig', $this->data);
    }


    /**
     * Temps recette en minute
     *
     * @param string $temps
     * @return temps recette en minutes
     */
    private function formatTempsMn(string $temps): ?string
    {
        $arrayTemps = explode(":", $temps);
        if ($arrayTemps[0] == '00') {
            $retour = $arrayTemps[1];
        } else {
            $retour = $arrayTemps[0] * 60 + $arrayTemps[1];
        }

        return $retour;
    }
}
