export class Post {
    constructor(id, title, text) {
        this.path =  '/' + id;
        // console.log(window.location.protocol + '//' + window.location.hostname + '/' + id);
        this.id = id;
        this.title = title;
        this.text = text;
    }
}