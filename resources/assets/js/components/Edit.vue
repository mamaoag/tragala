    <template>
        <div class="columns">
        <div class="column">
        <div class="box">
            <h2 class="subtitle">Your Details</h2>
        <label for="" class="label">First Name</label>
        <p class="control"><input type="text" name="first_name" id="" class="input" :value="details.first_name" v-model="fname"></p>
        <label for="" class="label">Last Name</label>
        <p class="control"><input type="text" name="last_name" id="" class="input" :value="details.last_name" v-model="lname"></p>
        <label for="" class="label">Location</label>
        <p class="control"><input type="text" name="location" id="" class="input" :value="details.location" v-model="loca"></p>
        <label for="" class="label">Gender</label>
        <p class="control">
                <label for="" class="radio">
                    <input type="radio" name="gender" id="" value="male" v-model="gend"> Male
                </label>
                <label for="" class="radio">
                    <input type="radio" name="gender" id="" value="female" v-model="gend"> Female
                </label>
            </p>
        <button class="button is-danger" @click="edit_information">Update</button>
        <br>
        <br>
        <h2 class="subtitle">Avatar</h2>
            <input ref="avatar" type="file" name="avatar"  id="avatar" class="upload" v-on:change="onChange">                      

            <label for="avatar" class="button is-primary"><i class="fa fa-camera"></i> </label>
            <button class="button is-danger"><i class="fa fa-upload fa-lg"></i></button>
        </div>
    </div>
    <div class="column is-4">
        <br>
        <br>
        <br>
        <h2 class="subtitle">Your Profile Preview</h2>
        <div class="card">
  <div class="card-image">
    <figure class="image is-4by3">
      <img :src="details.banner" alt="Image">
    </figure>
  </div>
  <div class="card-content">
    <div class="media-left">
        <figure class="image is-128x128" style="margin-top: -100; margin-left:25%">
          <img :src="details.avatar" alt="Image" style="border-radius: 50%">
        </figure>
      </div>
      <br>
    <div class="media">
      <div class="media-content">
        <p class="title has-text-centered">{{fname}} {{lname}}</p>
        <p class="subtitle has-text-centered">{{loca}}</p>
      </div>
    </div>

    <div class="content">
        <a :href="link" class="button is-danger" style="margin-left: 30%">See Profile</a>
    </div>
  </div>
  </div>
</div>
    </div>
    </template>
    <script>
        export default{
            mounted() {
                this.getdetails()
            },

            props: ['id'],
            
            data() {
                return {
                    details: [],
                    fname: '',
                    lname: '',
                    loca: '',
                    gender: '',
                    link: '',
                }
            },

            methods: {
                getdetails() {
                    this.$http.get('/u/'+this.id+'/json')
                        .then((r)=>{
                            this.details = r.body
                            this.fname = this.details.first_name
                            this.lname = this.details.last_name
                            this.loca = this.details.location
                            this.gend = this.details.gender
                            this.link = '/u/'+this.details.username
                        })
                },
                previewThumbnail(event) {
                    var input = event.target;

                    if (input.files && input.files[0]) {
                        var reader = new FileReader();

                        var vm = this;

                        reader.onload = function(e) {
                        vm.imageSrc = e.target.result;
                        }

                        reader.readAsDataURL(input.files[0]);
                   
                    }
                },
                edit_information(e) {
                    e.preventDefault()
                    var formData = new FormData()
                    formData.append('first_name',this.fname)
                    formData.append('last_name',this.lname)
                    formData.append('gender',this.gend)
                    formData.append('location', this.loca)
                    console.log(formData)
                    this.$http.post('/u/'+this.id+'/edit',formData,{
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
                                text: 'Profile Updated'
                            })
                            this.getdetails()
                        })
                },
                onChange(event) {
                    this.file = event.target.files[0]
                },

            }
        }
    </script>