<?php

namespace App\Contracts;

/**
 * Interface ClientRepositoryInterface
 *
 * @package App\Contracts
 */
interface ClientRepositoryInterface
{
    public function getAllClients();

    public function getExistingClient(array $data);

    public function saveClient(array $data);

    public function attachUser($client, array $data);
}
