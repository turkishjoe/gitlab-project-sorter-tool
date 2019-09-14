<?php


namespace App\Service;


use Gitlab\Client;

class GitlabManager
{
    /**
     * @var Client
     */
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getProjects(){
        $projects = $this->client->projects()->all();

        foreach ($projects as $project){
            var_dump($project);
        }

        return $projects;
    }
}