<template>
    <div class='card'>
        <div class='card-header'>Members
            <button type='button' class='btn btn-success float-right mr-1'>ADD ALL</button>
            <button v-on:click='showAddModal = !showAddModal' type='button' class='btn btn-primary float-right mr-1'>ADD</button>
        </div>

        <div class='card-body'>
            <table class='table table-bordered table-base'>
                <thead>
                    <tr>
                        <th class='text-center bg-light'>Nmae</th>
                        <th class='text-center bg-light'>Joining at</th>
                        <th class='text-center bg-light'>Recruit Cate.</th>
                        <th class='text-center bg-light'>Employment Stat.</th>
                        <th class='text-center bg-light'>Post</th>
                        <th class='text-center bg-light'>Division</th>
                        <th class='text-center bg-light'></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-show='members.length === 0'>
                        <td colspan='7'>
                            <span>データがありません。</span>
                        </td>
                    </tr>

                    <tr v-show='members.length !== 0' v-for='(member, index) in members' :key='index'>
                        <td class='text-center align-middle'>{{ member.name }}</td>
                        <td class='text-center align-middle'>{{ member.joining_at }}</td>
                        <td class='text-center align-middle'>{{ member.recruit_category }}</td>
                        <td class='text-center align-middle'>{{ member.employment_status }}</td>
                        <td class='text-center align-middle'>{{ member.post }}</td>
                        <td class='text-center align-middle'>{{ member.division }}</td>
                        <td class='text-center align-middle'>
                            <button v-on:click='openEditModal()' type='button' class='btn btn-outline-success'>編集</button>
                            <button v-show='member.del_flg === 0' v-on:click='deleteMember(member.id)' type='button' class='btn btn-outline-danger'>削除</button>
                            <button v-show='member.del_flg !== 0' v-on:click='restMember(member.id)' type='button' class='btn btn-outline-secondary'>復元</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <modal v-if='showAddModal' @close='showAddModal = false'>
            <h3 slot='header'>ユーザ登録</h3>
            <div slot='body'>
                <div v-show='message !== ""' class="alert alert-danger">
                    {{ message }}
                </div>

                <div class='form-group col-md-8'>
                    <label class='col-form-label' for='name'>氏名</label>
                    <input v-model='name' type='text' class='form-control' id='name' name='name' v-bind:class='[ errors.name ? "alert-danger" : "" ]'>
                    <label v-show='errors.name' class='text-danger'>{{ errors.name ? errors.name[0] : '' }}</label>
                </div>

                <div class='form-group col-md-8'>
                    <label class='col-form-label' for='email'>メールアドレス</label>
                    <input v-model='email' type='email' class='form-control' id='email' name='email' v-bind:class='[ errors.email ? "alert-danger" : "" ]'>
                    <label v-show='errors.email' class='text-danger'>{{ errors.email ? errors.email[0] : '' }}</label>
                </div>

                <div class='form-group col-md-8'>
                    <label class='col-form-label' for='employeeNo'>社員番号</label>
                    <input v-model='employeeNo' type='text' class='form-control' id='employeeNo' name='employeeNo' v-bind:class='[ errors.employeeNo ? "alert-danger" : "" ]'>
                    <label v-show='errors.employeeNo' class='text-danger'>{{ errors.employeeNo ? errors.employeeNo[0] : '' }}</label>
                </div>

                <hr>

                <div class='form-group col-md-8'>
                    <label class='col-form-label' for='division'>部署</label>
                    <select v-model='division' class='form-control' id='division' name='division' v-bind:class='[ errors.division ? "alert-danger" : "" ]'>
                        <option value=''></option>
                        <option v-for='(divName, index) in divisions' :key='index' :value='index'>{{ divName }}</option>
                    </select>
                    <label v-show='errors.division' class='text-danger'>{{ errors.division ? errors.division[0] : '' }}</label>
                </div>

                <div class='form-group col-md-8'>
                    <label class='col-form-label' for='jobCategory'>職種</label>
                    <select v-model='jobCategory' class='form-control' id='jobCategory' name='jobCategory' v-bind:class='[ errors.jobCategory ? "alert-danger" : "" ]'>
                        <option value=''></option>
                        <option v-for='(jobName, index) in jobCategories' :key='index' :value='index'>{{ jobName }}</option>
                    </select>
                    <label v-show='errors.jobCategory' class='text-danger'>{{ errors.jobCategory ? errors.jobCategory[0] : '' }}</label>
                </div>

                <div class='form-group col-md-8'>
                    <label class='col-form-label' for='post'>役職</label>
                    <select v-model='post' class='form-control' id='post' name='post' v-bind:class='[ errors.post ? "alert-danger" : "" ]'>
                        <option value=''></option>
                        <option v-for='(postName, index) in posts' :key='index' :value='index'>{{ postName }}</option>
                    </select>
                    <label v-show='errors.post' class='text-danger'>{{ errors.post ? errors.post[0] : '' }}</label>
                </div>

                <div class='form-group col-md-8'>
                    <label class='col-form-label' for='recruitCategory'>採用区分</label>
                    <select v-model='recruitCategory' class='form-control' id='recruitCategory' name='recruitCategory' v-bind:class='[ errors.recruitCategory ? "alert-danger" : "" ]'>
                        <option value=''></option>
                        <option v-for='(type, index) in recruitType' :key='index' :value='index'>{{ type }}</option>
                    </select>
                    <label v-show='errors.recruitCategory' class='text-danger'>{{ errors.recruitCategory ? errors.recruitCategory[0] : '' }}</label>
                </div>

                <div class='form-group col-md-8'>
                    <label class='col-form-label' for='employmentStatus'>雇用形態</label>
                    <select v-model='employmentStatus' class='form-control' id='employmentStatus' name='employmentStatus' v-bind:class='[ errors.employmentStatus ? "alert-danger" : "" ]'>
                        <option value=''></option>
                        <option v-for='(stat, index) in empStatus' :key='index' :value='index'>{{ stat }}</option>
                    </select>
                    <label v-show='errors.employmentStatus' class='text-danger'>{{ errors.employmentStatus ? errors.employmentStatus[0] : '' }}</label>
                </div>

                <div class='form-group col-md-8'>
                    <label class='col-form-label' for='joiningAt'>入社時期</label>
                    <input v-model='joiningAt' type='date' class='form-control' id='joiningAt' name='joiningAt' v-bind:class='[ errors.joiningAt ? "alert-danger" : "" ]'>
                    <label v-show='errors.joiningAt' class='text-danger'>{{ errors.joiningAt ? errors.joiningAt[0] : '' }}</label>
                </div>
            </div>
            <div slot='footer' class='form-group col-md-8'>
                <button v-on:click='postMember()' type='button' class='btn btn-success'>{{ btnLabel }}</button>
            </div>
        </modal>
    </div>
</template>

<style>
.modal-enter-active, .modal-leave-active {
    transition:opacity 0.5s;
}
.modal-enter, .modal-leave-to {
    opacity: 0;
}
</style>

<script>
    export default {
        props:[
            'users',
            'jobCategories',
            'posts',
            'recruitType',
            'empStatus',
            'divisions'
        ],
        data(){
            return {
                members: this.users,
                name: '',
                email: '',
                employeeNo: '',
                division: '',
                jobCategory: '',
                post: '',
                recruitCategory: '',
                employmentStatus: '',
                joiningAt: '',
                showAddModal: false,
                showAddAllModal: false,
                showEditModal: false,
                message: '',
                errors: []
            }
        },
        methods: {
            closeModal: function(e) {
                this.showAddModal = false
                e.preventDefault()
            },
            postMember: function() {
                let data = {
                    'name'             : this.name,
                    'email'            : this.email,
                    'employeeNo'       : this.employeeNo,
                    'division'         : this.division,
                    'jobCategory'      : this.jobCategory,
                    'post'             : this.post,
                    'recruitCategory'  : this.recruitCategory,
                    'employmentStatus' : this.employmentStatus,
                    'joiningAt'        : this.joiningAt,
                }

                axios.defaults.headers.common = {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content'),
                    'Authorization': 'Bearer ' + Laravel.apiToken,
                    'Accept' : 'application/json',
                };

                axios.post('/api/member/save', data).then(res => {
                    this.message = ''
                    this.errors = []
                    this.showAddModal = false
                    this.name = ''
                    this.email = ''
                    this.employeeNo = ''
                    this.division = ''
                    this.jobCategory = ''
                    this.post = ''
                    this.recruitCategory = ''
                    this.employmentStatus = ''
                    this.joiningAt = ''
                }).catch(err => {
                    this.message = err.response.data.message
                    this.errors = err.response.data.errors
                })
            },
            openEditModal: function() {

            },
            deleteMember: function(id) {
                let data = {
                    userId: id
                }

                axios.defaults.headers.common = {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content'),
                    'Authorization': 'Bearer ' + Laravel.apiToken,
                };

                axios.post('/api/member/delete', data).then(res => {
                    console.log(res)
                }).catch(err => {
                    console.log(err)
                })
            },
            restMember: function(id) {
                let data = {
                    userId: id
                }

                axios.defaults.headers.common = {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content'),
                    'Authorization': 'Bearer ' + Laravel.apiToken,
                };

                axios.post('/api/member/rest', data).then(res => {
                    console.log(res)
                }).catch(err => {
                    console.log(err)
                })
            }
        }
    }
</script>
