<?php

namespace Justinhilles\Admin\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Illuminate\Filesystem\Filesystem;
use Config;

class UserCreateCommand extends Command {

    const PACKAGE = 'justinhilles/admin';

    protected $name = 'user:create';

    protected $description = 'Add a User';

    public function __construct()
    {
        parent::__construct();
    }

    public function fire()
    {
        $user['email'] = $this->argument('email');
        $user['password'] = $this->argument('password');
        if($first_name = $this->option('first_name')) {
            $user['first_name'] = $first_name;
        }

        if($last_name = $this->option('last_name')) {
            $user['last_name'] = $last_name;
        }

        $user = \Sentry::register($user, true);
        
        $this->info('<info>User ' . $user['email'] . ' added.</info>');    
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return array(
            array('email', InputArgument::REQUIRED, 'Email of New User'),
            array('password', InputArgument::REQUIRED, 'Password of New User')
        );
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return array(
            array('first_name', null, InputOption::VALUE_REQUIRED, 'User First Name'),
            array('last_name', null, InputOption::VALUE_REQUIRED, 'User Last Name')
        );
    }
 
}