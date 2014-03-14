<?php

namespace Breaker\Mapper;

interface OptionInterface
{
    public function fetchAll();

    public function findById($id);

    public function insert($option);

    public function update($option);
    
    public function delete($option);
}
