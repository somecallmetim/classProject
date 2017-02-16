<?php
/**
 * Created by PhpStorm.
 * User: andrewlesondak
 * Date: 2/15/17
 * Time: 5:45 PM
 */

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;



class AndrewController extends Controller
{
    /**
     * @Route("/aboutAndrew", name="about_andrew")
     */
    public function aboutTimAction(){
        return $this->render('aboutAndrew.html.twig', [
            'developerLink' => '#andrew-navbar-link'
        ]);
    }
}