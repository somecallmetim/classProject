<?php
/**
 * Created by PhpStorm.
 * User: timbauer
 * Date: 5/19/17
 * Time: 2:13 PM
 */

namespace AppBundle\Controller;


use AppBundle\Entity\ItemBookmark;
use AppBundle\Entity\ItemPost;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BookmarksController extends Controller
{
    /**
     * @Route("/{id}/bookmarkItem", name="addBookmark")
     */
    public function addBookmarkAction(ItemPost $itemPost){
        $em = $this->getDoctrine()->getManager();

        $bookmark = new ItemBookmark();

        $bookmark->setUser($this->getUser());
        $bookmark->setItemPost($itemPost);

        $em->persist($bookmark);
        $em->flush();

        $this->addFlash('success', "Congrats! You just bookmarked ".$itemPost->getName());

        return $this->redirectToRoute('itempost_index');
    }

    /**
     * @Route("/{id}/removeBookmark", name="removeBookmark")
     */
    public function deleteBookmarkAction(ItemBookmark $itemBookmark){
        $em = $this->getDoctrine()->getManager();

        $em->remove($itemBookmark);
        $em->flush();

        return $this->redirectToRoute('myBookmarks');
    }
}