<template>
    <div class='card'>
        <div class='card-header'>評価期間
            <button v-on:click='showAddModal = !showAddModal' type='button' class='btn btn-primary float-right mr-1'>追加</button>
        </div>

        <div class='card-body'>
            <table class='table table-bordered table-base'>
                <thead>
                    <tr>
                        <th class='text-center bg-light'>名前</th>
                        <th class='text-center bg-light'>開始日</th>
                        <th class='text-center bg-light'>終了日</th>
                        <th class='text-center bg-light'>ステータス</th>
                        <th class='text-center bg-light'></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-show='periods.length === 0'>
                        <td colspan='5'>
                            <span>データがありません。</span>
                        </td>
                    </tr>

                    <tr v-show='periods.length !== 0' v-for='(period, index) in periods' :key='index'>
                        <td class='text-center align-middle'>{{ period.period_name }}</td>
                        <td class='text-center align-middle'>{{ period.start_date }}</td>
                        <td class='text-center align-middle'>{{ period.end_date }}</td>
                        <td class='text-center align-middle'>{{ statusLabel(period.status) }}</td>
                        <td class='text-center align-middle'>
                            <button v-on:click='openEditModal(period)' type='button' class='btn btn-outline-success'>編集</button>
                            <button v-show='period.del_flg === 0' v-on:click='deleteperiod(period.id)' type='button' class='btn btn-outline-danger'>削除</button>
                            <button v-show='period.del_flg !== 0' v-on:click='restperiod(period.id)' type='button' class='btn btn-outline-secondary'>復元</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <modal v-if='showAddModal' @close='closeModal()'>
            <h3 slot='header'>評価期間登録</h3>
            <div slot='body'>
                <div v-show='message !== ""' class="alert alert-danger">
                    {{ message }}
                </div>

                <div class='form-group col-md-8'>
                    <label class='col-form-label' for='periodName'>評価期間名</label>
                    <input v-model='periodName' type='text' class='form-control' id='periodName' name='periodName' :class='[ errors.periodName ? "alert-danger" : "" ]'>
                    <label v-show='errors.periodName' class='text-danger'>{{ errors.periodName ? errors.periodName[0] : '' }}</label>
                </div>

                <div class='form-group col-md-8'>
                    <label class='col-form-label' for='startDate'>開始日</label>
                    <input v-model='startDate' type='date' class='form-control' id='startDate' name='startDate' :class='[ errors.startDate ? "alert-danger" : "" ]'>
                    <label v-show='errors.startDate' class='text-danger'>{{ errors.startDate ? errors.startDate[0] : '' }}</label>
                </div>

                <div class='form-group col-md-8'>
                    <label class='col-form-label' for='endDate'>終了日</label>
                    <input v-model='endDate' type='date' class='form-control' id='endDate' name='endDate' :class='[ errors.endDate ? "alert-danger" : "" ]'>
                    <label v-show='errors.endDate' class='text-danger'>{{ errors.endDate ? errors.endDate[0] : '' }}</label>
                </div>

                <div class='form-group col-md-8'>
                    <label class='col-form-label' for='status'>ステータス</label>
                    <select v-model='status' class='form-control' id='status' name='status' :class='[ errors.status ? "alert-danger" : "" ]'>
                        <option value='0'>進行中</option>
                        <option value='1'>開始前</option>
                        <option value='2'>期間満了</option>
                    </select>
                    <label v-show='errors.status' class='text-danger'>{{ errors.status ? errors.status[0] : '' }}</label>
                </div>
            </div>
            <div slot='footer' class='form-group col-md-8'>
                <button v-on:click='postPeriod()' type='button' class='btn btn-success'>登録</button>
            </div>
        </modal>

        <modal v-if='showEditModal' @close='closeModal()'>
            <h3 slot='header'>評価期間編集</h3>
            <div slot='body'>
                <div v-show='message !== ""' class="alert alert-danger">
                    {{ message }}
                </div>

                <div class='form-group col-md-8'>
                    <label class='col-form-label' for='periodName'>評価期間名</label>
                    <input v-model='periodName' type='text' class='form-control' id='periodName' name='periodName' :class='[ errors.periodName ? "alert-danger" : "" ]'>
                    <label v-show='errors.periodName' class='text-danger'>{{ errors.periodName ? errors.periodName[0] : '' }}</label>
                </div>

                <div class='form-group col-md-8'>
                    <label class='col-form-label' for='startDate'>開始日</label>
                    <input v-model='startDate' type='date' class='form-control' id='startDate' name='startDate' :class='[ errors.startDate ? "alert-danger" : "" ]'>
                    <label v-show='errors.startDate' class='text-danger'>{{ errors.startDate ? errors.startDate[0] : '' }}</label>
                </div>

                <div class='form-group col-md-8'>
                    <label class='col-form-label' for='endDate'>終了日</label>
                    <input v-model='endDate' type='date' class='form-control' id='endDate' name='endDate' :class='[ errors.endDate ? "alert-danger" : "" ]'>
                    <label v-show='errors.endDate' class='text-danger'>{{ errors.endDate ? errors.endDate[0] : '' }}</label>
                </div>

                <div class='form-group col-md-8'>
                    <label class='col-form-label' for='status'>ステータス</label>
                    <select v-model='status' class='form-control' id='status' name='status' :class='[ errors.status ? "alert-danger" : "" ]'>
                        <option value='0'>進行中</option>
                        <option value='1'>開始前</option>
                        <option value='2'>期間満了</option>
                    </select>
                    <label v-show='errors.status' class='text-danger'>{{ errors.status ? errors.status[0] : '' }}</label>
                </div>
            </div>
            <div slot='footer' class='form-group col-md-8'>
                <button v-on:click='postEditPeriod()' type='button' class='btn btn-success'>編集</button>
            </div>
        </modal>
    </div>
</template>

<style scoped>
.modal-enter-active, .modal-leave-active {
    transition:opacity 0.5s;
}
.modal-enter, .modal-leave-to {
    opacity: 0;
}
</style>

<script>
    export default {
        props: [
            'periods',
        ],
        mounted() {
            axios.defaults.headers.common = {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content'),
                'Authorization': 'Bearer ' + Laravel.apiToken,
                'Accept' : 'application/json',
            }
        },
        data() {
            return {
                id: '',
                periodName: '',
                startDate: '',
                endDate: '',
                status: '',
                showAddModal: false,
                showEditModal: false,
                message: '',
                errors: []
            }
        },
        methods: {
            statusLabel: function(s) {
                switch (s) {
                    case 0:
                        return '進行中'
                    case 1:
                        return '開始前'
                    case 2:
                        return '期間満了'
                    default:
                        return ''
                }
            },
            closeModal: function() {
                this.showAddModal = false
                this.showEditModal = false

                this.message = ''
                this.errors = []

                this.periodName = ''
                this.startDate = ''
                this.endDate = ''
                this.status = ''
            },
            postPeriod: function() {
                let data = {
                    'periodName' : this.periodName,
                    'startDate'  : this.startDate,
                    'endDate'    : this.endDate,
                    'status'     : this.status,
                }

                axios.post('/api/period/save', data).then(res => {
                    this.toastSuccess('登録しました。')
                    this.message = ''
                    this.errors = []
                    this.showAddModal = false
                    this.periodName = ''
                    this.startDate = ''
                    this.endDate = ''
                    this.status = ''
                }).catch(err => {
                    this.toastError('登録に失敗しました。')
                    this.message = err.response.data.message
                    this.errors = err.response.data.errors
                })
            },
            openEditModal: function(period) {
                this.id = period.id
                this.periodName = period.period_name
                const regex = /\s\d\d:\d\d:\d\d/g
                this.startDate = period.start_date.replace(regex, '')
                this.endDate = period.end_date.replace(regex, '')
                this.status = period.status

                this.showEditModal = true
            },
            postEditPeriod: function() {
                let data = {
                    'id'         : this.id,
                    'periodName' : this.periodName,
                    'startDate'  : this.startDate,
                    'endDate'    : this.endDate,
                    'status'     : this.status,
                }

                axios.post('/api/period/edit', data).then(res => {
                    this.toastSuccess('更新しました。')
                    this.message = ''
                    this.errors = []
                    this.showModal = false
                    this.id = ''
                    this.periodName = ''
                    this.startDate = ''
                    this.endDate = ''
                    this.status = ''
                }).catch(err => {
                    this.toastError('更新に失敗しました。')
                    this.message = err.response.data.message
                    this.errors = err.response.data.errors
                })
            },
            deletePeriod: function(id) {
                let data = {
                    'id': id
                }

                axios.post('/api/period/delete', data).then(res => {
                    this.toastSuccess('削除しました。')
                }).catch(err => {
                    this.toastError('削除に失敗しました。')
                })
            },
            restPeriod: function(id) {
                let data = {
                    'id': id
                }

                axios.post('/api/period/rest', data).then(res => {
                    this.toastSuccess('戻しました。')
                }).catch(err => {
                    this.toastError('戻すのに失敗しました。')
                })
            }
        }
    }
</script>
