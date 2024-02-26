<?php

namespace Infrastructure\Http;

use Application\Controller\ApiController;
use Application\Controller\ViewController;
use Application\Http\Route;
use Application\Http\RouterInterface;
use DI\Container;
use FastRoute\Dispatcher;
use FastRoute\RouteCollector;
use function FastRoute\simpleDispatcher;

readonly class Router implements RouterInterface
{
    private Dispatcher $dispatcher;

    /**
     * @param Container $container
     * @param Route[] $routes
     */
    public function __construct(private Container $container, array $routes)
    {
        $this->dispatcher = simpleDispatcher(function(RouteCollector $router) use ($routes) {
            foreach ($routes as $route) {
                $router->addRoute(
                    $route->method,
                    $route->uri,
                    $route->handler,
                );
            }
        });
    }

    public function dispatch(): void
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = $_SERVER['REQUEST_URI'];

        if (false !== $pos = strpos($uri, '?')) {
            $uri = substr($uri, 0, $pos);
        }

        $uri = rawurldecode($uri);

        $route = $this->dispatcher->dispatch($method, $uri);

        switch ($route[0]) {
            case Dispatcher::NOT_FOUND:
                echo '404 Not Found';
                break;
            case Dispatcher::METHOD_NOT_ALLOWED:
                echo '405 Method Not Allowed';
                break;
            case Dispatcher::FOUND:
                $controller = $this->container->get($route[1]);

                $this->handle($controller, $route[2] ?? []);
                break;
        }
    }

    private function handle($controller, $vars = []): void
    {
        if ($controller instanceof ViewController) {
            $view = $controller($vars);
            $view->render();

            return;
        }

        if ($controller instanceof ApiController) {
            $response = $controller($vars);
            $response->send();

            return;
        }

        throw new \Exception('Unsupported handler.');
    }
}