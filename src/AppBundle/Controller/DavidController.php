<?php
/**
 * Created by PhpStorm.
 * User: davipwns
 * Date: 2/15/17
 * Time: 4:46 PM
 */

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DavidController extends Controller
{
    /**
     * @Route("/aboutDavid", name="about_david")
     */
    public function aboutDavidAction()
    {
        return $this->render('aboutDavid.html.twig', [
            'developerLink' => 'david-navbar-link'
        ]);
    }
}