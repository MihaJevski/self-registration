<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AccountCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return parent::toArray($request);
    }

    /**
     * Customize the response for a request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\JsonResponse $response
     * @return void
     */
    public function withResponse($request, $response)
    {
        $data = $response->getData(true);

        $data['links'] = [
            'path' => $data['meta']['path'],
            'firstPageUrl' => $data['links']['first'],
            'lastPageUrl' => $data['links']['last'],
            'nextPageUrl' => $data['links']['next'],
            'prevPageUrl' => $data['links']['prev']
        ];

        $data['meta'] = [
            'currentPage' => $data['meta']['current_page'],
            'from' => $data['meta']['from'],
            'lastPage' => $data['meta']['last_page'],
            'perPage' => $data['meta']['per_page'],
            'to' => $data['meta']['to'],
            'total' => $data['meta']['total'],
            'count' => count($data['data']),
        ];

        $response->setData($data);
    }
}
