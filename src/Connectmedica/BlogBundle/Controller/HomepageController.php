<?php

namespace Connectmedica\BlogBundle\Controller;

use Connectmedica\BlogBundle\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class HomepageController
 */
class HomepageController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        /** @var PostRepository $postRepository */
        $postRepository = $this->getDoctrine()->getRepository('ConnectmedicaBlogBundle:Post');
        $posts = $postRepository->findHomepagePosts();

        return $this->render(
            'ConnectmedicaBlogBundle:Homepage:index.html.twig',
            [
                'posts' => $posts
            ]
        );
    }
}
