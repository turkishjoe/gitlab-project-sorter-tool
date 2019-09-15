<?php


namespace App\Command;


use App\Service\Gitlab\UserProjectProvider;
use App\Service\Project\ProjectManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ShowGroups extends Command
{
    private $gitlabManager;

    public function __construct(?string $name = null, UserProjectProvider $gitlab)
    {
        parent::__construct($name);

        $this->gitlabManager = $gitlab;
    }

    protected function configure()
    {
        $this
            ->setName('gitlab:show_groups')
            ->setDescription('...');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $rows = $this->gitlabManager->getGroups();

        foreach ($rows as $row){
            echo $row['id'] . ',' . $row['web_url'] . PHP_EOL;
        }
    }
}