<?php

namespace Connectmedica\BlogBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class CommentController
 */
class CommentController extends Controller
{
    /**
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(Request $request)
    {
        $id = $request->request->get('id');
        $em = $this->getDoctrine()->getManager();

        $comment = $em->find('ConnectmedicaBlogBundle:Comment', $id);
        if (!$comment) {
            throw $this->createNotFoundException();
        }

        $em->remove($comment);
        $em->flush();

        return $this->redirect($request->headers->get('referer'));
    }
}
