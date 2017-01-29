<template>
    <div>
        <nav class="level">
            <div class="level-left">
                <div class="level-item"><a v-show="action == 'none'" @click="like_status"><i class="fa fa-thumbs-o-up fa-lg"></i><span v-show="likes > 0">&nbsp;{{likes}}</span></a>
                    <a v-show="action == 'disliked'" @click="like_status"><i class="fa fa-thumbs-o-up fa-lg"></i><span v-show="likes > 0">&nbsp;{{likes}}</span></a>
                    <a v-show="action == 'liked'" @click="unlike_status"><i class="fa fa-thumbs-up fa-lg" style="color:#ff7473"></i><span v-show="likes > 0">&nbsp;{{likes}}</span></a></div>
                <div class="level-item"><a v-show="action == 'none'" @click="dislike_status"><i class="fa fa-thumbs-o-down fa-lg"></i><span v-show="dislikes > 0">&nbsp;{{dislikes}}</span></a>
                    <a v-show="action == 'liked'" @click="dislike_status"><i class="fa fa-thumbs-o-down fa-lg"></i><span v-show="dislikes > 0">&nbsp;{{dislikes}}</span></a>
                    <a v-show="action == 'disliked'" @click="undislike_status"><i class="fa fa-thumbs-down fa-lg" style="color:#ff7473"></i><span v-show="dislikes > 0">&nbsp;{{dislikes}}</span></a></div>
                <div class="level-item"><a :href="link"><i class="fa fa-comment-o fa-lg"></i><span v-show="comments > 0"> &nbsp; {{comments}}</span></a></div>
            </div>
            <div class="level-right">
                <report :postid="id" v-show="user != uid"></report>
                <div class="level-item"><i class="fa fa-life-ring fa-lg"></i></div>
            </div>
        </nav>
    </div>
</template>
<script>
    export default {
        mounted() {
            this.$http.get('/action/status/' + this.id)
                .then((r) => {
                    this.action = r.body.action
                    this.link = '/post/' + this.id
                    this.likes = r.body.likes
                    this.dislikes = r.body.dislikes
                    this.comments = r.body.comments
                })
        },
        props: ['id', 'uid','user'],

        data() {
            return {
                action: '',
                likes: '',
                dislikes: '',
                link: '',
                comments: ''
            }
        },

        methods: {
            like_status() {
                this.$http.get('/like/' + this.id + '/' + this.uid)
                    .then((r) => {
                        this.action = 'liked'
                        this.likes = this.likes + 1
                    })
            },
            unlike_status() {
                this.$http.get('/unlike/' + this.id + '/' + this.uid)
                    .then((r) => {
                        this.action = 'none'
                        this.likes = this.likes - 1
                    })
            },
            dislike_status() {
                this.$http.get('/dislike/' + this.id + '/' + this.uid)
                    .then((r) => {
                        this.action = 'disliked'
                        this.dislikes = this.dislikes + 1
                    })
            },
            undislike_status() {
                this.$http.get('/undislike/' + this.id + '/' + this.uid)
                    .then((r) => {
                        this.action = 'none'
                        this.dislikes = this.dislikes - 1
                    })
            }
        }
    }
</script>