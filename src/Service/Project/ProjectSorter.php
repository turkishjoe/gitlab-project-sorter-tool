<?php


namespace App\Service\Project;


use App\Service\Csv\CsvFactory;
use App\Service\Gitlab\UserProjectProvider;
use Gitlab\Client;
use League\Csv\Reader;

class ProjectSorter
{
    /**
     * @var Client
     */
    private $gitlab;

    /**
     * @var Reader
     */
    private $csvFactory;

    public function __construct(Client $client, CsvFactory $csvFactory)
    {
        $this->gitlab = $client;
        $this->csvFactory = $csvFactory;
    }

    public function updateProject(string $sortFile){
        $projectsMapping = $this->readMapping($sortFile);

        foreach ($projectsMapping as $projectId=>$value){
            $this->gitlab->projects()->update($projectId, ['tag_list'=>$value['tags']]);
        }

    }

    /**
     * @param string $sortFile
     * @return array
     */
    public function readMapping(string $sortFile): array
    {
        $projectsMapping = [];
        $reader = $this->csvFactory->createReader($sortFile);

        foreach ($reader->getRecords() as $record) {
            $tags = $record[3] ?? '';

            $projectsMapping[$record[0]] = [
                'id' => $record[0],
                'star' => $record[2] ?? 0,
                'tags' => explode(',', $tags)
            ];
        }
        return $projectsMapping;
    }
}