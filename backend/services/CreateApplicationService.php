<?php

include_once __DIR__ . "/../abstraction/IRepository.php";
include_once __DIR__ . "/../models/Application.php";


class CreateApplicationService
{
    private $applicationRepository;

    public function __construct(IRepository $applicationRepository)
    {
        $this->applicationRepository = $applicationRepository;
    }

    public function createApplication(Application $application): bool
    {
        // Save application to db
        $is_success = $this->applicationRepository->save($application);

        return $is_success;
    }
}