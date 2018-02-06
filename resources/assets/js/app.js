import "./bootstrap";

import posts from './components/Posts.vue';
import ElasticIndexPage from './components/Elastic/ElasticIndexPage'

const app = new Vue({
    el: '#app',
    components: {
        posts,
        ElasticIndexPage,
    },
});
