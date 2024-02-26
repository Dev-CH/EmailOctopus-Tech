<?php

namespace Adapter\Controller\Http;

use Adapter\Dto\ContactDto;
use Application\Controller\ApiController;
use Domain\Entity\Contact;
use Domain\Repository\ContactRepositoryInterface;
use Infrastructure\Http\Response;

readonly class AddContact implements ApiController
{
    public function __construct(private ContactRepositoryInterface $repository)
    {
    }

    public function __invoke(array $vars): Response
    {
        $requestData = json_decode(file_get_contents('php://input'), true);

        $contact = $this->repository->add(Contact::new(
            $requestData['email'],
            $requestData['name'],
        ));

        return Response::create(ContactDto::fromEntity($contact), 201);
    }
}