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

        for($page = 1; ; $page++) {
            $projects = $this->client
                ->users()
                ->usersProjects($this->getCurrentUser()['id'], ['per_page' => 15, 'page' => $page]);
            foreach ($projects as $project){
                echo $project['web_url'] . PHP_EOL;
            }
            if(empty($projects)){
                break;
            }
        }


        return $projects;
    }

    /**
     * @return mixed
     */
    public function getCurrentUser(){
        return $this->client->users()->user();
    }
}