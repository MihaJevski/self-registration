<?php

namespace App\Repositories;

use App\Contracts\ClientRepositoryInterface;
use App\Models\Client;
use App\Models\User;
use App\RequestTransformers\{Filter, Sort};
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\Hash;

/**
 * Class ClientRepository
 *
 * @package App\Repositories
 */
class ClientRepository implements ClientRepositoryInterface
{
    /**
     * Get all clients
     *
     * @return mixed
     */
    public function getAllClients()
    {
        return app(Pipeline::class)
            ->send(Client::query())
            ->through([
                Sort::class,
                Filter::class
            ])
            ->thenReturn()
            ->with('users')
            ->paginate();
    }

    /**
     * Get Existing Client
     *
     * @param array $data
     * @return mixed
     */
    public function getExistingClient(array $data)
    {
        return Client::where('client_name', $data['name'])
            ->where('address1', $data['address1'])
            ->where('address2', $data['address2'])
            ->where('city', $data['city'])
            ->where('state', $data['state'])
            ->where('country', $data['country'])
            ->first();
    }

    /**
     * Create client
     *
     * @param array $data
     * @return Client
     */
    public function saveClient(array $data): Client
    {
        $client = new Client();

        $client->client_name = $data['name'];
        $client->address1 = $data['address1'];
        $client->address2 = $data['address2'];
        $client->city = $data['city'];
        $client->state = $data['state'];
        $client->country = $data['country'];
        $client->zip = $data['zipCode'];
        $client->phone_no1 = $data['phoneNo1'];
        $client->phone_no2 = $data['phoneNo2'];
        $client->latitude = $data['latitude'];
        $client->longitude = $data['longitude'];
        $client->start_validity = now();
        $client->end_validity = now()->addDays(15);

        $client->save();

        return $client;
    }

    /**
     * Attach user to client
     *
     * @param Client $client
     * @param array $data
     */
    public function attachUser($client, array $data)
    {
        $user = new User();

        $user->first_name = $data['firstName'];
        $user->last_name = $data['lastName'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->phone = $data['phone'];
        $user->profile_uri = $data['profileUri'] ?? null;
        $user->last_password_reset = now();
        $user->status = User::ACTIVE;

        $client->users()->save($user);
    }
}
