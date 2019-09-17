<?php


namespace App\Command;


use App\Service\Project\ProjectManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ShowProjects extends Command
{
    private $gitlabManager;

    public function __construct(?string $name = null, ProjectManager $gitlab)
    {
        parent::__construct($name);

        $this->gitlabManager = $gitlab;
    }

    protected function configure()
    {
        $this
            ->setName('gitlab:show_repo')
            ->setDescription('Вывод project_id, web_url');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $rows = $this->gitlabManager->getReport();

        foreach ($rows as $row){
            echo $row['id'] . ',' . $row['web_url'] . PHP_EOL;
        }
    }
}