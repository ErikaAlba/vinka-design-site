<?php

namespace App\EntryPoint\Command\System;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateDataBaseCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('vd:database:create')
            ->setDescription('create database')
            ->setHelp('create database');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        dump('hola');

        return self::SUCCESS;
    }
}