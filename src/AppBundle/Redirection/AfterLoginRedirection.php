<?php
/**
 * @copyright  Copyright (c) 2009-2014 Steven TITREN - www.webaki.com
 * @package    Webaki\UserBundle\Redirection
 * @author     Steven Titren <contact@webaki.com>
 */
namespace AppBundle\Redirection;

use AppBundle\Entity\User;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
class AfterLoginRedirection extends User implements AuthenticationSuccessHandlerInterface
{
    /**
     * @var \Symfony\Component\Routing\RouterInterface
     */
    private $router;
    /**
     * @param RouterInterface $router
     */
    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }
    /**
     * @param Request $request
     * @param TokenInterface $token
     * @return RedirectResponse
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {
        $currentuser = $this->getUsername();
       // var_dump($token);
       $id_user = $token->getUser()->id;
      //$id_user = $token['id'];
      //var_dump($id_user);

        // Get list of roles for current user
        $roles = $token->getRoles();
        // Tranform this list in array
        $rolesTab = array_map(function($role){
          return $role->getRole();
        }, $roles);
        // If is a admin or super admin we redirect to the backoffice area
        
        if ( in_array('ROLE_SUPER_ADMIN', $rolesTab, true))
             $redirection = new RedirectResponse($this->router->generate('admin_homepage'));
             else
                
            $redirection = new RedirectResponse($this->router->generate('abonnement_revendeur_homepage', array(
                'user' => $id_user,
                    )));

        return $redirection;
    }
}
