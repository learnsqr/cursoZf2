<?php

namespace Breaker\Mapper;

use Zend\Stdlib\Hydrator\ClassMethods;
use Breaker\Entity\BreakerInterface as BreakerEntityInterface;
use RuntimeException;

class BreakerHydrator extends ClassMethods
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
        if (!$object instanceof BreakerEntityInterface) {
            //throw new Exception\InvalidArgumentException('$object must be an instance of Acl\Entity\UserInterface');
        	throw new RuntimeException('$object must be an instance of Project\Entity\ProjectInterface');
        }
        /* @var $object UserInterface*/
        $data = parent::extract($object);
//         $data = $this->mapField('id', 'user_id', $data);        
        return $data;
    }

    /**
     * Hydrate $object with the provided $data.
     *
     * @param  array $data
     * @param  object $object
     * @return UserInterface
     * @throws Exception\InvalidArgumentException
     */
    public function hydrate(array $data, $object)
    {
        if (!$object instanceof BreakerEntityInterface) {
            //throw new Exception\InvalidArgumentException('$object must be an instance of Acl\Entity\UserInterface');
        	throw new RuntimeException('$object must be an instance of Project\Entity\ProjectInterface');
        }
//         $data = $this->mapField('user_id', 'id', $data);        
        return parent::hydrate($data, $object);
    }

    protected function mapField($keyFrom, $keyTo, array $array)
    {
        $array[$keyTo] = $array[$keyFrom];
        unset($array[$keyFrom]);
        return $array;
    }
}
