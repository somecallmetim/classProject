<?php
/**
 * Created by PhpStorm.
 * User: timbauer
 * Date: 2/14/17
 * Time: 5:19 PM
 */

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class TimController extends Controller
{
    /**
     * @Route("/aboutTim", name="about_tim")
     */
    public function aboutTimAction(){
        return $this->render('aboutTim.html.twig', [
            'developerLink' => '#tim-navbar-link'
        ]);
    }
}