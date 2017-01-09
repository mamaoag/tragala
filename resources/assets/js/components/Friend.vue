<template>
    <div class="container">
        <div v-if="loading">
            <h2 class="menu-label has-text-centered"><i class="fa fa-spinner fa-spin fa-lg fa-fw"></i>Information Loading</h2>
        </div>

        
        <button href="" class="button is-danger" style="margin-left:20%" v-if="status == 'none'" @click="add">Follow User</button>
        <h2 class="menu-label has-text-centered is-danger" v-if="status == 'follower'">Follows You</h2>
        <button href="" class="button is-danger" style="margin-left:20%" v-if="status == 'following'" @click="unfollow">Following</button>
        <button href="" class="button is-danger" style="margin-left:20%" v-if="status == 'follower'" @click="followback">Follow User</button>
        
        <nav class="level">
            <div class="level-item"><br>
                 <p class="heading has-text-centered">Followers</p>
                 <p class="title has-text-centered">{{count}}</p>
            </div>
        </nav>
    </div>
</template>
<script>
    export default {
        mounted() {
            this.$http.get('/status/'+this.id)
            .then((resp)=>{
                console.log(resp)
                this.status = resp.body.status
                this.loading = false
            })
        },

        props: ['id','count'],

        data () {
            return {
                status: '',
                loading: true
            }
        },

        methods:  {
            add() {
                this.loading = true
                this.$http.get('/follow/'+this.id)
                    .then((resp)=>{
                        this.status = 'following'
                        noty({
                            type: 'alert',
                            layout: 'bottomLeft',
                            text: 'You followed someone'
                        })
                        this.count = this.count + 1
                        this.loading = false
                    })
            }, 
            unfollow() {
                this.loading = true
                this.$http.get('/unfollow/'+this.id)
                    .then((resp)=>{
                        if(resp.body == 1)
                            this.status = 'none'
                        noty({
                            type:'alert',
                            layout: 'bottomLeft',
                            theme: 'metroui',
                            timeout: 5000,
                            text: 'You unfollow someone'
                        })
                        this.count = this.count - 1
                        this.loading = false
                    })
            },
            followback(){
                this.loading = true
                this.$http.get('/followback/'+this.id)
                    .then((resp)=>{
                        console.log(resp.body)
                        if(resp.body == 1)
                            this.status = 'following'
                        noty({
                            type: 'alert',
                            theme: 'metroui',
                            layout: 'bottomLeft',
                            text: 'You followed someone'
                        })
                        this.count = this.count + 1
                        this.loading = false
                    })
            }
        }
    }
</script>
