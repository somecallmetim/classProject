<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ItemPost;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Itempost controller.
 *
 * @Route("itempost")
 */
class ItemPostController extends Controller
{
    /**
     * Lists all itemPost entities.
     *
     * @Route("/", name="itempost_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $itemPosts = $em->getRepository('AppBundle:ItemPost')->findAll();

        return $this->render('itempost/index.html.twig', array(
            'itemPosts' => $itemPosts
        ));
    }

    /**
     * @Security("is_granted('ROLE_USER')")
     *
     * @Route("/new", name="itempost_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {

        $form = $this->createForm('AppBundle\Form\ItemPostType');
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $itemPost = $form->getData();
            $itemPost->setPostDate(new \DateTime());
            $itemPost->setUser($this->getUser());

            $files = $itemPost->getPhotoList();

            if ($files != null) {
                foreach($files as $file) {
                    // Generate a unique name for the file before saving it
                    $fileName = md5(uniqid()) . '.' . $file->guessExtension();
                    // Move the file to the correct folder
                    $file->move(
                        $this->getParameter('upload_destination'),
                        $fileName
                    );

                    //stores path to file into database
                    $itemPost->addPhoto('/images/ItemPostPhotos/' . $fileName);
                }
            }

            $em->persist($itemPost);
            $em->flush();

            return $this->redirectToRoute('itempost_index');
        }

        return $this->render('itempost/new.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * Finds and displays a itemPost entity.
     *
     * @Route("/{id}", name="itempost_show")
     * @Method("GET")
     */
    public function showAction(ItemPost $itemPost)
    {
       


        return $this->render('itempost/show.html.twig', array(
            'itemPost' => $itemPost,
        ));
    }

    /**
     * Displays a form to edit an existing itemPost entity.
     *
     * @Route("/{id}/edit", name="itempost_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ItemPost $itemPost)
    {

        $this->denyAccessUnlessGranted('edit', $itemPost);

        $editForm = $this->createForm('AppBundle\Form\ItemPostType', $itemPost);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('itempost_index', array('id' => $itemPost->getId()));
        }

        return $this->render('itempost/edit.html.twig', array(
            'itemPost' => $itemPost,
            'edit_form' => $editForm->createView()
        ));
    }


    /**
     * @Route("/{id}/delete", name="itempost_delete")
     */
    public function deleteAction(ItemPost $itemPost){

        $this->denyAccessUnlessGranted('delete', $itemPost);

        $em = $this->getDoctrine()->getManager();
        $em->remove($itemPost);
        $em->flush();

        return $this->redirectToRoute('itempost_index');
    }

}
