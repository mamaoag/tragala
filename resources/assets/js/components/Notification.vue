<template>
    <div>
      
    </div>
</template>

<script>
    export default {
        mounted() {
            this.listen()
        },

        props: ['id'],

        methods: {
            listen() {
                Echo.private('App.User.' + this.id)
                    .notification((notification)=>{
                        noty({
                            type: 'alert',
                            layout:'topLeft',
                            text: notification.message
                        })
                        
                        this.$store.commit('add_notif', notification)
                        console.log(notification)
                    })
            }
    }
    }
</script>
