<?php
namespace Music\V2\Rest\Album;

class AlbumEntity
{
	public $id;
    public $artist;
    public $title;

    public function getArrayCopy()
    {
        return get_object_vars($this);
    }

    public function populate($data)
    {
        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }
    }
}
