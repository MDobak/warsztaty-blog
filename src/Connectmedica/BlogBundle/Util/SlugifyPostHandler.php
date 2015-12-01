<?php

namespace Connectmedica\BlogBundle\Util;
use Connectmedica\BlogBundle\Entity\Post;

/**
 * Class SlugifyPostHandler
 */
class SlugifyPostHandler implements SlugifyHandlerInterface
{
    /**
     * @param mixed $object
     *
     * @return bool
     */
    public function isSupported($object)
    {
        return $object instanceof Post;
    }

    /**
     * @param Post    $object
     *
     * @param Slugify $slug
     */
    public function handle($object, Slugify $slug)
    {
        $object->setSlug($slug->slugifyString($object->getTitle()));
    }
}