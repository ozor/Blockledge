<?php

namespace BlockLedge\App\UI\Http\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

final class HealthController
{
    /**
     * Health check endpoint.
     *
     * Used by infrastructure (Docker, load balancers, monitoring)
     * to verify that the HTTP layer and PHP process are alive.
     *
     * Does not perform any business logic or external dependency checks.
     */
    #[Route('/health', name: 'health', methods: ['GET'])]
    public function __invoke(): JsonResponse
    {
        return new JsonResponse([
            'status' => 'ok',
            'service' => 'blockledge',
        ]);
    }
}
