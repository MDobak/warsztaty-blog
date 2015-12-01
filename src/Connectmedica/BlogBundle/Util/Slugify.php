<?php

namespace Connectmedica\BlogBundle\Util;

/**
 * Class Slugify
 */
class Slugify
{
    /**
     * @var string
     */
    protected $delimiter = '_';

    /**
     * @var SlugifyHandlerInterface[]
     */
    protected $handlers = [];

    /**
     * @param string $delimiter
     *
     * @return $this
     */
    public function setDelimiter($delimiter)
    {
        $this->delimiter = $delimiter;

        return $this;
    }

    /**
     * @param SlugifyHandlerInterface $handler
     */
    public function addHandler(SlugifyHandlerInterface $handler)
    {
        $this->handlers[] = $handler;
    }

    /**
     * @param mixed $object
     *
     * @return bool
     */
    public function slugifyObject($object)
    {
        foreach ($this->handlers as $handler) {
            if ($handler->isSupported($object)) {
                $handler->handle($object, $this);

                return true;
            }
        }

        return false;
    }

    /**
     * @param $string
     *
     * @return string
     */
    public function slugifyString($string)
    {
        $string = preg_replace('#[^\\pL\d]+#u', $this->delimiter, $string);

        return transliterator_transliterate(
            "Any-Latin; NFD; [:Nonspacing Mark:] Remove; NFC; [:Punctuation:] Remove; Lower();",
            $string
        );
    }
}