<?php


namespace App\Service\Gitlab;


use App\Model\ProjectsResult;
use Gitlab\Client;

class UserProjectProvider
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
        $rows = array_merge(
            $this->getOwnedProjects(),
            $this->getGroupedProjects()
        );

        return $rows;
    }

    public function getOwnedProjects(){
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

    public function getGroupedProjects(){
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
                        $result[] = $project;
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

    public function getGroups(){
        $groupResult = [];

        $groupParams = [
            'per_page'=>15,
        ];

        for ($groupPage = 1 ;; $groupPage++) {
            $groupParams['page'] = $groupPage;
            $groups = $this->client
                ->groups()
                ->all($groupParams);

            if(empty($groups)){
                break;
            }

            $groupResult = array_merge($groupResult, $groups);
        }

        return $groupResult;
    }

}