<?php

namespace App\Repositories;

interface UrlRepository
{
    public function find($id);

    public function findMany(array $data);

    public function create(array $data);

    public function update($id, array $data);

    public function delete($id);
}
