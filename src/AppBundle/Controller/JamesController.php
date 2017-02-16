<?php
/**
 * Created by PhpStorm.
 * User: jameslee
 * Date: 2/15/17
 * Time: 4:57 PM
 */

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class JamesController extends Controller
{
    /**
     * @Route("/aboutJames", name="about_james")
     */
    public function aboutJamesAction(){
        return $this->render('aboutJames.html.twig',[
            'developerLink' => '#james-navbar-link'
    ]);
    }
}