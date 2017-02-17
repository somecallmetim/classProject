<?php
/**
 * Created by PhpStorm.
 * User: timbauer
 * Date: 2/15/17
 * Time: 4:46 PM
 */

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class JeffreyController extends Controller
{
    /**
     * @Route("/aboutJeffrey", name="about_jeffrey")
     */
    public function aboutJeffreyAction(){
        return $this->render('aboutJeffrey.html.twig', [
            'developerLink' => '#jeffrey-navbar-link'
        ]);
    }
}