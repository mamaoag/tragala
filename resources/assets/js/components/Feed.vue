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
            <img :src="post.user.avatar" alt="Image">
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
        <small>{{post.created_at}}</small>
        </div>
        <actions :id="post.id" :uid="post.user.id"></actions>
    </div>
    </div>
    </div>
    </div>
</template>

<script>
    export default{
        mounted() {
            this.feed()
        },
        data(){
            loading: true
        },        
        methods: {
            feed() {
                this.$http.get('/feed')
                    .then((posts)=>{
                        posts.body.forEach((post)=>{
                            this.$store.commit('add_post',post)
                        })
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