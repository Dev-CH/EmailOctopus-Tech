<?php

use Adapter\Controller\Http\AddContact;
use Adapter\Controller\Http\DeleteContact;
use Adapter\Controller\Http\ViewContacts;
use Application\Connection\ConnectionProviderInterface;
use Application\Http\Route;
use DI\ContainerBuilder;
use Domain\Repository\ContactRepositoryInterface;
use Infrastructure\Http\Response;
use Infrastructure\Repository\ContactRepository;
use Infrastructure\Connection\ConnectionProvider;
use Infrastructure\Http\Router;
use function DI\get;

require_once dirname(__DIR__).'/vendor/autoload.php';

define('APP_PATH', dirname(__DIR__));

function templatePart($name):void
{
    include_once(APP_PATH.DIRECTORY_SEPARATOR.sprintf('template/parts/%s.php', $name));
}

class Application
{
    public function __invoke(): void
    {
        $builder = new ContainerBuilder();
        $builder->addDefinitions([
            ConnectionProviderInterface::class => get(ConnectionProvider::class),
            ContactRepositoryInterface::class => get(ContactRepository::class),
        ]);

        $container = $builder->build();

        $router = new Router($container, [
            Route::get('/', ViewContacts::class),
            Route::post('/api/contact', AddContact::class),
            Route::delete('/api/contact/{id:\d+}', DeleteContact::class),
        ]);

        try {
            $router->dispatch();
        } catch (Throwable) {
            $response = Response::create('Unhandled Exception.', 500);
            $response->send();
        }
    }
}

(new Application())();
exit();


