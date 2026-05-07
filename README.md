# 🔥 Tok Firebase SDK Wrapper

SDK Wrapper para integração do WordPress com o Firebase utilizando PHP moderno + PSR-4.
O objetivo do plugin é fornecer uma camada simples, modular e reutilizável para acessar:

- Firebase Authentication
- Firestore Database
- Firebase Storage

diretamente dentro de temas, plugins ou integrações customizadas no WordPress.

---

# 🚀 Recursos
- Integração com Firebase Admin SDK
- PSR-4 Autoload
- Estrutura modular
- Wrapper simplificado
- Integração com:
  - Firebase Users
  - Firestore
  - Firebase Storage
- Compatível com WordPress
- Compatível com Composer

---

# 📁 Estrutura

```bash
tok-firebase-sdk-wrapper/
├── composer.json
├── config/
│   └── app.php
├── src/
│   ├── Client.php
│   ├── Firestore.php
│   ├── Storage.php
│   └── Users.php
├── storage/
│   └── firebase/
│       └── firebase.json
└── tok-firebase-sdk-wrapper.php
```

---

# 🧱 Arquitetura

O plugin funciona como uma camada de abstração sobre o Firebase Admin SDK.

---

```txt
Client.php
```

Responsável por inicializar o Firebase SDK.

Centraliza:

- Factory
- credenciais
- conexão com Firebase

---

```txt
Users.php
```

Responsável por operações relacionadas aos usuários do Firebase Authentication.

Exemplos:

- listar usuários
- buscar usuários
- obter dados do Firebase Auth

---

```txt
Firestore.php
```

Responsável por operações no Firestore Database.

Exemplos:

- collections
- documentos
- inserts
- updates
- deletes

---

```txt
Storage.php
```

Responsável por integração com Firebase Storage.

Exemplos:

- upload de arquivos
- remoção
- URLs temporárias
- buckets

---

# ⚙️ Instalação

## 1. Instalar dependências

Na raiz do plugin:

```txt
composer install
```

## 2. Gerar autoload

```txt
composer dump-autoload
```

---

# 🔐 Configuração Firebase

Gerar credenciais

- Acesse o Firebase Console
- Vá em:
  - Configurações do projeto
  - Contas de serviço
- Clique:
  - "Gerar nova chave privada"

Salvar credenciais

Salve o arquivo JSON em:

```txt
storage/firebase/firebase.json
```

---

# ⚙️ Configuração

config/app.php

```PHP
<?php

defined('ABSPATH') || exit;

define(
    'FIREBASE_CREDENTIALS',
    dirname(__DIR__) . '/storage/firebase/firebase.json'
);
```

--- 

# 👤 Exemplo: Usuários Firebase

```PHP
<?php

use Tok\Firebase\Client;
use Tok\Firebase\Users;

$users = new Users(
    new Client()
);

$list = $users->list_users();

echo '<pre>';
print_r($list);
echo '</pre>';
```

---

# ☁️ Exemplo: Firestore

```PHP
<?php

use Tok\Firebase\Client;
use Tok\Firebase\Firestore;

$firestore = new Firestore(
    new Client()
);

$posts = $firestore->collection('posts');

print_r($posts);
```

---

# 🗂️ Exemplo: Firebase Storage

```PHP
<?php

use Tok\Firebase\Client;
use Tok\Firebase\Storage;

$storage = new Storage(
    new Client()
);

$storage->upload(
    'images/photo.jpg',
    '/tmp/photo.jpg'
);
```

---

# 💡 Objetivo

O objetivo do projeto é transformar o Firebase em uma camada reutilizável e simples de integrar dentro do ecossistema WordPress.