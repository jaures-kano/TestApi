<?php

namespace App\Command;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

/**
 *
 */
class CreateUserCommand extends Command
{
    protected static $defaultName = 'app:create:user';
    protected static $defaultDescription = 'Add a short description for your command';

    private UserPasswordHasherInterface $hasher;

    private EntityManagerInterface $em;

    /**
     * CreateUserCommand constructor.
     */
    public function __construct(UserPasswordHasherInterface $hasher, EntityManagerInterface $em)
    {
        parent::__construct();
        $this->hasher = $hasher;
        $this->em = $em;
    }


    protected function configure(): void
    {
        $this
            ->addArgument('name', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $name = $input->getArgument('name');

        if ($name) {
            $user = new User();
            $user->setEmail('admin@admin.com');
            $user->setPassword($this->hasher->hashPassword($user, '0000'));
            $this->em->persist($user);
            $this->em->flush();
        }

        $io->success('user created.');

        return Command::SUCCESS;
    }
}
