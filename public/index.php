<?php

declare(strict_types=1);

use app\App;
use app\Config;
use app\controllers\LogoutController;
use app\controllers\SignupController;
use app\controllers\HomeController;
use app\controllers\LoginController;
use app\controllers\TransactionController;
use app\Router;
use App\SessionWrapper;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../app/loader.php';

session_start();

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

const VIEWS_PATH = __DIR__ . '/resources/views';

$router = new Router();
$router->get('/', [HomeController::class, 'index']);
$router->get('/register', [SignupController::class, 'register']);
$router->post('/register', [SignupController::class, 'storeRegister']);
$router->get('/login', [LoginController::class, 'login']);
$router->post('/login', [LoginController::class, 'storeLogin']);
$router->post('/logout', [LogoutController::class, 'logout']);
$router->get('/logout', [LogoutController::class, 'logout']);
$router->post('/delete/transaction', [TransactionController::class, 'deleteTransaction']);
$router->post('/create/transaction', [TransactionController::class, 'createTransaction']);

(new App(
    $router,
    ['uri' => $_SERVER['REQUEST_URI'], 'method' => $_SERVER['REQUEST_METHOD']],
    new Config($_ENV)
))->run();

SessionWrapper::unflash();
