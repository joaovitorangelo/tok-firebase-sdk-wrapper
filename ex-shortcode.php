<?php

defined('ABSPATH') || exit;

use Tok\Firebase\Client;
use Tok\Firebase\Firestore;

function ex_shortcode()
{
    try {

        $firestore = new Firestore(new Client());

        $result = $firestore->set('users', 'abc123', [
            'nome' => 'João',
            'idade' => 20,
            'ativo' => true
        ]);

        return '<pre>' . print_r($result, true) . '</pre>';

    } catch (\Throwable $e) {

        return $e->getMessage();
    }
}

add_shortcode('ex_shortcode', 'ex_shortcode');