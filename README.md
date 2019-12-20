# #API DE ESTUDOS DO SLIM FRAMEWORK

O sistema contém dois ambientes:

## **1. Back-end**

#### Itens intalados no composer.json

```bash
 "require": {
    "slim/slim": "^3.1",
    "illuminate/database": "v4.2.9",
    "vlucas/phpdotenv": "^2.5",
    "robmorgan/phinx": "0.5.*",
    "monolog/monolog": "^1.17",
    "firebase/php-jwt": "^5.0",
  }
```

#### **Libs Adicionais**

#### vlucas/phpdotenv -> [link](https://github.com/vlucas/phpdotenv);

#### robmorgan/phinx -> [link](https://github.com/cakephp/phinx);

#### monolog/monolog -> [link](https://github.com/Seldaek/monolog);

#### firebase/php-jwt -> [link](https://github.com/firebase/php-jwt)

#### **Para instalar**

```bash
$ composer install
```

#### **.env**

O arquivo .env-example é um template.
Como é um app de teste, todos os dados sensiveis estão nesse arquivo.
Mas para o projeto funcionar é obrigatório gerar o .env

Para gerar o .env:

```bash
$ cp .env-example .env
```

O arquivo .env deve ser preenchido com as informações do banco de dados.
Essas informações podem preenchidas da forma que o usuário quiser, mas se for de interesse seguir o
padrão do projeto. Preencha o mesmo da seguinte forma:

```bash
DB_CLIENT=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=bd-api-slim-framework
DB_USER=root
DB_PASSWORD=admin
```

#### **Migrations**

O banco da app, é gerado via migration (phinx)

```bash
$ php vendor/bin/phinx migrate
```

### **Startar a API**

```bash
$ composer start
```

## **2. Front-end**

Foi usado o [VueJs](https://vuejs.org/) para criar o frontend da aplicação

#### **Local do front**

```bash
cd frontend/
```

#### Itens intalados no package.json

```bash
"dependencies": {
    "axios": "^0.17.1",
    "bootstrap-vue": "^2.0.0-rc.11",
    "dotenv-webpack": "^1.5.7",
    "jsonwebtoken": "^8.3.0",
    "localStorage": "^1.0.3",
    "moment": "^2.22.2",
    "vue": "^2.5.2",
    "vue-facebook-signin-button": "^1.0.1",
    "vue-google-signin-button": "^1.0.2",
    "vue-router": "^3.0.1",
    "vue2-toast": "^1.3.2",
    "vuex": "^3.0.1"
  }
```

#### **Libs Adicionais**

##### axios -> [link](https://github.com/axios/axios);

##### bootstrap-vue-> [link](https://github.com/bootstrap-vue/bootstrap-vue);

##### dotenv-webpack-> [link](https://github.com/mrsteele/dotenv-webpack#readme);

##### jsonwebtoken-> [link](https://github.com/auth0/node-jsonwebtoken#readme);

##### localStorage -> [link](https://github.com/coolaj86/node-localStorage);

##### moment -> [link](https://github.com/moment/moment);

##### vue-facebook-signin-button -> [link](https://github.com/phanan/vue-facebook-signin-button);

##### vue-google-signin-button -> [link](https://github.com/phanan/vue-google-signin-button);

##### vue-router -> [link](https://router.vuejs.org/);

##### vue2-toast -> [link](https://github.com/lin-xin/vue-toast#readme);

##### vuex -> [link](https://github.com/vuejs/vuex);

#### Para instalar

```bash
$ npm i
```

### **.env**

O arquivo .env-example é um template. Como é uma app de teste, todos os dados sensiveis estão nesse arquivo.
O certo é ficar em um arquivo .env.\*
Sem ele (.env) o projeto não funcionará.

Para gerar o .env:

```bash
$ cp .env-example .env
```

#### Startar a site

```bash
$ npm start
```

### Dump do banco
Não há necessiade de rodar, mas se o usuário quiser, o arquivo está na pasta

```bash
 cd db_dump/
```
