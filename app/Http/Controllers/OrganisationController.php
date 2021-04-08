<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Filters\OrganisationFilter;
use App\Http\Requests\CreateOrganisationRequest;
use App\Services\OrganisationService;
use Illuminate\Http\JsonResponse;

/**
 * Class OrganisationController
 *
 * @package App\Http\Controllers
 */
class OrganisationController extends ApiController
{
    /**
     * Create organisation
     *
     * @param CreateOrganisationRequest $request
     * @param OrganisationService $organisationService
     *
     * @return JsonResponse
     */
    public function store(CreateOrganisationRequest $request, OrganisationService $organisationService): JsonResponse
    {
        $organisation = $organisationService->createForOwner(
            $request->user(),
            $request->validated()
        );

        return $this->transformItem('organisation', $organisation, ['owner'])
            ->respond();
    }

    /**
     * Get all organisation
     *
     * @param OrganisationService $organisationService
     * @param OrganisationFilter $filter
     *
     * @return JsonResponse
     */
    public function index(OrganisationService $organisationService, OrganisationFilter $filter): JsonResponse
    {
        $organisations = $organisationService->all($filter);

        return $this->transformCollection('organisation', $organisations, ['owner'])
            ->respond();
    }
}
