<?php
namespace Music\V1\Rest\Album;

class AlbumResourceFactory
{
    public function __invoke($services)
    {
        return new AlbumResource();
    }
}
