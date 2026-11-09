# Baskito

## v2.0.0 — Laravel 11+

Baskito stands for Backend Starter Kit Task Force that [Timedoor Backend Developer](https://github.com/backend-timedoor) built to improve development time for the admin page with a standardized tech stack and components.

- [Laravel 11](https://laravel.com/docs/11.x)
- [Vue 3](https://vuejs.org/guide/introduction.html)
- [Inertia](https://inertiajs.com)
- [Bootstrap 4](https://getbootstrap.com/docs/4.6/getting-started/introduction)
- [Stisla](https://github.com/stisla/stisla)

### Prerequisites

Before starting a Baskito v2.0.0 project, install these tools:

- `php : ^8.1` [docs](https://www.php.net)
- `composer : ^2.0.0` [docs](https://getcomposer.org/doc)
- `nodejs : ^22.0.0` [docs](https://nodejs.org)

Node packages may report outdated on Node 22 and newer. This is expected; the project remains runnable.

### Dependencies

#### PHP

- `diglactic/laravel-breadcrumbs : ^10.1` [docs](https://github.com/diglactic/laravel-breadcrumbs)
- `guzzlehttp/guzzle : ^7.2` [docs](https://docs.guzzlephp.org)
- `inertiajs/inertia-laravel : ^1.0` [docs](https://inertiajs.com)
- `jeremykenedy/laravel-roles : ^13.0` [docs](https://github.com/jeremykenedy/laravel-roles)
- `laravel/framework : ^11.0` [docs](https://laravel.com/docs/11.x)
- `laravel/sanctum : ^4.0` [docs](https://laravel.com/docs/11.x/sanctum)
- `laravel/tinker : ^2.7` [docs](https://laravel.com/docs/11.x/artisan)
- `laravel/ui : ^4.1` [docs](https://github.com/laravel/ui)
- `swayok/alternative-laravel-cache : ^6.1` [docs](https://github.com/swayok/alternative-laravel-cache)
- `swayok/cache-filesystem-adapter : ^1.3` [docs](https://github.com/swayok/cache-filesystem-adapter)
- `tightenco/ziggy : ^2.0` [docs](https://github.com/tighten/ziggy)

#### JavaScript

- `@inertiajs/vue3 : ^1.0.12` [docs](https://inertiajs.com)
- `@timedoor/baskito-ui : ^0.3.1`
- `@types/bootstrap : ^5.2.8` [docs](https://github.com/DefinitelyTyped/DefinitelyTyped)
- `@types/jquery : ^3.5.24` [docs](https://github.com/DefinitelyTyped/DefinitelyTyped)
- `@types/jquery.nicescroll : ^3.7.4` [docs](https://github.com/DefinitelyTyped/DefinitelyTyped)
- `@types/select2 : ^4.0.60` [docs](https://github.com/DefinitelyTyped/DefinitelyTyped)
- `@typescript-eslint/eslint-plugin : ^6.8.0` [docs](https://typescript-eslint.io)
- `@typescript-eslint/parser : ^6.8.0` [docs](https://typescript-eslint.io)
- `@vitejs/plugin-vue : ^4.4.0` [docs](https://github.com/vitejs/vite-plugin-vue)
- `@vue/compiler-sfc : ^3.3.6` [docs](https://github.com/vuejs/core)
- `axios : ^1.7.4` [docs](https://axios-http.com)
- `eslint : ^8.52.0` [docs](https://eslint.org)
- `eslint-config-prettier : ^9.0.0` [docs](https://github.com/prettier/eslint-config-prettier)
- `eslint-plugin-vue : ^9.17.0` [docs](https://eslint.vuejs.org)
- `laravel-vite-plugin : ^1.0.0` [docs](https://laravel.com/docs/11.x/vite)
- `prettier : ^3.0.3` [docs](https://prettier.io)
- `sass : ^1.69.4` [docs](https://sass-lang.com)
- `sweetalert : ^2.1.2` [docs](https://sweetalert.js.org)
- `typescript : 5.2.2` [docs](https://www.typescriptlang.org)
- `vite : ^5.4.0` [docs](https://vitejs.dev)
- `vite-tsconfig-paths : ^6.1.1`
- `vue : ^3.3.6` [docs](https://vuejs.org/guide/introduction.html)
- `vue-eslint-parser : ^9.3.2` [docs](https://github.com/vuejs/vue-eslint-parser)
- `vue-tsc : ^2.0.29` [docs](https://github.com/vuejs/language-tools)
- `ziggy-js : ^1.8.1` [docs](https://github.com/tighten/ziggy)

### Installation

Install PHP dependencies:

```bash
composer install
```

Copy `.env.example` to `.env`, then generate `APP_KEY`:

```bash
cp .env.example .env
php artisan key:generate
```

Configure the database in `.env`, then run migrations and seeders:

```bash
php artisan migrate --seed
```

Install JavaScript dependencies:

```bash
npm install
```

Run Vite for development:

```bash
npm run dev
```

Build Vite:

```bash
npm run build
```

### Settings

#### Vite

Set `DEV_SERVER_URL` in `.env` to match the local project URL and add a port for Vite:

```dotenv
DEV_SERVER_URL=http://baskito.test:4000
```

#### Vite SSL

```dotenv
DEV_SERVER_KEY="D:\\laragon\\etc\\ssl\\laragon.key"
DEV_SERVER_CERT="D:\\laragon\\etc\\ssl\\laragon.crt"
```

---

## v1.x — Laravel 9 & 10(legacy)

Versions below 2.0.0 use the Laravel 9 stack. Use the matching `v1.x` tag when working on an existing v1 project.

- Laravel 9
- PHP `^8.0.2`
- Composer `^2.0.0`
- Node.js `^16.0.0`
- Inertia Laravel `^0.6.4`
- `innocenzi/laravel-vite : 0.2.*`
- `laravel/ui : ^4.1`
- `tightenco/ziggy : ^1.5`
- Vite `^3.2.5`
- Vue `^3.2.36`

For the complete v1.x dependency list and setup instructions, use the README from the corresponding v1.x tag.
