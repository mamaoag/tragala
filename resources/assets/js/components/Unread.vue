<template>
    <div class="nav-item">
        <a href="/notifications" style="color:#fff"><span class="tag is-danger" v-if="all_notifs_count > 0">{{all_notifs_count}}</span> &nbsp;<i class="fa fa-bell fa-lg"></i></a>
    </div>
</template>
<script>
    export default {
        mounted() {
            this.unread()
        },

        computed: {
            all_notifs_count() {
                return this.$store.getters.all_notifs_count
            }
        },
        methods: {
            unread(){
                this.$http.get('/unread')
                    .then((notifs) => {
                        notifs.body.forEach((notif)=>{
                            this.$store.commit('add_notif',notif)
                        })
                    })
                    
            }
        }
    }
</script>