<?php

namespace Naymyomhan\HelloCat;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Log;

class CatGroup
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api.thecatapi.com/v1/',
        ]);
    }

    /**
     * Fetch multiple cat images based on the limit and breed ID.
     *
     * @param int $limit
     * @param string|null $breed_ids
     * @return array
     */
    public function images(int $limit = 10, string $breed_ids = null)
    {
        try {
            $response = $this->client->request('GET', 'images/search', [
                'query' => [
                    'limit' => $limit,
                    'breed_ids' => $breed_ids,
                    'api_key' => config('cat.api_key'),
                ],
            ]);
            $body = json_decode($response->getBody()->getContents(), true);

            return [
                'success' => true,
                'message' => $response->getReasonPhrase(),
                'data' => $body,
            ];
        } catch (ClientException $e) {
            Log::error('Cat API request failed: ' . $e->getMessage());
            return $this->handleError("Something went wrong while fetching the cat images.");
        } catch (\Exception $e) {
            Log::error('Unexpected error: ' . $e->getMessage());
            return $this->handleError("An unexpected error occurred.");
        }
    }

    /**
     * Handle error response.
     *
     * @param string $message
     * @return array
     */
    protected function handleError(string $message)
    {
        return [
            'success' => false,
            'message' => $message,
            'data' => null,
        ];
    }
}
