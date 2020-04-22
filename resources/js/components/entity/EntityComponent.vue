<template>
    <div class='card'>
        <div class='card-header'>{{ isOthers ? entity.evaluatee.name : '自分' }}のシート / {{entity.sheet.sheet_name}}</div>

        <div class='card-body'>
            <div class='row'>
                <div class='col-md-9'>
                    {{ entity.evaluatee.name }}
                </div>

                <div class='col-md-3'>
                    ステータス: {{ statusLabel(entity.status) }}
                </div>
            </div>

            <hr>

            <div>{{ entity.sheet.sheet_title }}</div>

            <div>
                <div class='row non-margin'>
                    <div class='col-md-9'>
                        {{ entity.sheet.sheet_description }}
                    </div>

                    <div v-show='entity.sheet.sheet_kind === "OBJECTIVE"' class='col-md-3'>
                        達成率: {{ entity.total_progress === null ? '--' : entity.total_progress}}%
                    </div>
                </div>
            </div>

            <hr>

            <div v-show='entity.sheet.sheet_kind === "OBJECTIVE"' v-for='(objective, index) in objectives' :key='`objective-${index}`' class='row non-margin'>
                <div class='col-md-1 no-box'>No.{{ index + 1 }}</div>

                <div class='col-md-11'>
                    <div class='row'>
                        <div class='form-group col-md-3'>
                            <label class='col-form-label'>個人目標</label>
                            <textarea v-model='objectives[index].target' type='text' class='form-control' :readonly='isOthers'/>
                        </div>

                        <div class='form-group col-md-3'>
                            <label class='col-form-label'>期限/基準</label>
                            <textarea v-model='objectives[index].limitAndAchievement' type='text' class='form-control' :readonly='isOthers'/>
                        </div>

                        <div class='form-group col-md-3'>
                            <label class='col-form-label'>振り返り</label>
                            <textarea v-model='objectives[index].retrospective' type='text' class='form-control' :readonly='isOthers'/>
                        </div>

                        <div class='form-group col-md-2'>
                            <label class='col-form-label'>達成率</label>
                            <div class='score-box'>
                                <div class='score-input-area'>
                                    <input v-model='objectives[index].score' type='text' class='form-control score-input' :maxLength=3
                                        :readonly='isOthers'>
                                </div>
                                <div class='percent-area'>%</div>
                            </div>
                        </div>
                    </div>

                    <div class='intarget-box'>
                        <div v-for='(inTarget, idx) in objective.inTarget' :key='`objective-intarge-${idx}`' class='row pl-15'>
                            <div class='form-group col-md-3'>
                                <label class='col-form-label'>中目標</label>
                                <textarea v-model='objectives[index].inTarget[idx].target' type='text' class='form-control' :readonly='isOthers'/>
                            </div>

                            <div class='form-group col-md-3'>
                                <label class='col-form-label'>ステータス</label>
                                <textarea v-model='objectives[index].inTarget[idx].status' type='text' class='form-control' :readonly='isOthers'/>
                            </div>

                            <div class='form-group col-md-3'>
                                <label class='col-form-label'>振り返り</label>
                                <textarea v-model='objectives[index].inTarget[idx].retrospective' type='text' class='form-control' :readonly='isOthers'/>
                            </div>

                            <div class='form-group col-md-2'>
                                <label class='col-form-label'>達成率</label>
                                <div class='score-box'>
                                    <div class='score-input-area'>
                                        <input v-model='objectives[index].inTarget[idx].score' type='text' class='form-control score-input' :maxLength=3
                                            :readonly='isOthers'>
                                    </div>
                                    <div class='percent-area'>%</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class='intarget-button-area'>
                        <div class='row pl-15'>
                            <div class='form-group pl-15'>
                                <v-icon v-show='!isOthers && (entity.status === 0 || entity.status === 1 | entity.status === 2)'
                                    v-on:click='addInTarget(index)' name='plus-circle' scale='2'></v-icon>
                            </div>

                            <div class='form-group pl-15'>
                                <v-icon v-show='!isOthers && (entity.status === 0 || entity.status === 1 | entity.status === 2)'
                                    v-on:click='removeInTarget(index)' name='minus-circle' scale='2'></v-icon>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div v-show='entity.sheet.sheet_kind === "PROGRESS"' v-for='(objective, index) in objectives' :key='`perogress-${index}`' class='row non-margin'>
                <div class='col-md-1 no-box'>No.{{ index + 1 }}</div>

                <div class='col-md-11'>
                    <div class='row'>
                        <div class='form-group col-md-12'>
                            <label class='col-form-label'>進捗詳細</label>
                            <textarea v-model='objectives[index].target' type='text' class='form-control' :readonly='isRater'/>
                        </div>
                    </div>

                    <div class='intarget-box'>
                        <div v-for='(inTarget, idx) in objective.inTarget' :key='`progress-intarget-${idx}`' class='row pl-15'>
                            <div class='form-group col-md-12'>
                                <label class='col-form-label'>評価者コメント</label>
                                <textarea v-model='objectives[index].inTarget[idx].target' type='text' class='form-control' :readonly='!isRater'/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <hr>

            <div v-if='entity.sheet.sheet_kind === "OBJECTIVE"' class='row non-margin'>
                <div class='col-md-6'>
                    <button v-show='!isOthers && (entity.status === 0 || entity.status === 1)' v-on:click='postEditEntity()' type='button' class='btn btn-success'>目標を設定する</button>
                    <button v-show='!isOthers && entity.status === 2' v-on:click='postEditEntity()' type='button' class='btn btn-secondary'>目標を再設定する</button>
                </div>
                <div class='col-md-6'>
                    <button v-show='!isOthers && entity.status === 3' v-on:click='postRetrospective()' type='button' class='btn btn-success float-right'>振り返り完了/評価依頼</button>
                    <button v-show='isRater && entity.status === 2' v-on:click='postApprove()' type='button' class='btn btn-success float-right'>目標を承認する</button>
                    <button v-show='isRater && entity.status === 4' v-on:click='postLastEvaluate()' type='button' class='btn btn-success float-right'>最終評価する</button>
                    <select v-show='isRater && entity.status === 4' v-model='totalScore' class='form-control float-right total-score-dropdown'>
                        <option value='S'>S</option>
                        <option value='A+'>A+</option>
                        <option value='A'>A</option>
                        <option value='B+'>B+</option>
                        <option value='B'>B</option>
                        <option value='C'>C</option>
                        <option value='D'>D</option>
                    </select>
                </div>
            </div>

            <div v-else class='row non-margin'>
                <div class='col-md-6'>
                    <button v-show='!isOthers && (entity.status === 0 || entity.status === 1 | entity.status === 2)' v-on:click='postEditEntity()' type='button' class='btn btn-success'>進捗を更新する</button>
                </div>
                <div class='col-md-6'>
                    <button v-show='isRater' v-on:click='postRaterComment()' type='button' class='btn btn-success float-right'>評価者コメントを更新する</button>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.pl-15 {
    padding-left: 15px;
}
.non-margin {
    margin: 0 !important;
}
.no-box {
    padding: 3rem 0rem 0rem 0rem;
    text-align: center;
    box-shadow: 2px 0px 0px 0px rgba(0,0,0,0.4) inset;
}
.intarget-box {
    box-shadow: 2px 0px 0px 0px rgba(0,0,0,0.4) inset;
}
.score-box {
    display: flex;
    width: 100%;
    background-color: #fff !important;
    background-clip: padding-box !important;
    border: 1px solid #ced4da !important;
    border-radius: 0.25rem !important;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out !important;
}
.score-input-area {
    display: flex;
    min-width: 42px;
}
.score-input {
    display: block !important;
    width: 100% !important;
    height: calc(1.6em + 0.75rem + 2px) !important;
    padding: 0.375rem 0.75rem !important;
    font-size: 0.9rem !important;
    font-weight: 400 !important;
    line-height: 1.6 !important;
    color: #495057 !important;
    border: none !important;
}
.percent-area {
    display: flex;
    min-width: 26px;
    padding: 0.375rem 0.35rem !important;
    border-left: 1px solid #ced4da !important;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out !important;
}
.total-score-dropdown {
    width: 25% !important;
    margin-right: 15px;
}
</style>

<script>
    export default {
        props: [
            'entity',
            'auth',
        ],
        mounted() {
            axios.defaults.headers.common = {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content'),
                'Authorization': 'Bearer ' + Laravel.apiToken,
                'Accept' : 'application/json',
            }

            if (this.auth !== this.entity.evaluatee_id) {
                this.isOthers = true
            }

            if (this.auth === this.entity.rater_id) {
                this.isRater = true
            }

            this.objectives = JSON.parse(this.entity.objective)
        },
        data() {
            return {
                objectives: [],
                totalScore: '',
                isOthers: false,
                isRater: false,
                message: '',
                errors: []
            }
        },
        methods: {
            statusLabel: function(s) {
                switch (s) {
                    case 0:
                        return '未提出'
                    case 1:
                        return '下書き'
                    case 2:
                        return '提出済み/未承認'
                    case 3:
                        return '承認済み/未振り返り'
                    case 4:
                        return '振り返り済み/未最終評価'
                    case 5:
                        return '最終評価済み'
                    default:
                        return ''
                }
            },
            addInTarget: function(i) {
                this.objectives[i].inTarget.push({
                    target: '',
                    status: '',
                    retrospective: '',
                    score: ''
                })
            },
            removeInTarget: function(i) {
                this.objectives[i].inTarget.splice(this.objectives[i].inTarget.length - 1, 1)
            },
            postEditEntity: function() {
                let data = {
                    'id'         : this.entity.id,
                    'objectives' : this.objectives,
                    'status'     : 2
                }

                axios.post('/api/entity/edit', data).then(res => {
                    this.toastSuccess('更新しました。')
                    this.message = ''
                    this.errors = []
                }).catch(err => {
                    this.toastError('更新に失敗しました。')
                    this.message = err.response.data.message
                    this.errors = err.response.data.errors
                })
            },
            postApprove: function() {
                let data = {
                    'id'         : this.entity.id,
                    'objectives' : this.objectives,
                    'status'     : 3
                }

                axios.post('/api/entity/approve', data).then(res => {
                    this.toastSuccess('承認しました。')
                    this.message = ''
                    this.errors = []
                }).catch(err => {
                    this.toastError('承認に失敗しました。')
                    this.message = err.response.data.message
                    this.errors = err.response.data.errors
                })
            },
            postRetrospective: function() {
                let totalProgress = 0
                if (this.entity.sheet.sheet_kind === 'OBJECTIVE') {
                    let sumScore = 0
                    this.objectives.forEach(o => {
                        sumScore += parseInt(o.score)
                    })
                    totalProgress = parseInt(sumScore / this.objectives.length)
                }

                let data = {
                    'id'            : this.entity.id,
                    'objectives'    : this.objectives,
                    'status'        : 4,
                    'totalProgress' : totalProgress
                }

                axios.post('/api/entity/restrospective', data).then(res => {
                    this.toastSuccess('振り返り更新しました。')
                    this.message = ''
                    this.errors = []
                }).catch(err => {
                    this.toastError('振り返り更新に失敗しました。')
                    this.message = err.response.data.message
                    this.errors = err.response.data.errors
                })
            },
            postLastEvaluate: function() {
                let data = {
                    'id'         : this.entity.id,
                    'objectives' : this.objectives,
                    'status'     : 5,
                    'totalScore' : this.totalScore
                }

                axios.post('/api/entity/lastEvaluate', data).then(res => {
                    this.toastSuccess('最終評価完了しました。')
                    this.message = ''
                    this.errors = []
                }).catch(err => {
                    this.toastError('最終評価に失敗しました。')
                    this.message = err.response.data.message
                    this.errors = err.response.data.errors
                })
            },
            postRaterComment: function() {
                let data = {
                    'id'         : this.entity.id,
                    'objectives' : this.objectives,
                    'status'     : 2
                }

                axios.post('/api/entity/raterComment', data).then(res => {
                    this.toastSuccess('コメントを更新しました。')
                    this.message = ''
                    this.errors = []
                }).catch(err => {
                    this.toastError('コメントの更新に失敗しました。')
                    this.message = err.response.data.message
                    this.errors = err.response.data.errors
                })
            }
        }
    }
</script>
