import "./bootstrap";

Vue.component('example', require('./components/Example.vue'));

const app = new Vue({
    el: '#app',
    data: {
        query: '',
    },
    methods: {
        suggest: function ($e) {
            if (this.query.length > 3) {
                this.fetchSuggestions();
            }
        },
        fetchSuggestions: function () {
            axios.post('/search').then(data => console.log(data));
        }
    }
});
