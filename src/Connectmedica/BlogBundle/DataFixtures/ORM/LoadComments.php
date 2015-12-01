<?php

namespace Connectmedica\BlogBundle\DataFixtures\ORM;

use Connectmedica\BlogBundle\Entity\Comment;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory as FakerFactory;

/**
 * Class LoadComments
 */
class LoadComments implements FixtureInterface, OrderedFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $faker = FakerFactory::create();
        $posts = $manager->getRepository('ConnectmedicaBlogBundle:Post')->findAll();

        foreach ($posts as $post) {
            for ($i = 0; $i < rand(0, 10); $i++) {
                $comment = new Comment();

                $comment->setPost($post);
                $comment->setContent($faker->sentence(rand(3, 40)));
                $comment->setAuthor($faker->name);
                $comment->setAddedAt(new \DateTime);

                $manager->persist($comment);
            }

            $manager->flush();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 2;
    }
}