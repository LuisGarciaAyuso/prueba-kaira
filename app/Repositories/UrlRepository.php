<?php

namespace App\Repositories;

interface UrlRepository
{
    /**
     * @param $id
     *
     * @return mixed
     */
    public function find($id);

    /**
     * @param array $data
     *
     * @return mixed
     */
    public function findMany(array $data);

    /**
     * @param array $data
     *
     * @return mixed
     */
    public function create(array $data);

    /**
     * @param       $id
     * @param array $data
     *
     * @return mixed
     */
    public function update($id, array $data);

    /**
     * @param $id
     *
     * @return mixed
     */
    public function delete($id);
}
