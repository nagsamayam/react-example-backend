<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Deploy extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blog:deploy';

    protected $description = 'Interactive application deploy helper';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $inputBranch = $this->ask('Specify Git branch to deploy');
        $productionBranch = 'main';
        if (is_production() && $inputBranch !== 'main') {
            $this->line('Production should always be associted with ' . $productionBranch . ' branch.');
            $this->line('Exiting...');
            exit;
        }
        $this->comment("Start processing the deployement...");

        $this->execGitCommands(['branch' => $inputBranch]);

        $this->comment('Application successfully deployed');
    }

    /**
     * Execute the commands to deploy code
     *
     * @param array $options
     */
    public function execGitCommands(array $options = [])
    {
        $commands = $this->commands($options);
        foreach ($commands as $command) {
            $this->execShellWithPrettyPrint($command);
        }
    }

    public function commands(array $options = [])
    {
        return [
            'down' => 'php artisan down',
            'checkout' => 'git checkout -f ' . $options['branch'],
            'pull' => 'git fetch && git pull -f origin ' . $options['branch'],
            'composer' => $this->composerCmd(),
            'migrate' => $this->migrateCmd(),
            'cache_routes' => 'php artisan route:cache',
            'cache_config' => 'php artisan config:cache',
            'up' => 'php artisan up'
        ];
    }

    private function composerCmd()
    {
        $cmd = 'composer install --no-interaction --prefer-dist --optimize-autoloader --ignore-platform-reqs';
        if (is_production()) {
            $cmd .= ' --no-dev';
        }
        return $cmd;
    }

    private function migrateCmd()
    {
        $cmd = 'php artisan migrate';
        if (is_production()) {
            $cmd .= ' --force';
        }
        return $cmd;
    }

    /**
     * Exec sheel with pretty print.
     *
     * @param string $command
     * 
     */
    public function execShellWithPrettyPrint(string $command)
    {
        $this->info('---');
        $this->info('Running command: ' . $command);
        $output = shell_exec($command);
        $this->info($output);
        $this->info('---');
    }
}
