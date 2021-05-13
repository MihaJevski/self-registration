<?php

namespace App\Services;

use App\Contracts\ClientRepositoryInterface;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;
use Spatie\Geocoder\Geocoder;

class RegisterService
{
    /**
     * @var ClientRepositoryInterface
     */
    private $clientRepository;

    /**
     * RegisterService constructor.
     * @param ClientRepositoryInterface $clientRepository
     */
    public function __construct(ClientRepositoryInterface $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }

    /**
     * Register user and attach him to client
     *
     * @param array $data
     */
    public function register(array $data)
    {
        $client = $this->clientRepository->getExistingClient($data);

        if (!$client) {
            $address = $this->generateFullAddress($data);

            $kye = $this->generateCacheKey($address);

            $coordinates = $this->getCoordinates($kye, $address);

            $data['latitude'] = $coordinates[0];
            $data['longitude'] = $coordinates[1];

            $client = $this->clientRepository->saveClient($data);
        }

        $this->clientRepository->attachUser($client, $data['user']);
    }

    /**
     * Generate Full Address
     *
     * @param array $data
     * @return string
     */
    public function generateFullAddress(array $data): string
    {
        return sprintf('%s %s, %s, %s %s, %s',
            $data['address1'],
            $data['address2'],
            $data['city'],
            $data['state'],
            $data['zipCode'],
            $data['country']);
    }

    /**
     * Generate Cache Key
     *
     * @param string $address
     * @return string
     */
    public function generateCacheKey(string $address): string
    {
        return strtolower(str_replace([' ', ','], '', $address));
    }

    /**
     * Get coordinates from google API
     *
     * @param string $address
     * @return string
     */
    protected function getCoordinatesFromApi(string $address): string
    {
        $client = new Client();
        $geocoder = new Geocoder($client);
        $geocoder->setApiKey(config('geocoder.key'));
        $result = $geocoder->getCoordinatesForAddress($address);

        return sprintf('%s;%s', $result['lat'], $result['lng']);
    }

    /**
     * Get coordinates from cache or from google API
     *
     * @param string $kye
     * @param string $address
     * @return array
     */
    public function getCoordinates(string $kye, string $address): array
    {
        $coordinates = Cache::rememberForever($kye, function() use ($address) {
            return $this->getCoordinatesFromApi($address);
        });

        return explode(';', $coordinates);
    }
}
