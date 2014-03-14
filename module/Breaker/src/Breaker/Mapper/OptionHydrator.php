<?php

namespace Breaker\Mapper;

use Zend\Stdlib\Hydrator\ClassMethods;
use Breaker\Entity\OptionInterface as OptionEntityInterface;

class OptionHydrator extends ClassMethods
{
    /**
     * Extract values from an object
     *
     * @param  object $object
     * @return array
     * @throws Exception\InvalidArgumentException
     */
    public function extract($object)
    {
        if (!$object instanceof OptionEntityInterface) {
            throw new Exception\InvalidArgumentException('$object must be an instance of Breaker\Entity\OptionInterface');
        }
        /* @var $object OptionInterface*/
        $data = parent::extract($object);
        $data = $this->mapField('id', 'idoption', $data);
        return $data;
    }

    /**
     * Hydrate $object with the provided $data.
     *
     * @param  array $data
     * @param  object $object
     * @return OptionInterface
     * @throws Exception\InvalidArgumentException
     */
    public function hydrate(array $data, $object)
    {
        if (!$object instanceof OptionEntityInterface) {
            throw new Exception\InvalidArgumentException('$object must be an instance of Breaker\Entity\OptionInterface');
        }
        $data = $this->mapField('idoption', 'id', $data);
        return parent::hydrate($data, $object);
    }

    protected function mapField($keyFrom, $keyTo, array $array)
    {
        $array[$keyTo] = $array[$keyFrom];
        unset($array[$keyFrom]);
        return $array;
    }
}
