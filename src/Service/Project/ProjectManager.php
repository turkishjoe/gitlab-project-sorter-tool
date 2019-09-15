<?php


namespace App\Service\Project;


use App\Service\Gitlab\UserProjectProvider;

class ProjectManager
{
    private $project;

    public function __construct(UserProjectProvider $project)
    {
        $this->project = $project;
    }

    public function getReport(){
        $result = $this->project->getContributedProjects();

        return $result;
    }
}