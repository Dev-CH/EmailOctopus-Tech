<?php

namespace Adapter\Controller\Http;

use Adapter\Dto\ContactDto;
use Application\Controller\ApiController;
use Domain\Entity\Contact;
use Domain\Repository\ContactRepositoryInterface;
use Infrastructure\Http\Response;

readonly class DeleteContact implements ApiController
{
    public function __construct(private ContactRepositoryInterface $repository)
    {
    }

    public function __invoke(array $vars): Response
    {
        $this->repository->delete(intval($vars['id']));

        return Response::create([]);
    }
}