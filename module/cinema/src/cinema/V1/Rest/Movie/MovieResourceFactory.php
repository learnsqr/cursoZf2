<?php
namespace cinema\V1\Rest\Movie;

class MovieResourceFactory
{
    public function __invoke($services)
    {
        return new MovieResource();
    }
}
