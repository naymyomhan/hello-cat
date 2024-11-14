<?php

namespace Naymyomhan\HelloCat;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Log;

class Cat
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api.thecatapi.com/v1/',
        ]);
    }

    /**
     * Fetch a random cat image.
     *
     * @return array
     */
    public function image()
    {
        try {
            $response = $this->client->request('GET', 'images/search');
            $body = json_decode($response->getBody()->getContents(), true);
            
            return [
                'success' => true,
                'message' => $response->getReasonPhrase(),
                'data' => [
                    'image' => $body[0]['url'],
                    'width' => $body[0]['width'],
                    'height' => $body[0]['height'],
                ],
            ];
        } catch (ClientException $e) {
            Log::error('Cat API request failed: ' . $e->getMessage());
            return $this->handleError("Something went wrong while fetching the cat image.");
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
