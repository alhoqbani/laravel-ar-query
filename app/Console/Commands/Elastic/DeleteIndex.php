<?php

namespace App\Console\Commands\Elastic;

use Elasticsearch\ClientBuilder;
use Illuminate\Console\Command;

class DeleteIndex extends Command
{
    
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'elastic:delete-index
                            {name : The index name to delete}';
    
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete the given Elasticsearch index';
    
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
        $client = ClientBuilder::create()->build();
        
        $params = ['index' => $index = $this->argument('name')];
        
        if ( ! $client->indices()->exists($params)) {
            $this->warn("Index: $index does not exist !!");
            
            return;
        }
        
        $response = $client->indices()->delete($params);
        
        dump($response);
    }
}
