<?php

namespace App\Console\Commands\Elastic;

use Illuminate\Console\Command;

class CreateIndex extends Command
{
    
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'elastic:create-index {model : The model which provides the index settings. }';
    
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create an ElasticSearch index for the given model.';
    
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $class = $this->argument('model');
    
        $model = new $class;
        
        
    }
}
