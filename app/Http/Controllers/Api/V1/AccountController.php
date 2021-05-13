<?php

namespace App\Http\Controllers\Api\V1;

use App\Contracts\ClientRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Resources\AccountCollection;
use Exception;
use Illuminate\Http\Response;

/**
 * Class AccountController
 *
 * @package App\Http\Controllers\Api\V1
 */
class AccountController extends Controller
{
    /**
     * @var ClientRepositoryInterface
     */
    private $clientRepository;

    /**
     * AccountController constructor.
     * @param ClientRepositoryInterface $clientRepository
     */
    public function __construct(ClientRepositoryInterface $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }

    /**
     * Get all Clients
     *
     * @return AccountCollection|\Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            return new AccountCollection($this->clientRepository->getAllClients());

        } catch (Exception $e) {
            return response()->json([
                'error' => Response::$statusTexts[Response::HTTP_BAD_REQUEST],
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
