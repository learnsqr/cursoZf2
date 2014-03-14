<?php

namespace Breaker\Entity;

class Option implements OptionInterface
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $color;

    /**
     * @var string
     */
    protected $hashtag;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set id.
     *
     * @param int $id
     * @return OptionInterface
     */
    public function setId($id)
    {
        $this->id = (int) $id;
        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set name.
     *
     * @param string $name
     * @return OptionInterface
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get color.
     *
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set color.
     *
     * @param string $color
     * @return OptionInterface
     */
    public function setColor($color)
    {
        $this->color = $color;
        return $this;
    }

    /**
     * Get hashtag.
     *
     * @return string
     */
    public function getHashtag()
    {
        return $this->hashtag;
    }

    /**
     * Set hashtag.
     *
     * @param string $hashtag
     * @return OptionInterface
     */
    public function setHashtag($hashtag)
    {
        $this->hashtag = $hashtag;
        return $this;
    } 
}
