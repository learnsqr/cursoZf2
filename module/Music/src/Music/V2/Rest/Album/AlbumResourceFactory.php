<?php
namespace Music\V2\Rest\Album;

class AlbumResourceFactory
{
    public function __invoke($services)
    {
        return new AlbumResource();
    }
}
