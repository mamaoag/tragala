<template>
    <div>
        <a class="level-item" @click="open"><i class="fa fa-ban fa-lg"></i></a>
        <div :class="{modal:modal, 'is-active':active}">
            <div class="modal-background" @click="close"></div>
            <div class="modal-content">
                <div class="box">
                    <h3 class="title">Safety</h3>
                    <p class="subtitle">Determines the safety of the place based on the response given by the community.</p>
                    <p class="control">
                            <label for="" class="radio">
                                <input type="radio" name="type" value="true" v-model="safe">
                                Safe
                            </label>
                            <label for="" class="radio">
                                <input type="radio" name="type" value="false" v-model="safe">
                                Not Safe
                            </label>
                    </p>
                    <p class="control">
                            <button class="button is-primary" @click="sendResponse">Submit Response</button>
                    </p>
                </div>
            </div>
            <button class="modal-close" @click="close" v-show="active"></button>
        </div>
    </div>
</template>

<script>
    export default {
        mounted () {

        },
        data() {
             return {
                safe: false,
                active: false,
                modal: true
             }
        },
        props: ['postid'],
        methods: {
            sendSafe () {
                console.log(this.safe)
                var data = new FormData()
                data.append('type',this.safe)
                this.$http.post('/safe/'+this.postid,data)
                    .then((r)=>{
                        this.close()
                    })
            },

            open() {
                this.active = true
            },

            close() {
                this.active = false
            }
        }
    }

</script>