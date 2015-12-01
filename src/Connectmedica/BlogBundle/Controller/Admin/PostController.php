<?php

namespace Connectmedica\BlogBundle\Controller\Admin;

use Connectmedica\BlogBundle\Entity\Post;
use Connectmedica\BlogBundle\Form\PostType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class PostController
 */
class PostController extends Controller
{
    /**
     * @param Request $request
     * @param $id
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        if ($id) {
            $post = $em->find('ConnectmedicaBlogBundle:Post', $id);
        } else {
            $post = new Post;
        }

        if (!$post) {
            throw $this->createNotFoundException();
        }

        $form = $this->createForm(new PostType(), $post, []);

        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $em->persist($post);
            $em->flush();

            return $this->redirectToRoute('connectmedica_blog_admin_post_edit', ['id' => $post->getId()]);
        }

        return $this->render(
            'ConnectmedicaBlogBundle:Admin/Post:edit.html.twig',
            [
                'post' => $post,
                'form' => $form->createView()
            ]
        );
    }

    /**
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(Request $request)
    {
        $id = $request->request->get('id');
        $em = $this->getDoctrine()->getManager();

        $post = $em->find('ConnectmedicaBlogBundle:Post', $id);
        if (!$post) {
            throw $this->createNotFoundException();
        }

        $em->remove($post);
        $em->flush();

        return $this->redirectToRoute('connectmedica_blog_homepage');
    }
}
