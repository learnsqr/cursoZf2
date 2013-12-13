<?php

namespace Breaker\Entity;

interface OptionInterface
{
    /**
     * Get id.
     *
     * @return int
     */
    public function getId();

    /**
     * Set id.
     *
     * @param int $id
     * @return OptionInterface
     */
    public function setId($id);

    /**
     * Get name.
     *
     * @return string
     */
    public function getName();

    /**
     * Set name.
     *
     * @param string $name
     * @return OptionInterface
     */
    public function setName($name);

    /**
     * Get color.
     *
     * @return string
     */
    public function getColor();

    /**
     * Set color.
     *
     * @param string $color
     * @return OptionInterface
     */
    public function setColor($color);

    /**
     * Get hashtag.
     *
     * @return string
     */
    public function getHashtag();

    /**
     * Set hashtag.
     *
     * @param string $hashtag
     * @return OptionInterface
     */
    public function setHashtag($hashtag);
}
