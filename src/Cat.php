<?php

namespace Naymyomhan\HelloCat;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Log;

class Cat
{
    public function image()
    {
        $client = new Client(
            [
                'base_uri' => 'https://api.thecatapi.com/v1/',
            ]
        );

        try {
            $response = $client->request('GET', 'images/search');
            $body = json_decode($response->getBody()->getContents());
            return response()->json([
                'success' => true,
                'message' => $response->getReasonPhrase(),
                'data' => [
                    'image' => $body[0]->url,
                    'width' => $body[0]->width,
                    'height' => $body[0]->height,
                ]
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
