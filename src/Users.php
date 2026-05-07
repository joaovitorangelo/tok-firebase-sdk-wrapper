<?php

namespace Tok\Firebase;

use Kreait\Firebase\Auth;
use Kreait\Firebase\Exception\AuthException;

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

    /**
     * Criar usuário no Firebase
     */
    public function create_user(array $data)
    {
        return $this->auth->createUser([
            'email'       => $data['email'],
            'password'    => $data['password'] ?? null,
            'displayName' => $data['name'] ?? null,
            'phoneNumber' => $data['phone'] ?? null,
            'disabled'    => $data['disabled'] ?? false,
        ]);
    }

    /**
     * Atualizar usuário no Firebase
     */
    public function update_user(string $uid, array $data)
    {
        $payload = [];

        if (!empty($data['email'])) {
            $payload['email'] = $data['email'];
        }

        if (!empty($data['name'])) {
            $payload['displayName'] = $data['name'];
        }

        if (!empty($data['password'])) {
            $payload['password'] = $data['password'];
        }

        return $this->auth->updateUser($uid, $payload);
    }
}