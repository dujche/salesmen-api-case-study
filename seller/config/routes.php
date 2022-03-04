<?php

declare(strict_types=1);

use Mezzio\Application;
use Mezzio\MiddlewareFactory;
use Psr\Container\ContainerInterface;
use Seller\Handler\GetSellerHandler;
use Seller\Handler\PostSellerHandler;
use Seller\Middleware\CreateSellerPayloadValidationMiddleware;

/**
 * FastRoute route configuration
 *
 * @see https://github.com/nikic/FastRoute
 *
 * Setup routes with a single request method:
 *
 * $app->get('/', App\Handler\HomePageHandler::class, 'home');
 * $app->post('/album', App\Handler\AlbumCreateHandler::class, 'album.create');
 * $app->put('/album/{id:\d+}', App\Handler\AlbumUpdateHandler::class, 'album.put');
 * $app->patch('/album/{id:\d+}', App\Handler\AlbumUpdateHandler::class, 'album.patch');
 * $app->delete('/album/{id:\d+}', App\Handler\AlbumDeleteHandler::class, 'album.delete');
 *
 * Or with multiple request methods:
 *
 * $app->route('/contact', App\Handler\ContactHandler::class, ['GET', 'POST', ...], 'contact');
 */

return static function (Application $app, MiddlewareFactory $factory, ContainerInterface $container): void {
    $app->get(
        '/sellers',
        [
            GetSellerHandler::class
        ],
        'api.sellers.get'
    );

    $app->get(
        '/sellers/{id:\d+}',
        [
            GetSellerHandler::class
        ],
        'api.sellers.get.single'
    );

    $app->post(
        '/sellers',
        [
            CreateSellerPayloadValidationMiddleware::class,
            PostSellerHandler::class
        ],
        'api.order.post'
    );
};
