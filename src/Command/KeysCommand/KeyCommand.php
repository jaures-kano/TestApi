<?php

namespace App\Command\KeysCommand;

use App\Domain\AppKeysDomain\Entity\ApplicationKey;
use App\Infrastructures\Generator\TokenGenerator;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class KeyCommand extends Command
{
    protected static $defaultName = 'app:key';
    protected static $defaultDescription = 'Add a short description for your command';

    private TokenGenerator $generator;
    private EntityManagerInterface $entityManager;


    public function __construct(TokenGenerator         $generator,
                                EntityManagerInterface $entityManager)
    {
        parent::__construct();
        $this->generator = $generator;
        $this->entityManager = $entityManager;
    }


    protected function configure(): void
    {
        $this
            ->addArgument('designation', InputArgument::REQUIRED, 'Argument description');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $designation = $input->getArgument('designation');

        $key = $this->generator->getApiToken();
        if ($designation) {
            $appKey = new ApplicationKey();
            $appKey->setDesignation($designation);
            $appKey->setIsValid(true);
            $appKey->setKeyTokenAuthority(5);
            $appKey->setCreatedAt(new DateTime());
            $appKey->setKeyToken($key);

            $this->entityManager->persist($appKey);
            $this->entityManager->flush();
        }

        $io->success('app key created key: ' . $key);

        return Command::SUCCESS;
    }
}
