<template>
    <div class="columns is-multiline is-mobile">
    <div class="column is-4"v-for="post in posts">
    <div class="card">
    <div class="card-image">
        <figure class="image is-4by3">
        <img :src="post.filename" alt="">
        </figure>
    </div>
    <div class="card-content">
        <div class="media">
        <div class="media-left">
            <figure class="image is-32x32">
            <img :src="post.user.avatar" alt="Image" style="border-radius: 50%">
            </figure>
        </div>
        <div class="media-content">
            <p class="title is-5">{{post.user.first_name}} {{post.user.last_name}}</p>
            <p class="subtitle is-6">@ {{post.user.username}}</p>
        </div>
        </div>

        <div class="content">
        {{post.description}}
        <br>
        <small>{{dateFromNow(post.created_at)}}  - <span> 
            <span v-if="post.category == 'Food'"><i class="fa fa-coffee fa-lg"> </i> Food</span>
            <span v-if="post.category == 'Travel'"><i class="fa fa-plane fa-lg"> </i> Travel</span>
            <span v-if="post.category == 'Experience'"><i class="fa fa-bed fa-lg"> </i> Experience</span>
            </span>
            </small>
        </div>
        <actions :id="post.id" :uid="post.user.id" :user="user_id"></actions>
    </div>
    </div>
    </div>
    </div>
</template>

<script>
    import moment from 'moment'
    export default{
        mounted() {
            this.feed()            
            this.userid()
        },
        data(){
            return {
                loading: true,
                user_id: 0
            }
        },   
        methods: {
            feed() {
                this.$http.get('/feed')
                    .then((posts)=>{
                        posts.body.forEach((post)=>{
                            this.$store.commit('add_post',post)
                        })
                    })
            },
            dateFromNow(e) {
                return  moment(e).fromNow()
            },
            userid(){
                this.$http.get('/usr/session').then(r =>{
                    console.log(r.body.id)
                    this.user_id = r.body.id
                })
            }
        },
        computed: {
            posts() {
                return this.$store.getters.all_posts
            }
        }
    }
</script>