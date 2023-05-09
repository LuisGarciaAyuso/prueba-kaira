<?php

namespace App\Repositories;

use App\Models\Url;

class UrlEloquentRepository implements UrlRepository
{
    /**
     * @param $id
     */
    public function find($id)
    {
        //
    }

    /**
     * @param array $data
     */
    public function findMany(array $data)
    {
        //
    }

    /**
     * @param array $data
     *
     * @return Url
     */
    public function create(array $data)
    {
        return Url::create($data);
    }

    /**
     * @param       $id
     * @param array $data
     */
    public function update($id, array $data)
    {
        //
    }

    /**
     * @param $id
     */
    public function delete($id)
    {
        //
    }
}
