<?php

namespace Breaker\Mapper;

interface BreakerInterface
{
    public function findById($email);

    public function findByProjectname($username);

    public function findByProducer($id);

    public function insert($user);

    public function update($user);   
}
