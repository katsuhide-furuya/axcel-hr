
<template>
    <div>
        <div class='form-group col-md-8 mb-0'>
            <label v-on:click='selected = 1' :class='[ selected === 1 ? "selected" : "" ]' class='col-form-label'>職種</label>
        </div>

        <!-- 職種 -->
        <div v-show='selected === 1' class='form-group col-md-8'>
            <div v-for='(job, index) in jobCate' :key='index'>
                <div class='row'>
                    <div class='form-group col-md-8'>
                        <input type='text' class='form-control' name='jobCategoryName[]' :value='job' @input='changeValue(index, $event)'>
                    </div>
                    
                    <div class='form-group'>
                        <button v-on:click='remove(index)' type='button' class='btn btn-danger'>削除</button>
                    </div>
                </div>
            </div>

            <div class='form-group'>
                <button v-on:click='add()' type='button' class='btn btn-success'>職種を追加</button>
            </div>
        </div>

        <hr>

        <div class='form-group col-md-8 mb-0'>
            <label v-on:click='selected = 2' :class='[ selected === 2 ? "selected" : "" ]' class='col-form-label'>役職</label>
        </div>

        <!-- 役職 -->
        <div v-show='selected === 2' class='form-group col-md-8'>
            <div v-for='(name, index) in post' :key='index'>
                <div class='row'>
                    <div class='form-group col-md-8'>
                        <input type='text' class='form-control' name='postName[]' :value='name' @input='changeValue(index, $event)'>
                    </div>
                    
                    <div class='form-group'>
                        <button v-on:click='remove(index)' type='button' class='btn btn-danger'>削除</button>
                    </div>
                </div>
            </div>

            <div class='form-group'>
                <button v-on:click='add()' type='button' class='btn btn-success'>役職を追加</button>
            </div>
        </div>

        <hr>

        <div class='form-group col-md-8 mb-0'>
            <label v-on:click='selected = 3' :class='[ selected === 3 ? "selected" : "" ]' class='col-form-label'>採用区分</label>
        </div>

        <!-- 採用区分 -->
        <div v-show='selected === 3' class='form-group col-md-8'>
            <div v-for='(type, index) in recruit' :key='index'>
                <div class='row'>
                    <div class='form-group col-md-8'>
                        <input type='text' class='form-control' name='recruitTypeName[]' :value='type' @input='changeValue(index, $event)'>
                    </div>
                    
                    <div class='form-group'>
                        <button v-on:click='remove(index)' type='button' class='btn btn-danger'>削除</button>
                    </div>
                </div>
            </div>

            <div class='form-group'>
                <button v-on:click='add()'  type='button' class='btn btn-success'>採用区分を追加</button>
            </div>
        </div>

        <hr>

        <div class='form-group col-md-8 mb-0'>
            <label v-on:click='selected = 4' :class='[ selected === 4 ? "selected" : "" ]' class='col-form-label'>雇用形態</label>
        </div>

        <!-- 雇用形態 -->
        <div v-show='selected === 4' class='form-group col-md-8'>
            <div v-for='(stat, index) in empStat' :key='index'>
                <div class='row'>
                    <div class='form-group col-md-8'>
                        <input type='text' class='form-control' name='empStatusName[]' :value='stat' @input='changeValue(index, $event)'>
                    </div>
                    
                    <div class='form-group'>
                        <button v-on:click='remove(index)' type='button' class='btn btn-danger'>削除</button>
                    </div>
                </div>
            </div>

            <div class='form-group'>
                <button v-on:click='add()' type='button' class='btn btn-success'>雇用形態を追加</button>
            </div>
        </div>

        <hr>
        <div class='form-group col-md-8'>
            <button v-on:click='postOrganization()' type='button' class='btn btn-success'>編集</button>
        </div>
    </div>
</template>

<style scoped>
.ac-menu {
    cursor: pointer;
}
</style>

<script>
    export default {
        props: [
            'jobCategory',
            'posts',
            'recruitType',
            'empStatus',
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
                selected: 0,
                jobCate: this.jobCategory.jobCategory,
                post: this.posts.posts,
                recruit: this.recruitType.recruitType,
                empStat: this.empStatus.empStatus,
            }
        },
        methods: {
            add: function() {
                switch (this.selected) {
                    case 1:
                        this.jobCate.push('')
                        break
                    case 2:
                        this.post.push('')
                        break
                    case 3:
                        this.recruit.push('')
                        break
                    case 4:
                        this.empStat.push('')
                        break
                    default:
                        break
                }
            },
            remove: function(index) {
                switch (this.selected) {
                    case 1:
                        if (this.jobCate.length !== 1) this.jobCate.splice(index, 1)
                        break
                    case 2:
                        if (this.post.length !== 1) this.post.splice(index, 1)
                        break
                    case 3:
                        if (this.recruit.length !== 1) this.recruit.splice(index, 1)
                        break
                    case 4:
                        if (this.empStat.length !== 1) this.empStat.splice(index, 1)
                        break
                    default:
                        break
                }
            },
            changeValue(index, e) {
                switch (this.selected) {
                    case 1:
                        this.jobCate.splice(index, 1, e.target.value);
                        break;
                    case 2:
                        this.post.splice(index, 1, e.target.value);
                        break;
                    case 3:
                        this.recruit.splice(index, 1, e.target.value);
                        break;
                    case 4:
                        this.empStat.splice(index, 1, e.target.value);
                        break;
                    default:
                        break;
                }
            },
            postOrganization: function() {
                let data = {
                    'jobCategoryName' : this.jobCate,
                    'postName'        : this.post,
                    'recruitTypeName' : this.recruit,
                    'empStatusName'   : this.empStat,
                }

                axios.post('/api/organization/save', data).then(res => {
                    this.toastSuccess('更新しました。')
                }).catch(err => {
                    this.toastError('更新に失敗しました。')
                })
            }
        }
    }
</script>
