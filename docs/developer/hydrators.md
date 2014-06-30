# Hydrators

REF:  
* <sup>1</sup> Behrens, John. __"What is a Hydrator in Zend Framework 2."__ _Webconsults Blog._, 04 May 2013. Web [What is a Hydrator in Zend Framework 2](http://www.webconsults.eu/blog/entry/108-What_is_a_Hydrator_in_Zend_Framework_2). Accessed 26 Jun 2014.


There are some predefined Hydrators which cover the most common purposes.
A Hydrator is described in the HydratorInterface Hydrator Interface Zend\Stdlib\Hydrator


`namespace Zend\Stdlib\Hydrator`
 
	interface HydratorInterface
	{
	    /**
	     * Extract values from an object
	     *
	     * @param  object $object
	     * @return array
	     */
	    public function extract($object);
	 
	    /**
	     * Hydrate $object with the provided $data.
	     *
	     * @param  array $data
	     * @param  object $object
	     * @return object
	     */
	    public function hydrate(array $data, $object);
	}
	
## ClassMethods Hydrator

Class Methods The ClassMethod Hydrator is using get* and set* functions of the hydrated object to “hydrate”

## ObjectProperty Hydrator  
Object Property The ObjectProperty Hydrator is very similar to the classMethods Hydrator but is using the public object properties instead of the getter and setter values.

## Reflection Hydrator  
Reflection< Is Like ObjectProperty Hydrator but makes private and protected properties accessible to be hydrated or extracted. Mostly this concept does not seem like something you commonly use caus there is a reason if your properties are private, more like for special usage only.

## ArraySerializable Hydrator  
ArraySerializable Is for objects implementing the ArraySerializable interface.

## AbstractHydrator  
Is the Abstract parent class of all other Hydrators we know so far. So far it is not that complicated you got 4 Simple Hydrators which cover the most common usages we have dealing with Forms or other Standard procedures. But finally that is not everything a hydrator can do, there is also an enhanced functionality, besides just “mapping” Objects to Arrays wich would simply just be a Mapper