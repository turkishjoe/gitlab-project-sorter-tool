<?php


namespace App\Command;


use App\Service\Gitlab\UserProjectProvider;
use App\Service\Project\ProjectManager;
use App\Service\Project\ProjectSorter;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
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
            ->addArgument('filename', InputArgument::REQUIRED)
            ->setName('gitlab:sort')
            ->setDescription('На основе csv файла, в котором поля project_id, пусто, is_start, tags 
                                проставляет теги для проектов');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->sorter->updateProject($input->getArgument('filename'));
    }
}