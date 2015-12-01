<?php

namespace Connectmedica\BlogBundle\EventListener;

use Connectmedica\BlogBundle\Util\Slugify;
use Doctrine\ORM\Event\LifecycleEventArgs;

/**
 * Class SlugListener
 */
class SlugListener
{
    /**
     * @var Slugify
     */
    protected $slugify;

    /**
     * @param Slugify $slugify
     */
    public function __construct(Slugify $slugify)
    {
        $this->slugify = $slugify;
    }

    /**
     * @param LifecycleEventArgs $args
     */
    public function preUpdate(LifecycleEventArgs $args)
    {
        $this->slugify->slugifyObject($args->getEntity());
    }

    /**
     * @param LifecycleEventArgs $args
     */
    public function prePersist(LifecycleEventArgs $args)
    {
        $this->slugify->slugifyObject($args->getEntity());
    }
}