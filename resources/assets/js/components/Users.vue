<template>
    <div class="">
        <br>
        <nav class="level container">
            <div class="level-left">
                <div class="level-item">
                    <h2 class="subtitle">User Management
                    <span class="menu-label">Manage Your Users</span></h2>
                </div>
            </div>
            <div class="right"><button type="submit" class="button is-danger"><i class="fa fa-user-plus fa-lg"></i> &nbsp;Create Admin</button></div>
        </nav>
        <table class="table is-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Avatar</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Banned</th>
                    <th>Role</th>
                    <th>Infractions</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="user in users">
                    <td>{{user.id}}</td>
                    <td>
                        <figure class="image is-32x32">
                            <img :src="user.avatar" alt="">
                        </figure>
                    </td>
                    <td>{{user.last_name}}, <h2 class="menu-label">{{user.first_name}}</h2></td>
                    <td>{{user.email}}</td>
                    <td><span v-if="user.ban == 0">No</span>
                    <span v-if="user.ban == 1">Yes</span></td>
                    <td>
                        <span v-show="user.usergroup == 1">Member</span>
                        <span v-show="user.usergroup == 2">Known Personality</span>
                        <span v-show="user.usergroup == 3">Administrator</span>
                        <span v-show="user.usergroup == 4">Head Administrator</span>
                    </td>
                    <td>
                        <div>
                            <span v-show="user.warning == 0">No warnings</span>
                            <span v-show="user.warning != 0">{{user.warning}}</span>
                        </div>
                    </td>
                    <td>
                        <button class="button is-danger" v-show="user.usergroup == 1 || user.usegroup == 2" @click="promote(user.id)"><i class="fa fa-angle-double-up fa-lg"></i></button>
                        <button class="button is-danger" v-show="user.usergroup == 3" @click="demote(user.id)"><i class="fa fa-angle-double-down fa-lg"></i></button>
                        <button class="button is-danger" v-show="user.ban == 0 && user.usergroup != 4" @click="ban(user.id)"><i class="fa fa-ban fa-lg"></i></button>
                        <button class="button is-danger" v-show="user.ban == 1 && user.usergroup !=4" @click="unban(user.id)"><i class="fa fa-check fa-lg"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
    export default {
        mounted() {
            this.getusers()
        },

        data() {
            return {
                users: [],
                loading: false,
                id: ''
            }
        },

        ready() {
            this.getusers()
        },

        methods: {
            getusers() {
                this.loading = true
                this.$http.get('/all')
                    .then((r)=> {
                        this.users = r.body
                        this.loading = false
                    })
            },
            ban(id)  {
                this.$http.get('/ban/'+id)
                    .then((r)=>{
                        noty({
                            type: 'success',
                            theme: 'metroui',
                            layout: 'topCenter',
                            text: 'You successfully banned the user'
                        })
                        this.getusers()
                    })
            },
            unban(id)  {
                this.$http.get('/unban/'+id)
                    .then((r)=>{
                        noty({
                            type: 'success',
                            theme: 'metroui',
                            layout: 'topCenter',
                            text: 'You successfully unbanned the user'
                        })
                        this.getusers()
                    })
            },
            promote(id)  {
                this.$http.get('/promote/'+id)
                    .then((r)=>{
                        noty({
                            type: 'success',
                            theme: 'metroui',
                            layout: 'topCenter',
                            text: 'You successfully made the user an admin'
                        })
                        this.getusers()
                    })
            },
            demote(id)  {
                this.$http.get('/demote/'+id)
                    .then((r)=>{
                        noty({
                            type: 'success',
                            theme: 'metroui',
                            layout: 'topCenter',
                            text: 'You successfully made the user a member'
                        })
                        this.getusers()
                    })
            },

        }
    }
</script>