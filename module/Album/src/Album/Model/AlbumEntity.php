<?php
namespace Album\Model;

class AlbumEntity
{
    protected $id;
    protected $title;
    protected $artist;

    

    public function getId()
    {
      return $this->id;
    }

    public function setId($Value)
    {
      $this->id = $Value;
    }

    public function getTitle()
    {
      return $this->title;
    }

    public function setTitle($Value)
    {
      $this->title = $Value;
    }

    public function getArtist()
    {
      return $this->artist;
    }

    public function setArtist($Value)
    {
      $this->artist = $Value;
    }
   
}