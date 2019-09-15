<?php


namespace App\Service;


use App\Model\ProjectsResult;
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

    /**
     * @return array
     */
    public function getContributedProjects(){
        $projectsResult = new ProjectsResult;
        $projectsResult->setGrouped($this->getGroupedProjects())
                       ->setOwned($this->getOwnedProjects());

        return $projectsResult;
    }

    protected function getOwnedProjects(){
        $params = [
            'per_page'=>15,
        ];

        $result = [];

        for($page = 1; ; $page++) {
            $params['page'] = $page;
            $projects = $this->client
                ->users()
                ->usersProjects($this->getCurrentUser()['id'], $params);
            foreach ($projects as $project){
                $result[] = $project;
            }
            if(empty($projects)){
                break;
            }
        }

        return $result;
    }

    protected function getGroupedProjects(){
        $groupParams = [
            'per_page'=>15,
        ];

        $result = [];

        for ($groupPage = 1 ;; $groupPage++) {
            $groupParams['page'] = $groupPage;

            $groups = $this->client
                ->groups()
                ->all($groupParams);

            if(empty($groups)){
                break;
            }

            for($page = 1; ; $page++) {
                foreach ($groups as $group) {
                    $params['page'] = $page;
                    $projects = $this->client->groups()
                        ->projects($group['id'], ['page'=>$page]);

                    foreach ($projects as $project) {
                        $result[] = $project['web_url'];
                    }
                }

                if(empty($projects)){
                    break;
                }
            }
        }

        return $result;
    }

    /**
     * @return mixed
     */
    public function getCurrentUser(){
        return $this->client->users()->user();
    }

}