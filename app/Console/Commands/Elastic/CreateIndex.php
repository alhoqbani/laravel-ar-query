<?php

namespace App\Console\Commands\Elastic;

use App\Services\Elastic\ElasticManager;
use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;
use Illuminate\Console\Command;

class CreateIndex extends Command
{
    
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'elastic:create-index
                            {model : The model which provides the index settings. }
                            {--name= : Index name. default: class basename. }';
    
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
     * @return void
     * @throws \ReflectionException
     */
    public function handle()
    {
        $client = ClientBuilder::create()->build();
        
        $class = $this->argument('model');
        
        $model = new $class;
        
        if ( ! $model instanceof ElasticManager) {
            $this->error("The model $class must implement: " . ElasticManager::class);
            
            return;
        }
        
        $indexName = $this->option('name') ?? mb_strtolower((new \ReflectionClass($class))->getShortName());
        
        $response = $client->indices()->create([
            'index' => $indexName,
            'body'  => [
                'settings' => empty($settings = $model->getIndexSettings()) ? new \stdClass() : $settings,
                'mappings' => empty($mappings = $model->getIndexMappings()) ? new \stdClass() : $mappings,
            ],
        ]);
        
        dump($response);
    }
}
