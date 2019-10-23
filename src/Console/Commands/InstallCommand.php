<?php

namespace WeblaborMx\SparkManualBilling\Console\Commands;

use Illuminate\Console\Command;
use WeblaborMx\SparkManualBilling\Console\Installation;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'spark:manual-billing';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the Spark Manual Billing scaffolding into the application';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if (! defined('SPARKMB_STUB_PATH')) {
            define('SPARKMB_STUB_PATH', SPARKMB_PATH.'/install-stubs');
        }

        $installers = collect([
            Installation\InstallResources::class,
        ]);

        $installers->each(function ($installer) { (new $installer($this))->install(); });

        $this->comment('Laravel Spark Manual Billing extension installed.');
    }
}
