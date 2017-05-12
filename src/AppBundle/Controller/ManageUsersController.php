<?php
/**
 * Created by PhpStorm.
 * User: timbauer
 * Date: 3/8/17
 * Time: 12:21 PM
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


/**
 * Class ManageUsersController
 * @package AppBundle\Controller
 * @Security("is_granted('ROLE_ADMIN')")
 */
class ManageUsersController extends Controller
{

    /**
     * @Route("/list_users", name="list_users")
     */
    public function listUserAction(){
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('AppBundle:User')->findAll();


        return $this->render("user/listUsers.html.twig", [
            'users' => $users
        ]);
    }

    /**
     * @Route("/promote_user/{id}", name="promote_user")
     */
    public function promoteUserAction($id){
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:User')->find($id);

        $user->addOneRole('ROLE_ADMIN');

        $em->persist($user);
        $em->flush();

        return $this->redirectToRoute('list_users');
    }

    /**
     * @Route("/demote_user/{id}", name="demote_user")
     */
    public function demoteUserAction($id){
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:User')->find($id);

        if(!in_array('ROLE_SUPER_ADMIN', $user->getRoles())){
            $user->removeOneRole('ROLE_ADMIN');

            $em->persist($user);
            $em->flush();
        }

        return $this->redirectToRoute('list_users');
    }

    /**
     * @Route("/delete_user/{id}", name="delete_user")
     */
    public function deleteUserAction($id){
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:User')->find($id);

        if(!in_array('ROLE_SUPER_ADMIN', $user->getRoles())){
            $em->remove($user);
            $em->flush();
        }

        return $this->redirectToRoute('list_users');
    }
}