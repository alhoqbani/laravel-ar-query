<?php

namespace App\Models;

use App\Services\Elastic\Analyzer;
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
        return [
            'number_of_shards'   => 1,
            'number_of_replicas' => 0,
            'mapper.dynamic'     => false, // Automatic mapping creation disabled per-index..
            "analysis"           => [
                "filter"    => Analyzer::getFilters(),
                "tokenizer" => Analyzer::getTokenizers(),
                "analyzer"  => Analyzer::getAnalyzers(),
            ],
        ];
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
        return [
            'post' => [
                '_source'    => [
                    'enabled' => true,
                ],
                'properties' => [
                    'title' => [
                        'type'   => 'text',
                        'fields' => [
                            'arabic_default'  => [
                                'type'     => 'text',
                                'analyzer' => 'default_arabic',
                            ],
                            'arabic'          => [
                                'type'     => 'text',
                                'analyzer' => 'arabic',
                            ],
                            'arabic_hunspell' => [
                                'type'     => 'text',
                                'analyzer' => 'arabic_hunspell',
                            ],
                            'autocomplete'    => [
                                'type'            => 'text',
                                'analyzer'        => 'autocomplete',
                                'search_analyzer' => 'autocomplete_search',
                            ],
                        ],
                    ],
                    'text'  => [
                        'type'   => 'text',
                        'fields' => [
                            'arabic_default'  => [
                                'type'     => 'text',
                                'analyzer' => 'default_arabic',
                            ],
                            'arabic'          => [
                                'type'     => 'text',
                                'analyzer' => 'arabic',
                            ],
                            'arabic_hunspell' => [
                                'type'     => 'text',
                                'analyzer' => 'arabic_hunspell',
                            ],
                            'autocomplete'    => [
                                'type'            => 'text',
                                'analyzer'        => 'autocomplete',
                                'search_analyzer' => 'autocomplete_search',
                            ],
                        ],
                    ],
                ],
            ],
        ];
    }
    
    
    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        return [
            'title' => $this->title,
            'text'  => $this->text,
        ];
    }
    
}
