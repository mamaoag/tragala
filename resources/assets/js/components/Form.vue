<template>
    <div class="nav-item">
    <a @click="open" class="" style="color:#fff"><i class="fa fa-pencil fa-lg"></i></a>
    <div :class="{modal: pop, 'is-active': popup}">
     <div class="modal-background" @click="close"></div>
    <div class="modal-content">

        <div class="box">
            <p class="menu-label">Create your post</p>
            <form id="myform">
                        <p class="control">
                        <textarea type="text" name="description" id="" :class="{input:input, 'is-expanded':expand, textarea:textarea, 'is-danger':invalid}" placeholder="In your mind?" v-model="description"></textarea>
                        </p>
                        <nav class="level">
                            <div class="level-left">
                                <div class="level-item">
                                    <p class="control has-addons">
                                        <input ref="file" type="file" name="file"  id="file" class="upload" v-on:change="onChange">                      
                                        <span class="select is-primary">
                                            <select name="category" id="category" class="input" v-model="category">
                                            <option v-for="option in options" v-bind:value="option.value">{{option.text}}</option>
                                            </select>
                                        </span>
                                    </p>
                                </div>
                                <div class="level-item">
                                    <p class="control">
                                        <label for="file" :class="{button:button, 'is-danger':nofile, 'is-primary':uploaded}"><i class="fa fa-camera"></i> &nbsp;{{name}}</label>
                                    </p>
                                </div>
                            </div>
                            <div class="level-right">
                                <div class="level-item">
                                    <p class="control is-6">
                                        <button type="submit" :class="{button:button, 'is-primary':uploaded, 'is-danger':nofile}" :disabled="nofile" @click="create_post"><i class="fa fa-pencil"></i> &nbsp;Submit</button>
                                    </p>
                                </div>
                            </div>
                        </nav>
                    </form> 
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
                name: 'Add Photo',
                category: 'Default',
                options:[
                    {
                        text: 'Select Category',
                        value: 'Default'
                    },
                    {
                        text: 'Food',
                        value: 'Food'
                    },{
                        text: 'Experience',
                        value: 'Experience'
                    },{
                        text: 'Travel',
                        value: 'Travel'
                    },
                ],
                button: true,
                nofile: true,
                uploaded: false,
                file: '',          
                not_working: true,
                loading: false,
                input: true,
                expand: true,
                textarea: true,
                invalid: false,
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
                    },(response)=>{
                        this.errors = response.data

                        if(this.errors.description){
                            this.invalid = true
                     }
                    }
                )
            },
            onChange(event) {
                this.file = event.target.files[0]
                this.nofile = false
                this.uploaded = true
                this.name = 'Photo Added'
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