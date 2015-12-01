<?php

namespace Connectmedica\BlogBundle\Controller;

use Connectmedica\BlogBundle\Entity\Comment;
use Connectmedica\BlogBundle\Entity\Post;
use Connectmedica\BlogBundle\Form\CommentType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class PostController
 */
class PostController extends Controller
{
    /**
     * @param $id
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction(Request $request, $id)
    {
        $em   = $this->getDoctrine()->getManager();
        $post = $em->find('ConnectmedicaBlogBundle:Post', $id);

        if (!$post) {
            throw $this->createNotFoundException();
        }

        $commentForm = $this->createForm(new CommentType(), null, []);

        $commentForm->handleRequest($request);
        if ($commentForm->isSubmitted()) {
            /** @var Comment $comment */
            $comment = $commentForm->getData();

            $comment->setPost($post);

            $em->persist($comment);
            $em->flush();
        }

        return $this->render(
            'ConnectmedicaBlogBundle:Post:show.html.twig',
            [
                'post' => $post,
                'comment_form' => $commentForm->createView()
            ]
        );
    }
}
