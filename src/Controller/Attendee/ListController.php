<?php

declare(strict_types=1);

namespace App\Controller\Attendee;

use App\Entity\Attendee;
use App\Repository\AttendeeRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class ListController
{
    private AttendeeRepository $attendeeRepository;

    public function __construct(AttendeeRepository $attendeeRepository)
    {
        $this->attendeeRepository = $attendeeRepository;
    }

    #[Route(path: '/attendees', name: 'list_all_attendees', methods: ['GET'])]
    public function list(): Response
    {
        $allAteendees = $this->attendeeRepository->findAll();

        $allAteendeesAsArray = array_map(
            static fn (Attendee $attendee) => $attendee->toArray(),
            $allAteendees
        );

        return new Response(json_encode($allAteendeesAsArray), Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }
}