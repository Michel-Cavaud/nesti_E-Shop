<?php

namespace App\Controller;

use App\Entity\Ville;
use App\Entity\Commandes;
use App\Entity\Utilisateurs;
use App\Entity\LigneDeCommandes;
use App\Form\CreerUtilisateurType;
use App\Repository\VilleRepository;
use App\Repository\ArticlesRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\CommentairesRepository;
use App\Repository\UtilisateursRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{
    protected $data;

    #[Route('/inscription', name: 'security_inscription')]
    public function inscription(Request $request, EntityManagerInterface $em, VilleRepository $repo, UtilisateursRepository $repo2, UserPasswordEncoderInterface $encoder)
    {

        $this->data['btnMenu'] = ['text-noir hover:text-cyanclair', 'text-noir hover:text-cyanclair', 'text-noir hover:text-cyanclair'];
        $this->data['LIEN_IMAGES_RECETTES'] = $_ENV['LIEN_IMAGES_RECETTES'];

        $utilisateur = new Utilisateurs();

        $form = $this->createForm(CreerUtilisateurType::class, $utilisateur);
        $form->handleRequest($request);
        $this->data['erreur'] = "";

        if ($form->isSubmitted() && $form->isValid()) {

            $ville = new Ville();

            $listUtilisateur = $repo2->rechercheUser($utilisateur->getUsername(), $utilisateur->getEmailUtilisateurs());

            if (!empty($listUtilisateur)) {
                $this->data['erreur'] = "L'utilisateur existe déjà!";
            } else {
                $listVille = $repo->findOneBy(['nomVille' => $request->request->get('creer_utilisateur')['ville']]);
                if (empty($listVille)) {
                    $ville->setnomVille($request->request->get('creer_utilisateur')['ville']);
                    $utilisateur->setIdVille($ville);
                } else {
                    $utilisateur->setIdVille($listVille);
                }
                $utilisateur->setdateCreationUtilisateurs(new \DateTime());
                $hash = $encoder->encodePassword($utilisateur, $utilisateur->getPassword());
                $utilisateur->setPassWord($hash);
                $utilisateur->setetatUtilisateurs('a');

                $em->persist($utilisateur);
                $em->flush();

                return $this->redirectToRoute('home', array(
                    'connexion' => 1
                ));
            }
        }

        $this->data['form'] = $form->createView();
        return $this->render('security/inscription.html.twig', $this->data);
    }

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

    #[Route('/validcommande', name: 'security_validcommande', methods: ['POST'])]
    public function validCommande(Request $request, EntityManagerInterface $em, UtilisateursRepository $repo, ArticlesRepository $repo2)
    {
        $paniers = $request->toArray();
        $user = $repo->find($this->getUser()->getId());

        $commande =  new Commandes;
        $commande->setIdUtilisateurs($user);
        $commande->setDateCreationCommandes(new \DateTime());
        $commande->setEtatCommandes('a');
        $em->persist($commande);
        $em->flush();

        foreach ($paniers as $panier) {
            $ligne = new LigneDeCommandes();
            $ligne->setidCommandes($commande);
            $article = $repo2->find($panier['id']);
            $ligne->setIdExterne($article);
            $ligne->setQuantiteCommandes($panier['qty']);
            $em->persist($ligne);
        }
        $em->flush();

        $array = array(
            'success' => true
        );

        $response = new Response(json_encode($array));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}
