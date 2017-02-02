<template>
    <div class="">
        <br>
        <nav class="level container">
            <div class="level-left">
                <div class="level-item">
                    <h2 class="subtitle">Audit Trail
                    <span class="menu-label">Track your user's action</span></h2>
                </div>
            </div>
        </nav>
        <table class="table is-striped">
            <thead>
                <tr>
                    <th>Avatar</th>
                    <th>Full Name</th>
                    <th>Action</th>
                    <th>Time</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="audit in audits">
                    <td>
                        <figure class="image is-32x32">
                            <img :src="audit.admin.avatar" alt="">
                        </figure>
                    </td>
                    <td>{{audit.admin.last_name}}, <h2 class="menu-label">{{audit.admin.first_name}}</h2></td>
                    <td>
                        <div>
                            <span v-if="audit.action_code == 0">accessed the Administration Dashboard.</span>
                            <span v-if="audit.action_code == 1">accessed the User Management Dashboard.</span>
                            <span v-if="audit.action_code == 2">accessed the Location Management Dashboard.</span>
                            <span v-if="audit.action_code == 3">accessed the User Reports Dashboard.</span>
                            <span v-if="audit.action_code == 4">accessed Statistics Dashboard.</span>
                            <span v-if="audit.action_code == 5">became an Administrator through secret route.</span>
                            <span v-if="audit.action_code == 11">checked {{audit.user.first_name}} {{audit.user.last_name}}'s details.</span>
                            <span v-if="audit.action_code == 12">edited {{audit.user.first_name}} {{audit.user.last_name}}'s details.</span>
                            <span v-if="audit.action_code == 13">promoted {{audit.user.first_name}} {{audit.user.last_name}} to an Administrator.</span>
                            <span v-if="audit.action_code == 14">demoted {{audit.user.first_name}} {{audit.user.last_name}} to a User.</span>
                            <span v-if="audit.action_code == 15">banned {{audit.user.first_name}} {{audit.user.last_name}}.</span>
                            <span v-if="audit.action_code == 16">unbanned {{audit.user.first_name}} {{audit.user.last_name}}.</span>
                            <span v-if="audit.action_code == 17">created an Administrator account.</span>
                            <span v-if="audit.action_code == 18">changed password of {{audit.user.first_name}} {{audit.user.last_name}}.</span>
                            <span v-if="audit.action_code == 21">edited location</span>
                            <span v-if="audit.action_code == 22">deleted </span>
                            <span v-if="audit.action_code == 31">Case # {{audit.report_id}} - marked no action.</span>
                            <span v-if="audit.action_code == 32">Case # {{audit.report_id}} - sent infraction to {{audit.user.first_name}} {{audit.user.last_name}}.</span>
                            <span v-if="audit.action_code == 6">accessed the Audit Trail</span> 
                        </div>    
                    </td>
                    <td>
                        {{dateFromNow(audit.created_at)}}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
    import moment from 'moment'
    export default {
        mounted() {
            this.getAudit()
        },

        data() {
            return {
                audits: [],
                loading: false,
                id: ''
            }
        },
        
        methods: {
            getAudit() {
                this.loading = true
                this.$http.get('/api/admin/audit')
                    .then((r)=> {
                        this.audits = r.body
                        this.loading = false
                    })
            },
            dateFromNow(e) {
                    return moment(e).fromNow();
            }
        }
    }
</script>