<?php

namespace App\Services\Elastic;

interface ElasticManager
{
    
    /**
     * The specific settings associated with the index
     *
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/indices-create-index.html#create-index-settings
     *
     * @return array
     */
    public function getIndexSettings(): array;
    
    /**
     * The types mapping of the index
     *
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/mapping.html
     *
     * @return array
     */
    public function getIndexMappings(): array;
}