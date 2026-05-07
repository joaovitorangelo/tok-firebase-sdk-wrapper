<?php

defined('ABSPATH') || exit;

use Tok\Firebase\Client;
use Tok\Firebase\Firestore;
use Tok\Firebase\Users;

// function ex_shortcode()
// {
//     try {

//         $firestore = new Firestore(new Client());

//         $result = $firestore->set('users', 'abc123', [
//             'nome' => 'João',
//             'idade' => 20,
//             'ativo' => true
//         ]);

//         return '<pre>' . print_r($result, true) . '</pre>';

//     } catch (\Throwable $e) {

//         return $e->getMessage();
//     }
// }

// add_shortcode('ex_shortcode', 'ex_shortcode');

// Cria um usuário
// function ex_shortcode()
// {
//     try {

//         $users = new Users(new Client());

//         $users->create_user([
//             'email'    => 'dsjadkjas@gmail.com',
//             'password' => '05628099023',
//             'name'     => 'dsjadkjas'
//         ]);

//         echo '<pre>';
//         print_r($users);
//         echo '</pre>'; 

//     } catch (\Throwable $e) {

//         return $e->getMessage();
//     }
// }

// add_shortcode('ex_shortcode', 'ex_shortcode');

// Atualiza um usuário
// function ex_shortcode()
// {
//     try {

//         $users = new Users(new Client());

//         $users->update_user('VwMTuZa5wTYGqEe6L0T8e81ySjo2', [
//             // 'name'     => 'atualizadodsjadkjas',
//             // 'email'    => 'atualizadodsjadkjas@gmail.com',
//             'password' => 'atualizado05628099023',
//         ]);

//         echo '<pre>';
//         print_r($users);
//         echo '</pre>'; 

//     } catch (\Throwable $e) {

//         return $e->getMessage();
//     }
// }
// add_shortcode('ex_shortcode', 'ex_shortcode');