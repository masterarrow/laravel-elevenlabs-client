<?php

namespace ElevenLabsWrapper\ElevenLabsClient;

use Exception;
use ElevenLabsWrapper\ElevenLabsClient\History\History;
use ElevenLabsWrapper\ElevenLabsClient\Interfaces\ElevenLabsClientInterface;
use ElevenLabsWrapper\ElevenLabsClient\Models\Models;
use ElevenLabsWrapper\ElevenLabsClient\Responses\ErrorResponse;
use ElevenLabsWrapper\ElevenLabsClient\TextToSpeech\TextToSpeech;
use ElevenLabsWrapper\ElevenLabsClient\TextToSpeech\TextToSpeechInterface;
use ElevenLabsWrapper\ElevenLabsClient\User\User;
use ElevenLabsWrapper\ElevenLabsClient\Voice\Voice;
use GuzzleHttp\Client;

class ElevenLabsClient implements ElevenLabsClientInterface
{
    protected $apiKey;

    protected $httpClient;

    const BASE_URL = 'https://api.elevenlabs.io/v1/';

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;

        $this->httpClient = new Client([
            'base_uri' => self::BASE_URL,
            'headers' => [
                'xi-api-key' => $this->apiKey,
                'Accept' => 'application/json',
            ],
        ]);
    }

    public function getHttpClient(): Client
    {
        return $this->httpClient;
    }


    /**
     * Get the Voice Instance.
     *
     * @return Voice The Voice instance.
     */
    public function voices(): Voice
    {
        return new Voice($this);
    }

    /**
     * Get the TextToSpeech Instance.
     *
     * @return TextToSpeech The Voice instance.
     */
    public function textToSpeech() : TextToSpeechInterface
    {
        return new TextToSpeech($this);
    }

    /**
     * Get the History Instance.
     *
     * @return History The History instance.
     */
    public function history() : History {
        return new History($this);
    }

     /**
     * Get the Available Models Instance.
     *
     * @return Models The Models instance.
     */
    public function models() : Models {
        return new Models($this);
    }

    /**
     * Get the Available User Instance.
     *
     * @return User
     */
    public function user() {
        return new User($this);
    }
}
