<?php


namespace App\Command;


use App\Service\Gitlab\UserProjectProvider;
use App\Service\Project\ProjectManager;
use App\Service\Project\ProjectSorter;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ProjectSortCommand extends Command
{
    private $sorter;

    public function __construct(?string $name = null, ProjectSorter $sorter)
    {
        parent::__construct($name);

        $this->sorter = $sorter;
    }

    protected function configure()
    {
        $this
            ->setName('gitlab:sort')
            ->setDescription('...');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        var_dump($this->sorter->updateProject('var/projects_input.csv'));
    }
}