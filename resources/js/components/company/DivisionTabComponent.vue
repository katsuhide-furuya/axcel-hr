
<template>
    <div>
       <div class='form-group col-md-8 mb-0'>
            <label class='col-form-label'>部署</label>
        </div>

        <div class='form-group col-md-8'>
            <div v-for='(divName, index) in division' :key='index'>
                <div class='row'>
                    <div class='form-group col-md-8'>
                        <input type='text' class='form-control' name='divisionName[]' :value='divName' @input='changeValue(index, $event)'>
                    </div>
                    
                    <div class='form-group'>
                        <button v-on:click='remove(index)' type='button' class='btn btn-danger'>削除</button>
                    </div>
                </div>
            </div>

            <div class='form-group'>
                <button v-on:click='add()' type='button' class='btn btn-success'>部署を追加</button>
            </div>
        </div>

        <hr>

        <div class='form-group col-md-8'>
            <button v-on:click='postDivision()' type='button' class='btn btn-success'>編集</button>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'divisions',
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
                division: this.divisions.divisions,
            }
        },
        methods: {
            add: function() {
                this.division.push('')
            },
            remove: function(index) {
                if (this.division.length !== 1) this.division.splice(index, 1)
            },
            changeValue(index, e) {
                this.division.splice(index, 1, e.target.value);
            },
            postDivision: function() {
                let data = {
                    'divisionName' : this.division,
                }

                axios.post('/api/division/save', data).then(res => {
                    this.toastSuccess('更新しました。')
                }).catch(err => {
                    this.toastError('更新に失敗しました。')
                })
            }
        }
    }
</script>
