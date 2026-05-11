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

    public function get_uid_by_email(string $email): string
    {
        return $this->auth->getUserByEmail($email)->uid;
    }

    /**
     * Criar usuário no Firebase
     */
    public function create_user(array $data)
    {
        return $this->auth->createUser(
            array_filter([
                'email'       => $data['email'] ?? null,
                'password'    => $data['password'] ?? null,
                'displayName' => $data['displayName'] ?? null,
                // 'phoneNumber' => $data['phoneNumber'] ?? null,
                'disabled'    => $data['disabled'] ?? null,
            ], fn($value) => $value !== null)
        );
    }

    /**
     * Atualizar usuário no Firebase
     */
    public function update_user(string $uid, array $data)
    {
        return $this->auth->updateUser( 
            $uid,
            array_filter([
                'email'       => $data['email'] ?? null,
                'displayName' => $data['displayName'] ?? null,
                'password'    => $data['password'] ?? null,
            ], fn($value) => $value !== null)
        );
    }
}