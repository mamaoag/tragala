<template>
    <div>
        <a class="level-item" @click="open"><i class="fa fa-ban fa-lg"></i></a>
        <div :class="{modal:modal, 'is-active':active}">
            <div class="modal-background" @click="close"></div>
            <div class="modal-content">
                <div class="box">
                    <h3 class="title">Report this post?</h3>
                    <p class="subtitle">Please select the reason why are you reporting this post.</p>
                    <p class="control">
                            <label for="" class="radio">
                                <input type="radio" name="type" value="inappropriate" v-model="report">
                                Inappropriate Content 
                            </label>
                            <label for="" class="radio">
                                <input type="radio" name="type" value="nudity" v-model="report">
                                Nudity
                            </label>
                            <label for="" class="radio">
                                <input type="radio" name="type" value="violence" v-model="report">
                                Violence
                            </label>
                            <label for="" class="radio">
                                <input type="radio" name="type" value="report" v-model="report">
                                Hate Speech
                            </label>
                    </p>
                    <p class="control">
                            <button class="button is-primary" @click="sendReport">Submit Report</button>
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
                report: '',
                active: false,
                modal: true
             }
        },
        props: ['postid'],
        methods: {
            sendReport () {
                console.log(this.report)
                var data = new FormData()
                data.append('type',this.report)
                this.$http.post('/report/'+this.postid,data)
                    .then((r)=>{
                        noty({
                            layout: 'topCenter',
                            theme: 'metroui',
                            text: 'Report submitted, the administrators will process your report'
                        })
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