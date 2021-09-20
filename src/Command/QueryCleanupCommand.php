<?php

namespace App\Command;

use App\Repository\QueryRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class QueryCleanupCommand extends Command
{
    private $queryRepository;

    protected static $defaultName = 'app:closedquery:cleanup';

    public function __construct(QueryRepository $queryRepository)
    {
        $this->queryRepository = $queryRepository;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Удаление закрытых заявок из базы данных')
            ->addOption('dry-run', null, InputOption::VALUE_NONE, 'Холостой прогон (без удаления)')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        if ($input->getOption('dry-run')) {
            $io->note('Активирован холостой прогон (без удаления');
            $count = $this->queryRepository->countOldClosed();
        } else {
            $count = $this->queryRepository->deleteOldClosed();
        }

        $io->success(sprintf('Удалено "%d" закрытых заявок', $count));

        return 0;
    }
}