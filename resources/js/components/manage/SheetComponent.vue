<template>
    <div class='card'>
        <div class='card-header'>シート
            <button v-on:click='showAddModal = !showAddModal' type='button' class='btn btn-primary float-right'>この評価期間にシートを追加</button>
            <select v-model='periodId' class='form-control float-right mr-1' id='period-dropdown' @change='changePeriod($event)'>
                <option value=''></option>
                <option v-for='(period, idx) in periods' :key='idx' :value='period.id' :selected='period.status == 0 ? "selected" : ""'>{{ period.period_name }}</option>
            </select>
        </div>

        <div class='card-body'>
            <table class='table table-bordered table-base'>
                <thead>
                    <tr>
                        <th class='text-center bg-light'>名前</th>
                        <th class='text-center bg-light'>シート種別</th>
                        <th class='text-center bg-light'>ブロック数</th>
                        <th class='text-center bg-light'>紐付けグループ名</th>
                        <th class='text-center bg-light'></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-show='dispSheet.length === 0'>
                        <td colspan='5'>
                            <span>データがありません。</span>
                        </td>
                    </tr>

                    <tr v-show='dispSheet.length !== 0' v-for='(sheet, index) in dispSheet' :key='index'>
                        <td class='text-center align-middle'>{{ sheet.sheet_name }}</td>
                        <td class='text-center align-middle'>{{ sheetKindLabel(sheet.sheet_kind) }}</td>
                        <td class='text-center align-middle'>{{ sheet.sheet_style }}</td>
                        <td class='text-center align-middle'>{{ groups[sheet.sheet_group-1].group_name }}</td>
                        <td class='text-center align-middle'>
                            <button v-on:click='openEditModal(sheet)' type='button' class='btn btn-outline-success'>編集</button>
                            <button v-show='sheet.del_flg === 0' v-on:click='deletesheet(sheet.id)' type='button' class='btn btn-outline-danger'>削除</button>
                            <button v-show='sheet.del_flg !== 0' v-on:click='restsheet(sheet.id)' type='button' class='btn btn-outline-secondary'>復元</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <modal v-if='showAddModal' @close='closeModal()'>
            <h3 slot='header'>シート登録</h3>
            <div slot='body'>
                <div v-show='message !== ""' class="alert alert-danger">
                    {{ message }}
                </div>

                <div class='form-group col-md-8'>
                    <label class='col-form-label' for='sheetName'>シート名</label>
                    <input v-model='sheetName' type='text' class='form-control' id='sheetName' name='sheetName' :class='[ errors.sheetName ? "alert-danger" : "" ]'>
                    <label v-show='errors.sheetName' class='text-danger'>{{ errors.sheetName ? errors.sheetName[0] : '' }}</label>
                </div>

                <div class='form-group col-md-8'>
                    <label class='col-form-label' for='sheetTitle'>シートの説明1</label>
                    <input v-model='sheetTitle' type='text' class='form-control' id='sheetTitle' name='sheetTitle' :class='[ errors.sheetTitle ? "alert-danger" : "" ]'>
                    <label v-show='errors.sheetTitle' class='text-danger'>{{ errors.sheetTitle ? errors.sheetTitle[0] : '' }}</label>
                </div>

                <div class='form-group col-md-8'>
                    <label class='col-form-label' for='sheetDescription'>シートの説明2</label>
                    <input v-model='sheetDescription' type='text' class='form-control' id='sheetDescription' name='sheetDescription' :class='[ errors.sheetDescription ? "alert-danger" : "" ]'>
                    <label v-show='errors.sheetDescription' class='text-danger'>{{ errors.sheetDescription ? errors.sheetDescription[0] : '' }}</label>
                </div>

                <div class='form-group col-md-8'>
                    <label class='col-form-label' for='sheetKind'>種別</label>
                    <select v-model='sheetKind' class='form-control' id='sheetKind' name='sheetKind' :class='[ errors.sheetKind ? "alert-danger" : "" ]'>
                        <option value='OBJECTIVE'>目標設定シート</option>
                        <option value='PROGRESS'>進捗確認シート</option>
                        <option value='BONUS'>賞与評価シート</option>
                    </select>
                    <label v-show='errors.sheetKind' class='text-danger'>{{ errors.sheetKind ? errors.sheetKind[0] : '' }}</label>
                </div>

                <div class='form-group col-md-8'>
                    <label class='col-form-label' for='sheetStyle'>ブロック数</label>
                    <select v-model='sheetStyle' class='form-control' id='sheetStyle' name='sheetStyle' :class='[ errors.sheetStyle ? "alert-danger" : "" ]'>
                        <option value='0'>0</option>
                        <option value='1'>1</option>
                        <option value='2'>2</option>
                        <option value='3'>3</option>
                        <option value='4'>4</option>
                        <option value='5'>5</option>
                        <option value='6'>6</option>
                        <option value='7'>7</option>
                        <option value='8'>8</option>
                        <option value='9'>9</option>
                        <option value='10'>10</option>
                        <option value='11'>11</option>
                        <option value='12'>12</option>
                    </select>
                    <label v-show='errors.sheetStyle' class='text-danger'>{{ errors.sheetStyle ? errors.sheetStyle[0] : '' }}</label>
                </div>

                <div class='form-group col-md-8'>
                    <label class='col-form-label' for='sheetGroup'>紐付けグループ</label>
                    <select v-model='sheetGroup' class='form-control' id='sheetGroup' name='sheetGroup' :class='[ errors.sheetGroup ? "alert-danger" : "" ]'>
                        <option value=''></option>
                        <option v-show='groups.length !== 0' v-for='(group) in groups' :key='group.id' :value='group.id'>{{ group.group_name }}</option>
                    </select>
                    <label v-show='errors.sheetGroup' class='text-danger'>{{ errors.sheetGroup ? errors.sheetGroup[0] : '' }}</label>
                </div>
            </div>
            <div slot='footer' class='form-group col-md-8'>
                <button v-on:click='postSheet()' type='button' class='btn btn-success'>登録</button>
            </div>
        </modal>

        <modal v-if='showEditModal' @close='closeModal()'>
            <h3 slot='header'>シート編集</h3>
            <div slot='body'>
                <div v-show='message !== ""' class="alert alert-danger">
                    {{ message }}
                </div>

                <div class='form-group col-md-8'>
                    <label class='col-form-label' for='sheetName'>シート名</label>
                    <input v-model='sheetName' type='text' class='form-control' id='sheetName' name='sheetName' :class='[ errors.sheetName ? "alert-danger" : "" ]'>
                    <label v-show='errors.sheetName' class='text-danger'>{{ errors.sheetName ? errors.sheetName[0] : '' }}</label>
                </div>

                <div class='form-group col-md-8'>
                    <label class='col-form-label' for='sheetTitle'>シートの説明1</label>
                    <input v-model='sheetTitle' type='text' class='form-control' id='sheetTitle' name='sheetTitle' :class='[ errors.sheetTitle ? "alert-danger" : "" ]'>
                    <label v-show='errors.sheetTitle' class='text-danger'>{{ errors.sheetTitle ? errors.sheetTitle[0] : '' }}</label>
                </div>

                <div class='form-group col-md-8'>
                    <label class='col-form-label' for='sheetDescription'>シートの説明2</label>
                    <input v-model='sheetDescription' type='text' class='form-control' id='sheetDescription' name='sheetDescription' :class='[ errors.sheetDescription ? "alert-danger" : "" ]'>
                    <label v-show='errors.sheetDescription' class='text-danger'>{{ errors.sheetDescription ? errors.sheetDescription[0] : '' }}</label>
                </div>

                <div class='form-group col-md-8'>
                    <label class='col-form-label' for='sheetKind'>種別</label>
                    <select v-model='sheetKind' class='form-control' id='sheetKind' name='sheetKind' :class='[ errors.sheetKind ? "alert-danger" : "" ]' disabled>
                        <option value='OBJECTIVE'>目標設定シート</option>
                        <option value='PROGRESS'>進捗確認シート</option>
                        <option value='BONUS'>賞与評価シート</option>
                    </select>
                    <label v-show='errors.sheetKind' class='text-danger'>{{ errors.sheetKind ? errors.sheetKind[0] : '' }}</label>
                </div>

                <div class='form-group col-md-8'>
                    <label class='col-form-label' for='sheetStyle'>ブロック数</label>
                    <select v-model='sheetStyle' class='form-control' id='sheetStyle' name='sheetStyle' :class='[ errors.sheetStyle ? "alert-danger" : "" ]'>
                        <option value='0'>0</option>
                        <option value='1'>1</option>
                        <option value='2'>2</option>
                        <option value='3'>3</option>
                        <option value='4'>4</option>
                        <option value='5'>5</option>
                        <option value='6'>6</option>
                        <option value='7'>7</option>
                        <option value='8'>8</option>
                        <option value='9'>9</option>
                        <option value='10'>10</option>
                        <option value='11'>11</option>
                        <option value='12'>12</option>
                    </select>
                    <label v-show='errors.sheetStyle' class='text-danger'>{{ errors.sheetStyle ? errors.sheetStyle[0] : '' }}</label>
                </div>

                <div class='form-group col-md-8'>
                    <label class='col-form-label' for='sheetGroup'>紐付けグループ</label>
                    <select v-model='sheetGroup' class='form-control' id='sheetGroup' name='sheetGroup' :class='[ errors.sheetGroup ? "alert-danger" : "" ]'>
                        <option value=''></option>
                        <option v-show='groups.length !== 0' v-for='(group) in groups' :key='group.id' :value='group.id' :selected='group.id == sheetGroup ? "selected" : ""'>{{ group.group_name }}</option>
                    </select>
                    <label v-show='errors.sheetGroup' class='text-danger'>{{ errors.sheetGroup ? errors.sheetGroup[0] : '' }}</label>
                </div>
            </div>
            <div slot='footer' class='form-group col-md-8'>
                <button v-on:click='postEditSheet()' type='button' class='btn btn-success'>編集</button>
            </div>
        </modal>
    </div>
</template>

<style scoped>
#period-dropdown {
    width: 30% !important;
}
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
            'sheets',
            'groups',
            'periods'
        ],
        mounted() {
            axios.defaults.headers.common = {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content'),
                'Authorization': 'Bearer ' + Laravel.apiToken,
                'Accept' : 'application/json',
            }

            this.periodId = this.periods.find(p => p.status == 0).id
            this.dispSheet = this.sheets.filter(s => s.period_id == this.periodId)
        },
        data() {
            return {
                id: '',
                dispSheet: this.sheets,
                periodId: '',
                sheetName: '',
                sheetTitle: '',
                sheetDescription: '',
                sheetKind: '',
                sheetStyle: '',
                sheetGroup: '',
                showAddModal: false,
                showEditModal: false,
                message: '',
                errors: []
            }
        },
        methods: {
            changePeriod: function(e) {
                this.periodId = e.target.value
                this.dispSheet = this.sheets.filter(s => s.period_id == this.periodId)
            },
            sheetKindLabel: function(s) {
                switch (s) {
                    case 'OBJECTIVE':
                        return '目標設定シート'
                    case 'PROGRESS':
                        return '進捗確認シート'
                    case 'BONUS':
                        return '賞与評価シート'
                    default:
                        return ''
                }
            },
            closeModal: function() {
                this.showAddModal = false
                this.showEditModal = false

                this.message = ''
                this.errors = []

                this.sheetName = ''
                this.sheetTitle = ''
                this.sheetDescription = ''
                this.sheetKind = ''
                this.sheetStyle = ''
                this.sheetGroup = ''
            },
            postSheet: function() {
                let data = {
                    'periodId'         : this.periodId,
                    'sheetName'        : this.sheetName,
                    'sheetTitle'       : this.sheetTitle,
                    'sheetDescription' : this.sheetDescription,
                    'sheetKind'        : this.sheetKind,
                    'sheetStyle'       : this.sheetStyle,
                    'sheetGroup'       : this.sheetGroup,
                }

                axios.post('/api/sheet/save', data).then(res => {
                    this.toastSuccess('登録しました。')
                    this.message = ''
                    this.errors = []
                    this.showAddModal = false
                    this.sheetName = ''
                    this.sheetTitle = ''
                    this.sheetDescription = ''
                    this.sheetKind = ''
                    this.sheetStyle = ''
                    this.sheetGroup = ''
                }).catch(err => {
                    this.toastError('登録に失敗しました。')
                    this.message = err.response.data.message
                    this.errors = err.response.data.errors
                })
            },
            openEditModal: function(sheet) {
                this.id = sheet.id
                this.periodId = this.periodId
                this.sheetName = sheet.sheet_name
                this.sheetTitle = sheet.sheet_title
                this.sheetDescription = sheet.sheet_description
                this.sheetKind = sheet.sheet_kind
                this.sheetStyle = sheet.sheet_style
                this.sheetGroup = sheet.sheet_group

                this.showEditModal = true
            },
            postEditSheet: function() {
                let data = {
                    'id'               : this.id,
                    'periodId'         : this.periodId,
                    'sheetName'        : this.sheetName,
                    'sheetTitle'       : this.sheetTitle,
                    'sheetDescription' : this.sheetDescription,
                    'sheetKind'        : this.sheetKind,
                    'sheetStyle'       : this.sheetStyle,
                    'sheetGroup'       : this.sheetGroup,
                }

                axios.post('/api/sheet/edit', data).then(res => {
                    this.toastSuccess('更新しました。')
                    this.message = ''
                    this.errors = []
                    this.showEditModal = false
                    this.id = ''
                    this.sheetName = ''
                    this.sheetTitle = ''
                    this.sheetDescription = ''
                    this.sheetKind = ''
                    this.sheetStyle = ''
                    this.sheetGroup = ''
                }).catch(err => {
                    this.toastError('更新に失敗しました。')
                    this.message = err.response.data.message
                    this.errors = err.response.data.errors
                })
            },
        }
    }
</script>
