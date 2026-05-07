<?php

namespace Tok\Firebase;

use Kreait\Firebase\Auth;

class Users
{
    private Auth $auth;

    public function __construct(Client $client)
    {
        $this->auth = $client->factory()->createAuth();
    }

    public function list_users(): array
    {
        return iterator_to_array($this->auth->listUsers());
    }
}