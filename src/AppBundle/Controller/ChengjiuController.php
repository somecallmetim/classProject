<?php
/**
 * Created by PhpStorm.
 * User: chengjiu
 * Date: 2/15/17
 * Time: 4:46 PM
 */

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ChengjiuController extends Controller
{
    /**
     * @Route("/aboutChengjiu", name="about_chengjiu")
     */
    public function aboutChengjiuAction(){
        return $this->render("aboutChengjiu.html.twig",[
            'developerLink' => '#cj-navbar-link'
        ]);
    }
}