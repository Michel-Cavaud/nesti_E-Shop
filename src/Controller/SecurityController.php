<?php

namespace App\Controller;

use App\Repository\CommentairesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SecurityController extends AbstractController
{
    #[Route('/connexion', name: 'security_login')]
    public function login()
    {
        return $this->json('');
    }

    #[Route('/deconnexion', name: 'security_logout')]
    public function logout()
    {
        return $this->json('');
    }

    #[Route('/getuser', name: 'security_getuser', methods: ['POST'])]
    public function user(Request $request, CommentairesRepository $repo)
    {
        $user = $this->getUser();
        if ($user == null) {
            $array = array('success' => true, 'user' => $user);
        } else {
            $idRecette = $request->request->get('id');

            $comUser = $repo->findOneBy(['idRecettes' => $idRecette, 'idUtilisateurs' => $user->getId()]);
            if ($comUser != null) {
                $array = array('success' => false);
            } else {
                $array = array('success' => true, 'user' => $user);
            }
        }

        $response = new Response(json_encode($array));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    #[Route('/getuserPaiement', name: 'security_getuserpaiement', methods: ['POST'])]
    public function userPaiement()
    {
        $user = $this->getUser();
        if ($user == null) {
            $array = array(
                'success' => true, 'user' => $user
            );
        } else {
            $array = array(
                'success' => true, 'user' => $user, 'civilite' => $user->getCiviliteUtilisateurs(), 'nom' => $user->getNomUtilisateurs(), 'prenom' => $user->getPrenomUtilisateurs(),
                'email' => $user->getEmailUtilisateurs(), 'adresse1' => $user->getAdresse1Utilisateurs(),
                'adresse2' => $user->getAdresse2Utilisateurs(), 'codepostal' => $user->getCodePostalUtilisateurs(),
                'ville' => $user->getidVille()->getNomVille()
            );
        }



        $response = new Response(json_encode($array));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}
