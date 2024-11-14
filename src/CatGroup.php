<?php

namespace Naymyomhan\HelloCat;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Log;

class CatGroup
{
    public function images(int $limit = 10, string $breed_ids = null)
    {    
        $client = new Client(
            [
                'base_uri' => 'https://api.thecatapi.com/v1/',
            ]
        );

        try {
            $response = $client->request('GET', 'images/search', [
                'query' => [
                    'limit' => $limit,
                    'breed_ids' => $breed_ids,
                    'api_key' => config('cat.api_key'),
                ],
            ]);
            $body = json_decode($response->getBody()->getContents());
            return response()->json([
                'success' => true,
                'message' => $response->getReasonPhrase(),
                'data' => $body,
            ], 200);
        } catch (ClientException $e) {
            Log::error($e->getMessage());
            return response()->json([
                'success' => false,
                'message' => "Something went wrong",
            ], 500);
        }
    }
}
