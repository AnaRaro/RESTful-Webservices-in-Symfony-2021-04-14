<?php

declare(strict_types=1);

namespace App\Controller\Attendee;

use App\Entity\Attendee;
use App\Repository\AttendeeRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class ReadController
{
    private AttendeeRepository $attendeeRepository;

    public function __construct(AttendeeRepository $attendeeRepository)
    {
        $this->attendeeRepository = $attendeeRepository;
    }

    #[Route(path: '/attendees/{identifier}', name: 'read_attendee', methods: ['GET'])]
    public function read(Attendee $attendee): Response
    {
        $attendee = $this->attendeeRepository->findOneBy($attendee->toArray());

        return new Response(json_encode($attendee->toArray()), Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }
}