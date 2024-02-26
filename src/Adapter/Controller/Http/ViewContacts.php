<?php

namespace Adapter\Controller\Http;

use Adapter\Dto\ContactDto;
use Application\Controller\ViewController;
use Domain\Repository\ContactRepositoryInterface;
use Infrastructure\Http\View;

readonly class ViewContacts implements ViewController
{
    public function __construct(private ContactRepositoryInterface $repository)
    {
    }

    public function __invoke(array $vars): View
    {
        $result = $this->repository->fetchAll();

        return View::create('/template/account/index.php', [
            'contacts' => array_map(fn ($contact) => ContactDto::fromEntity($contact), $result),
        ]);
    }
}