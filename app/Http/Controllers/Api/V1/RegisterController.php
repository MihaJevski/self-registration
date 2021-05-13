<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterFormRequest;
use App\Services\RegisterService;

/**
 * Class RegisterController
 *
 * @package App\Http\Controllers\Api\V1
 */
class RegisterController extends Controller
{
    /**
     * @var RegisterService
     */
    private $registerService;

    /**
     * RegisterController constructor.
     * @param RegisterService $registerService
     */
    public function __construct(RegisterService $registerService)
    {
        $this->registerService = $registerService;
    }

    /**
     * Register user
     *
     * @param RegisterFormRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterFormRequest $request): \Illuminate\Http\JsonResponse
    {
        $this->registerService->register($request->all());

        return response()->json(['message' => 'Successfully registered']);
    }
}
