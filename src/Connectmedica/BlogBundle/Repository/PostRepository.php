<?php

namespace Connectmedica\BlogBundle\Repository;

use Connectmedica\BlogBundle\Entity\Post;
use Doctrine\ORM\EntityRepository;

/**
 * Class PostRepository
 */
class PostRepository extends EntityRepository
{
    /**
     * @return Post[]
     */
    public function findHomepagePosts()
    {
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();

        $qb
            ->select('post')
            ->from('ConnectmedicaBlogBundle:Post', 'post')
            ->orderBy('post.id', 'DESC')
        ;

        return $qb->getQuery()->getResult();
    }
}