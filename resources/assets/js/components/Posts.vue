<template>
    <div>
        <div class="well" dir="ltr">
            <p>Count: {{vuePost.length}}</p>
            <p>SQL: {{sql}}</p>
            Bindings: <code>
            <ol>
                <li v-for="reg in bindings" v-text="reg"></li>
            </ol>
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
            <a :href="post.path" v-for="post in vuePost" v-text="post.title" :key="post.id" class="list-group-item"></a>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'posts',
        props: ['posts'],
        data: function () {
            return {
                vuePost: this.posts,
                query: '',
                sql: '',
                bindings: '',
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
            suggest: function () {
                let vm = this;
                if (this.query.length > 3) {
                    this.fetchSuggestions();
                } else {
                    this.vuePost = this.posts;
                    vm.sql = '';
                    vm.bindings = '';
                }
            },
            fetchSuggestions: function () {
                let vm = this;
                axios.post('/posts/suggest', {q: this.query})
                    .then(function ({data}) {
                        console.log(data);
                        vm.vuePost = data.results;
                        vm.sql = data.sql;
                        vm.bindings = data.bindings;
                    });
            }
        }
    }
</script>
