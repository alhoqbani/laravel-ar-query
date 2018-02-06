<?php

namespace App\Console\Commands\Elastic;

use Elasticsearch\ClientBuilder;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;

class ImportCommand extends Command
{
    
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'elastic:import
                            {model : The model to import to elasticsearch. }
                            {--name= : Index name. default: class basename. }';
    
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import all records from given model to elasticsearch';
    
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
     * @throws \ReflectionException
     */
    public function handle()
    {
        $client = ClientBuilder::create()->build();
        
        $class = $this->argument('model');
        
        $indexName = $this->option('name') ?? mb_strtolower((new \ReflectionClass($class))->getShortName());
        
        /** @var \Illuminate\Database\Eloquent\Collection $models */
        /** @var Model $class */
        $models = $class::all();
        
        $models->each(function (Model $model) use ($client, $indexName) {
            $params = [
                'index' => $indexName,
                'type'  => $indexName,
                'id'    => $model->getKey(),
                'body'  => $model->toSearchableArray(),
            ];
            
            dump($client->index($params));
        });
        
    }
}
