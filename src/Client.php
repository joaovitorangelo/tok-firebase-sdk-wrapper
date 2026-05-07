<?php

namespace Tok\Firebase;

use Google\Auth\Credentials\ServiceAccountCredentials;
use Kreait\Firebase\Factory;

class Client
{
    private Factory $factory;

    public function __construct()
    {
        $this->factory = (new Factory)
            ->withServiceAccount(FIREBASE_CREDENTIALS);
    }

    public function factory(): Factory
    {
        return $this->factory;
    }

    public function project_id(): string
    {
        $json = json_decode(
            file_get_contents(FIREBASE_CREDENTIALS),
            true
        );

        return $json['project_id'];
    }

    public function access_token(): string
    {
        $credentials = new ServiceAccountCredentials(
            'https://www.googleapis.com/auth/datastore',
            FIREBASE_CREDENTIALS
        );

        $token = $credentials->fetchAuthToken();

        return $token['access_token'];
    }
}