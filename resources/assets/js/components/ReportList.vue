<template>
    <div class="">
        <br>
        <nav class="level container">
            <div class="level-left">
                <div class="level-item">
                    <h2 class="subtitle">User Report Management
                    <span class="menu-label">Manage Your Users</span></h2>
                </div>
            </div>
        </nav>
        <table class="table is-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Avatar</th>
                    <th>Post Owner</th>
                    <th>Post</th>
                    <th>Report Type</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="report in reports">
                    <td>{{report.id}}</td>
                    <td>
                        <figure class="image is-32x32">
                            <img :src="report.users.avatar" alt="">
                        </figure>
                    </td>
                    <td>{{report.users.last_name}}, <h2 class="menu-label">{{report.users.first_name}}</h2></td>
                    <td>    
                        <a :href="'/post/'+report.posts.id"><i class="fa fa-eye fa-lg"></i></a>
                    </td>
                    <td>{{report.type}}</td>
                    <td>
                        <span v-show="report.status == 0">Pending</span>
                        <span v-show="report.status == 1">No action</span>
                        <span v-show="report.status == 2">User Infracted</span>
                        <span v-show="report.status == 3">User Banned</span>
                    </td>
                    <td>
                        <button class="button is-danger" @click="noaction(report.id)" v-show="report.status === 0"><i class="fa fa-angle-double-up fa-lg"></i>No action</button>
                        <button class="button is-danger" @click="infract(report.users.id,report.id,report.posts.id)" v-show="report.status === 0"><i class="fa fa-angle-double-down fa-lg"></i>Infract</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
    export default {
        mounted() {
            this.getReports()
        },

        data() {
            return {
                reports: [],
                loading: false,
                id: '',
                link: 0,
            }
        },
        methods: {
            getReports() {
                this.loading = true
                this.$http.get('/reports')
                    .then((r)=> {
                        this.reports = r.body
                        this.loading = false
                    })
            },
            infract(id,rid,pid)  {
                this.$http.get('/infract/'+id+'/report/'+rid+'/post/'+pid)
                    .then((r)=>{
                        noty({
                            type: 'success',
                            theme: 'metroui',
                            layout: 'topCenter',
                            text: 'You successfully banned the user'
                        })
                        this.getReports()
                    })
            },
            noaction(id) {
                this.$http.get('/noaction/'+id)
                    .then( r => {
                        noty({
                            type: 'success',
                            theme: 'metroui',
                            layout: 'topCenter',
                            text: 'No action applied to report'
                        })
                        this.getReports()
                    })
            }
        }
    }
</script>