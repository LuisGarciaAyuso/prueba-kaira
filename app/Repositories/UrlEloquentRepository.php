<?php

namespace App\Repositories;

use App\Models\Url;

class UrlEloquentRepository implements UrlRepository
{
    /**
     * @param $id
     *
     * @return Url
     */
    public function find($id)
    {
        return Url::find($id);
    }

    /**
     * @param array $data
     *
     * @return Url
     */
    public function findMany(array $data)
    {
        return Url::where($data)->get();
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
     *
     * @return Url
     */
    public function update($id, array $data)
    {
        return Url::find($id)->create($data);
    }

    /**
     * @param $id
     *
     * @return Url
     */
    public function delete($id)
    {
        Url::destroy($id);
    }
}
