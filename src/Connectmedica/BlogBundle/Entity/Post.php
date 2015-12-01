<?php

namespace Connectmedica\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Connectmedica\BlogBundle\Repository\PostRepository")
 */
class Post
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     *
     * @var int
     */
    protected $id;

    /**
     * @ORM\Column(type="string", nullable=false)
     *
     * @var string
     */
    protected $title;

    /**
     * @ORM\Column(type="string", nullable=false)
     *
     * @var string
     */
    protected $slug;

    /**
     * @ORM\Column(type="text", nullable=false)
     *
     * @var string
     */
    protected $content;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     *
     * @var \DateTime
     */
    protected $addedAt;

    /**
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="post")
     */
    protected $comments;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->addedAt = new \DateTime();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Post
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     *
     * @return Post
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Post
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Add comment
     *
     * @param \Connectmedica\BlogBundle\Entity\Comment $comment
     *
     * @return Post
     */
    public function addComment(\Connectmedica\BlogBundle\Entity\Comment $comment)
    {
        $this->comments[] = $comment;

        $comment->setPost($this);

        return $this;
    }

    /**
     * Remove comment
     *
     * @param \Connectmedica\BlogBundle\Entity\Comment $comment
     */
    public function removeComment(\Connectmedica\BlogBundle\Entity\Comment $comment)
    {
        $this->comments->removeElement($comment);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getComments()
    {
        return $this->comments;
    }
}
