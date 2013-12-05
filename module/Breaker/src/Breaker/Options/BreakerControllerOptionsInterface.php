<?php

namespace Breaker\Options;

interface BreakerControllerOptionsInterface
{
    /**
	 * set some var here
	 *
	 * @param string $someVarHere
	 */
    public function setSomeVarHere($someVarHere);

    /**
	 * get some var here
	 *
	 * @return string
	 */
    public function getSomeVarHere();
}
