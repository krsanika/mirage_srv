<?php

/**
 * Created by PhpStorm.
 * User: krsanika
 * Date: 2016-11-15
 * Time: 오후 11:35
 */
namespace Mirage\UserBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class SocketCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('socket:start')
            ->setDescription('Start a Socket')
//            ->addArgument('name', InputArgument::OPTIONAL, 'Who do you want to greet?')
//            ->addOption('yell', null, InputOption::VALUE_NONE, 'If set, the task will yell in uppercase letters')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {


//        $output->writeln($text);
    }

}