<?php

namespace App\Lib;

use App\Entity\LogsUtilisateurs;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Logout\LogoutSuccessHandlerInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationFailureHandlerInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;


class AuthenticationHandler extends AbstractController implements AuthenticationSuccessHandlerInterface, AuthenticationFailureHandlerInterface, LogoutSuccessHandlerInterface
{
    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {

        $user = $token->getUser()->getId();
        $this->logUser($user);

        $array = array('success' => true);
        $response = new Response(json_encode($array));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**

     * @param Request $request
     * @param AuthenticationException $exception
     * @return Response
     */
    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {

        $array = array('success' => false, 'message' => $exception->getMessage()); // data to return via JSON
        $response = new Response(json_encode($array));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    public function onLogoutSuccess(Request $request)
    {
        $array = array('success' => true); // data to return via JSON
        $response = new Response(json_encode($array));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    private function logUser($user)
    {
        $repo = $this->getDoctrine()->getManager();
        $log = new LogsUtilisateurs;
        $log->setIdUtilisateurs($user);
        $log->setDateLogsUtilisateurs(new \DateTime());

        $repo->persist($log);
        $repo->flush();
    }
}
