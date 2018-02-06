<template>
    <div>
        <div class="well" dir="ltr">
            <p>Count: {{posts.length}}</p>
            <p>SQL: {{ 'sql' }}</p>
            Bindings: <code>
        </code>

        </div>
        <div class="list-group">
            <div class="form-group">
                <p class="help-block"> ابحث بكلمات مفتاحية لفزر النتائج.
                    <small>مثال: الالكتروني، التقنية</small>
                </p>
                <p><input class="form-control" type="text" v-model="query" @keyup="suggest"
                          placeholder="فرز حسب الاسم..">
                </p>
            </div>
            <a :href="post.path" v-for="post in posts" :key="post.id" class="list-group-item">
                <span class="badge" v-text="post.id"></span>{{post.title }}</a>
        </div>
    </div>
</template>
<script>
    import {Post} from "../../models/Post";

    const elasticsearch = require('elasticsearch');
    const client = new elasticsearch.Client({
        host: 'localhost:9200',
        log: 'debug'
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
                query: '',
                posts: [],
                title: 'Elastic Index Page',
                err: '',
            }
        },
        mounted() {

            const vm = this;

            client.search({
                index: 'post',
                type: 'post',
                size: 1000,
                body: {
                    "query": {
                        "match_all": {}
                    }
                }
            }).then(res => {
                res.hits.hits.forEach(function (hit) {
                    vm.posts.push(new Post(hit._id, hit._source.title, hit._source.text));
                });
            }).catch(err => {
                vm.err = err;
            });
        },
        methods: {

            suggest: function () {
                let vm = this;
                if (this.query.length > 3) {
                    this.fetchSuggestions();
                } else {
                    // this.posts = this.posts;
                    // vm.sql = '';
                    // vm.bindings = '';
                }
            },
            fetchSuggestions: function () {
                let vm = this;
                client.search({
                    index: 'post',
                    type: 'post',
                    size: 1000,
                    body: {
                        "query": {
                            "match": {
                                "title.arabic_hunspell": this.query
                            }
                        }
                    }
                }).then(res => {
                    const posts = [];
                    console.log(res.hits.total);
                    res.hits.hits.forEach(function (hit) {
                        posts.push(new Post(hit._id, hit._source.title, hit._source.text));
                    });
                    vm.posts = posts;
                    console.log(posts);
                }).catch(err => {
                    vm.err = err;
                });

            }
        }
    }
</script>