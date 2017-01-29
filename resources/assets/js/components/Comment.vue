<template>
    <div class="box">
        <div v-show="loading"><h2 class="subtitle"><i class="fa fa-spinner fa-spin fa-lg fa-fw"></i> Loading</h2> <br></div>

        <article class="media" v-hide="loading" v-for="comment in comments">
        <figure class="media-left">
            <p class="image is-64x64">
            <img :src="comment.user.avatar">
            </p>
        </figure>
        <div class="media-content">
            <div class="content">
            <p>
                <strong>{{comment.user.first_name}} {{comment.user.last_name}}</strong> <small>@ {{comment.user.username}}</small> <small>{{dateFromNow(comment.created_at)}}</small>
                <br>
                {{comment.body}}
            </p>
            </div>
        </div>
        </article>



        <!-- Comment Form -->
        <br><br>
        <p class="control has-addons">
          <input type="text" name="body" id="body" class="input is-expanded" placeholder="Comment Here" v-model="body">
          <button class="button is-danger" @click="create_comment"><i class="fa fa-comment-o fa-lg"></i></button>
        </p>
        
    </div>
</template>textarea
<script>
    import moment from 'moment';
    export default{
        mounted() {
            this.getcomments()
        },

        props: ['id','uid'],

        data() {
            return {
                loading: true,
                comments: [],
                body: ''
            }
        },

        ready() {
            this.getcomments()
        },

        methods: {
            getcomments() {
                this.loading = true,
                this.$http.get('/post/'+this.id+'/comments')
                    .then((r)=>{
                        this.comments = r.body
                        this.loading = false
                    })
            },
            dateFromNow(e) {
                return moment(e).fromNow()
            },
            create_comment(e) {
                e.preventDefault()
                var formData = new FormData();
                formData.append('body', this.body)
                this.$http.post('/post/'+this.id+'/comment/'+this.uid,formData)
                    .then((r)=>{
                        this.body = ''
                        this.loading = false
                        this.getcomments()
                    })
            }
        }
    }
</script>