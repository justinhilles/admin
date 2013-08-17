<?php namespace Justinhilles\Admin\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Illuminate\Filesystem\Filesystem;
use Config;

class UserChangePasswordCommand extends Command {

    const PACKAGE = 'justinhilles/admin';

    protected $name = 'user:password';

    protected $description = 'Change a User\'s Password';

    public function __construct()
    {
        parent::__construct();
    }

    public function fire()
    {
        $user = \Sentry::getUserProvider()->findByLogin($this->argument('email'));
        $user->password = $this->argument('password');

        $user->save();
        $this->info('<info>User ' . $user['email'] . ' password updated.</info>');    
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
 
}