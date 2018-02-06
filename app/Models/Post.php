<?php

namespace App\Models;

use App\Services\Elastic\ElasticManager;
use Illuminate\Database\Eloquent\Model;

class Post extends Model implements ElasticManager
{
    
    public function author()
    {
        return $this->belongsTo(Author::class);
    }
    
    public function city()
    {
        return $this->author->city();
    }
    
    public function path()
    {
        return route('posts.show', $this);
    }
    
    public function toArray()
    {
        return array_merge(
            parent::toArray(),
            ['path' => $this->path()]
        );
    }
    
    /**
     * The specific settings associated with the index
     *
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/indices-create-index.html#create-index-settings
     *
     * @return array
     */
    public function getIndexSettings(): array
    {
        return [];
    }
    
    /**
     * The types mapping of the index
     *
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/mapping.html
     *
     * @return array
     */
    public function getIndexMappings(): array
    {
        return [];
    }
}
