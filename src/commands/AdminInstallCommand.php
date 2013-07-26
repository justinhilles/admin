<?php

namespace Justinhilles\Admin\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Illuminate\Filesystem\Filesystem;
use Config;

class AdminInstallCommand extends Command {

    const PACKAGE = 'justinhilles/admin';

    protected $name = 'admin:install';

    protected $description = 'Install Admin';

    public function __construct()
    {
        parent::__construct();
    }

    public function fire()
    {
        $this->call('asset:publish', array('package' => self::PACKAGE));
        $this->call('migrate', array('--package' => self::PACKAGE)); 
        $this->call('migrate', array('--package' => 'cartalyst/sentry'));       
    }
}