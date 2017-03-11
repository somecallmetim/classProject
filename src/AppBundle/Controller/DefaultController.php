<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('base.html.twig', [
            'linkId' => '#home-nabvar-link'
        ]);
    }

    /**
     * @Route("/underConstruction", name="under_construction")
     */
    public function underConstructionAction()
    {
        return $this->render('underConstruction.html.twig');
    }
}
