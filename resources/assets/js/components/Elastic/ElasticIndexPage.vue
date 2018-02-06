<template>
    <h1 class="text-center">{{ title }}</h1>
</template>
<script>
    const elasticsearch = require('elasticsearch');
    const client = new elasticsearch.Client({
        host: 'localhost:9200',
        log: 'trace'
    });

    client.ping({
        requestTimeout: 30000,
    }, function (error) {
        if (error) {
            console.error('elasticsearch cluster is down!');
        } else {
            console.log('All is well');
        }
    });

    export default {
        name: 'elastic-index-page',
        props: [],
        data: function () {
            return {
                title: 'Elastic Index Page'
            }
        }
    }
</script>