<?php namespace Justinhilles\Admin\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Illuminate\Filesystem\Filesystem;
use Config;

class UserActivateCommand extends Command {

    const PACKAGE = 'justinhilles/admin';

    protected $name = 'user:activate';

    protected $description = 'Activate a User';

    public function __construct()
    {
        parent::__construct();
    }

    public function fire()
    {
        $user = \Sentry::getUserProvider()->findByLogin($this->argument('email'));

        $user->activated = !$this->option('deactivate') ? true : false ;
        $user->activated_at = new \DateTime;

        $user->save();
        
        $this->info('<info>User ' . $user['email'] . ' has been activated.</info>');    
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return array(
            array('email', InputArgument::REQUIRED, 'Login of User')
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
            array('deactivate', null, InputOption::VALUE_OPTIONAL, 'Whether to deactivate a user instead')
        );
    }
 
}