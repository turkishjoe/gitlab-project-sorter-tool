<?php


namespace App\Command;


use App\Service\GitlabManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ShowProjects extends Command
{
    private $gitlabManager;

    public function __construct(?string $name = null, GitlabManager $gitlab)
    {
        parent::__construct($name);

        $this->gitlabManager = $gitlab;
    }

    protected function configure()
    {
        $this
            ->setName('gitlab:show_repo')
            ->setDescription('...');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        //$this->gitlabManager->getProjects();
        var_dump($this->gitlabManager->getContributedProjects());
    }
}