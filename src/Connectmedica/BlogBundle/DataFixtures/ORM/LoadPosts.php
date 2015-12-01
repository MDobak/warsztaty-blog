<?php

namespace Connectmedica\BlogBundle\DataFixtures\ORM;

use Connectmedica\BlogBundle\Entity\Post;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory as FakerFactory;

/**
 * Class LoadPosts
 */
class LoadPosts implements FixtureInterface, OrderedFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $faker = FakerFactory::create();

        for ($i = 0; $i < 100; $i++) {
            $post = new Post();

            $post->setTitle($faker->sentence(rand(4, 12)));
            $post->setContent(
                implode(
                    PHP_EOL,
                    array_map(
                        function($v) { return '<p>'.$v.'</p>'; },
                        $faker->paragraphs(rand(3, 30))
                    )
                )
            );

            $manager->persist($post);
        }

        $manager->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 1;
    }
}