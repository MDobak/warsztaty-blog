<?php

namespace Connectmedica\BlogBundle\Util;

/**
 * Class SlugifyHandlerInterface
 */
interface SlugifyHandlerInterface
{
    /**
     * @param mixed $object
     *
     * @return mixed
     */
    public function isSupported($object);

    /**
     * @param mixed $object
     *
     * @param Slugify $slug
     */
    public function handle($object, Slugify $slug);
}