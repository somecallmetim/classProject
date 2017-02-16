<?php
/**
 * Created by PhpStorm.
 * User: mayara
 * Date: 2/15/17
 * Time: 4:46 PM
 */

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MayaraController extends Controller {
    /**
     * @Route( "/aboutMayara", name="about_mayara")
     */
    public function aboutMayaraAction() {
        return $this->render('aboutMayara.html.twig', [
            'developerLink' => '#amy-navbar-link'
        ]);

    }
}