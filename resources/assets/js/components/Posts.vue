<template>
    <div class="list-group">
        <p><input class="form-control" type="text" v-model="query" @keyup="suggest" placeholder="فرز حسب الاسم.."></p>
        <a :href="post.path" v-for="post in vuePost" v-text="post.title" :key="post.id" class="list-group-item"></a>
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
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
            suggest: function () {
                if (this.query.length > 3) {
                    this.fetchSuggestions();
                }
            },
            fetchSuggestions: function () {
                axios.post('/search', {q: this.query})
                    .then(function ({data}) {
                        console.log(data);
                    });
            }
        }
    }
</script>
