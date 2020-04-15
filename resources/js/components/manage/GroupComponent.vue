<template>
    <div class='card'>
        <div class='card-header'>紐付けグループ管理
            <button v-on:click='showAddModal = !showAddModal' type='button' class='btn btn-primary float-right mr-1'>追加</button>
        </div>

        <div class='card-body'>
            <table class='table table-bordered table-base'>
                <thead>
                    <tr>
                        <th class='text-center bg-light'>グループ名</th>
                        <th class='text-center bg-light'>被評価者数</th>
                        <th class='text-center bg-light'>評価者数</th>
                        <th class='text-center bg-light'></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-show='groups.length === 0'>
                        <td colspan='4'>
                            <span>データがありません。</span>
                        </td>
                    </tr>

                    <tr v-show='groups.length !== 0' v-for='(group, index) in groups' :key='index'>
                        <td class='text-center align-middle'>{{ group.group_name }}</td>
                        <td class='text-center align-middle'>{{ group.evaluators_count }}</td>
                        <td class='text-center align-middle'>{{ group.valuators_count }}</td>
                        <td class='text-center align-middle'>
                            <button v-on:click='openEditModal(group)' type='button' class='btn btn-outline-success'>編集</button>
                            <button v-show='group.del_flg === 0' v-on:click='deleteGroup(group.id)' type='button' class='btn btn-outline-danger'>削除</button>
                            <button v-show='group.del_flg !== 0' v-on:click='restGroup(group.id)' type='button' class='btn btn-outline-secondary'>復元</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <modal v-if='showAddModal' @close='closeModal()'>
            <h3 slot='header'>紐付けグループ登録</h3>
            <div slot='body'>
                <div v-show='message !== ""' class="alert alert-danger">
                    {{ message }}
                </div>

                <div class='form-group col-md-8'>
                    <label class='col-form-label' for='groupName'>グループ名</label>
                    <input v-model='groupName' type='text' class='form-control' id='groupName' name='groupName' v-bind:class='[ errors.groupName ? "alert-danger" : "" ]'>
                    <label v-show='errors.groupName' class='text-danger'>{{ errors.groupName ? errors.groupName[0] : '' }}</label>
                </div>

                <div class='form-group col-md-12'>
                    <div class='form-group'>
                        <button v-on:click='add()' type='button' class='btn btn-success'>紐付けを追加</button>（被評価者：評価者）
                    </div>

                    <div v-for='(name, index) in evaluators' :key='index'>
                        <div class='row'>
                            <div class='form-group col-md-5'>
                                <select class='form-control' id='evaluators' @change='changeEvaluatorValue(index, $event)'>
                                    <option value=''></option>
                                    <option v-for='(user, index) in users' :key='index' :value='user.name'>{{ user.name }}</option>
                                </select>
                            </div>

                            <div class='form-group col-md-5'>
                                <select class='form-control' id='valuators' @change='changeValuatorValue(index, $event)'>
                                    <option value=''></option>
                                    <option v-for='(user, index) in users' :key='index' :value='user.name'>{{ user.name }}</option>
                                </select>
                            </div>

                            <div class='form-group'>
                                <button v-on:click='remove(index)' type='button' class='btn btn-danger'>削除</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div slot='footer' class='form-group col-md-8'>
                <button v-on:click='postGroup()' type='button' class='btn btn-success'>登録</button>
            </div>
        </modal>

        <modal v-if='showEditModal' @close='closeModal()'>
            <h3 slot='header'>紐付けグループ編集</h3>
            <div slot='body'>
                <div v-show='message !== ""' class="alert alert-danger">
                    {{ message }}
                </div>

                <div class='form-group col-md-8'>
                    <label class='col-form-label' for='groupName'>グループ名</label>
                    <input v-model='groupName' type='text' class='form-control' id='groupName' name='groupName' v-bind:class='[ errors.groupName ? "alert-danger" : "" ]'>
                    <label v-show='errors.groupName' class='text-danger'>{{ errors.groupName ? errors.groupName[0] : '' }}</label>
                </div>

                <div class='form-group col-md-12'>
                    <div class='form-group'>
                        <button v-on:click='add()' type='button' class='btn btn-success'>紐付けを追加</button>（被評価者：評価者）
                    </div>

                    <div v-for='(name, index) in evaluators' :key='index'>
                        <div class='row'>
                            <div class='form-group col-md-5'>
                                <select class='form-control' id='evaluators' @change='changeEvaluatorValue(index, $event)'>
                                    <option value=''></option>
                                    <option v-for='(user, idx) in users' :key='idx' :value='user.name' :selected='user.name == name ? "selected" : ""'>{{ user.name }}</option>
                                </select>
                            </div>

                            <div class='form-group col-md-5'>
                                <select class='form-control' id='valuators' @change='changeValuatorValue(index, $event)'>
                                    <option value=''></option>
                                    <option v-for='(user, idx) in users' :key='idx' :value='user.name' :selected='user.name == valuators[index] ? "selected" : ""'>{{ user.name }}</option>
                                </select>
                            </div>

                            <div class='form-group'>
                                <button v-on:click='remove(index)' type='button' class='btn btn-danger'>削除</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div slot='footer' class='form-group col-md-8'>
                <button v-on:click='postEditGroup()' type='button' class='btn btn-success'>編集</button>
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
            'groups',
            'users',
        ],
        data(){
            return {
                id: '',
                groupName: '',
                evaluators: [''],
                valuators: [''],
                showAddModal: false,
                showEditModal: false,
                message: '',
                errors: []
            }
        },
        methods: {
            closeModal: function() {
                this.showAddModal = false
                this.showEditModal = false

                this.message = ''
                this.errors = []

                this.groupName = ''
                this.evaluators = ['']
                this.valuators = ['']
            },
            add: function() {
                this.evaluators.push('')
                this.valuators.push('')
            },
            remove: function(index) {
                if (this.evaluators.length !== 1) this.evaluators.splice(index, 1)
                if (this.valuators.length !== 1) this.valuators.splice(index, 1)
            },
            changeEvaluatorValue(index, e) {
                this.evaluators.splice(index, 1, e.target.value);
            },
            changeValuatorValue(index, e) {
                this.valuators.splice(index, 1, e.target.value);
            },
            postGroup: function() {
                let arr = this.valuators
                let set = new Set(arr)
                let setToArr = [...set];

                let data = {
                    'groupName'       : this.groupName,
                    'evaluators'      : this.evaluators,
                    'evaluatorsCount' : this.evaluators.length,
                    'valuators'       : this.valuators,
                    'valuatorsCount'  : setToArr.length,
                }

                axios.defaults.headers.common = {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content'),
                    'Authorization': 'Bearer ' + Laravel.apiToken,
                    'Accept' : 'application/json',
                };

                axios.post('/api/group/save', data).then(res => {
                    this.message = ''
                    this.errors = []
                    this.showAddModal = false
                    this.groupName = ''
                    this.evaluators = ['']
                    this.valuators = ['']
                }).catch(err => {
                    this.message = err.response.data.message
                    this.errors = err.response.data.errors
                })
            },
            openEditModal: function(group) {
                this.id = group.id
                this.groupName = group.group_name
                this.evaluators = JSON.parse(group.evaluators)
                this.valuators = JSON.parse(group.valuators)

                this.showEditModal = true
            },
            postEditGroup: function() {
                let arr = this.valuators
                let set = new Set(arr)
                let setToArr = [...set];

                let data = {
                    'id'              : this.id,
                    'groupName'       : this.groupName,
                    'evaluators'      : this.evaluators,
                    'evaluatorsCount' : this.evaluators.length,
                    'valuators'       : this.valuators,
                    'valuatorsCount'  : setToArr.length,
                }

                axios.defaults.headers.common = {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content'),
                    'Authorization': 'Bearer ' + Laravel.apiToken,
                    'Accept' : 'application/json',
                };

                axios.post('/api/group/edit', data).then(res => {
                    this.message = ''
                    this.errors = []
                    this.showEditModal = false
                    this.id = ''
                    this.groupName = ''
                    this.evaluators = ['']
                    this.valuators = ['']
                }).catch(err => {
                    this.message = err.response.data.message
                    this.errors = err.response.data.errors
                })
            },
            deleteGroup: function(id) {
                let data = {
                    'id': id
                }

                axios.defaults.headers.common = {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content'),
                    'Authorization': 'Bearer ' + Laravel.apiToken,
                };

                axios.post('/api/group/delete', data).then(res => {
                    console.log(res)
                }).catch(err => {
                    console.log(err)
                })
            },
            restGroup: function(id) {
                let data = {
                    'id': id
                }

                axios.defaults.headers.common = {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content'),
                    'Authorization': 'Bearer ' + Laravel.apiToken,
                };

                axios.post('/api/group/rest', data).then(res => {
                    console.log(res)
                }).catch(err => {
                    console.log(err)
                })
            }
        }
    }
</script>
