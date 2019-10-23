<?php

namespace WeblaborMx\SparkManualBilling\Console\Installation;

use Illuminate\Filesystem\Filesystem;

class InstallResources
{
    protected $command;

    public function __construct($command)
    {
        $this->command = $command;

        $this->command->line('Installing Views: <info>✔</info>');
    }

    public function install()
    {
        (new Filesystem)->copyDirectory(
            SPARKMB_STUB_PATH.'/resources', resource_path('')
        );
    }
}
