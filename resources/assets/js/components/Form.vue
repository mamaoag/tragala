<template>
    <div class="nav-item">
    <a @click="open" class="" style="color:#fff"><i class="fa fa-pencil fa-lg"></i></a>
    <div :class="{modal: pop, 'is-active': popup}">
     <div class="modal-background" @click="close"></div>
    <div class="modal-content">

        <div class="box">
                    <form id="myform">
                    <p class="control has-addons">
                        <input ref="file" type="file" name="file"  id="file" class="upload" v-on:change="onChange">                      
                        <span class="select is-primary"><select name="category" id="category" class="input" v-model="category">
                                                <option>Food</option>
                                                <option>Travel</option>
                                                <option>Experience</option>
                                                @if(Auth::user()->usergroup > 2)
                                                <option>Announcement</option>
                                                @endif
                                            </select>
                    </span>
                    <label for="file" class="button is-primary"><i class="fa fa-camera"></i> </label>
                    <input type="text" name="description" id="" class="input is-expanded" placeholder="In your mind?" v-model="description">
                    <button type="submit" class="input button is-danger" :disabled="not_working" @click="create_post"><i class="fa fa-pencil"></i></button>
                    </p> 
            </div>        
            </div>
        </div>
        <button v-show="popup" @click="close" class="modal-close"></button>
    </div>
</template>
<script>
    export default {
        mounted () {

        },

        data () {
            return {
                description: '',
                file: '',          
                not_working: true,
                loading: false,
                input: true,
                expand: true,
                pop: true,
                popup: false,
            }
        },

        watch: {
            description() {
                if(this.description.length > 0)
                    this.not_working = false
                else
                    this.not_working = true
            }
        },

        methods: {
            create_post(e) {
                this.loading = true
                e.preventDefault()
                var formData = new FormData()
                formData.append('file',this.file)
                formData.append('category',this.category)
                formData.append('description',this.description)
                console.log(formData)
                this.$http.post('/post',formData,{
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                    .then((r)=>{
                        this.description = ''
                        noty({
                            type: 'alert',
                            layout: 'topCenter',
                            theme: 'metroui',
                            text: 'Post success'
                        })
                        this.popup = false
                        this.loading = false
                    })
            },
            onChange(event) {
                this.file = event.target.files[0]
            },
            open() {
                this.popup = true
            },
            close() {
                this.popup = false
            }
        }
    }
</script>