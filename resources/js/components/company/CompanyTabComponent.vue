<template>
    <div>
        <div v-show='message !== ""' class="alert alert-danger">
            {{ message }}
        </div>

        <div class='form-group col-md-8'>
            <label class='col-form-label' for='companyName'>企業名</label>
            <input v-model='companyName' type='text' class='form-control' id='companyName' name='companyName' :class='[ errors.companyName ? "alert-danger" : "" ]'>
            <label v-show='errors.companyName' class='text-danger'>{{ errors.companyName ? errors.companyName[0] : '' }}</label>
        </div>

        <div class='form-group col-md-8'>
            <label class='col-form-label' for='companyTel'>電話番号</label>
            <input v-model='companyTel' type='text' class='form-control' id='companyTel' name='companyTel' :class='[ errors.companyTel ? "alert-danger" : "" ]'>
            <label v-show='errors.companyTel' class='text-danger'>{{ errors.companyTel ? errors.companyTel[0] : '' }}</label>
        </div>

        <div class='form-group col-md-8'>
            <label class='col-form-label' for='companyMail'>メールアドレス</label>
            <input v-model='companyMail' type='text' class='form-control' id='companyMail' name='companyMail' :class='[ errors.companyMail ? "alert-danger" : "" ]'>
            <label v-show='errors.companyMail' class='text-danger'>{{ errors.companyMail ? errors.companyMail[0] : '' }}</label>
        </div>

        <hr>

        <div class='form-group col-md-8'>
            <label class='col-form-label' for='companyZipcode'>郵便番号</label>
            <input v-model='companyZipcode' type='text' class='form-control' id='companyZipcode' name='companyZipcode' :class='[ errors.companyZipcode ? "alert-danger" : "" ]'>
            <label v-show='errors.companyZipcode' class='text-danger'>{{ errors.companyZipcode ? errors.companyZipcode[0] : '' }}</label>
        </div>

        <div class='form-group col-md-8'>
            <label class='col-form-label' for='companyState'>都道府県</label>
            <select v-model='companyState' class='form-control' id='companyState' name='companyState' :class='[ errors.companyState ? "alert-danger" : "" ]'>
                <optgroup label='北海道・東北'>
                    <option value='北海道'>北海道</option>
                    <option value='青森県'>青森県</option>
                    <option value='秋田県'>秋田県</option>
                    <option value='岩手県'>岩手県</option>
                    <option value='山形県'>山形県</option>
                    <option value='宮城県'>宮城県</option>
                    <option value='福島県'>福島県</option>
                </optgroup>
                <optgroup label='甲信越・北陸'>
                    <option value='山梨県'>山梨県</option>
                    <option value='長野県'>長野県</option>
                    <option value='新潟県'>新潟県</option>
                    <option value='富山県'>富山県</option>
                    <option value='石川県'>石川県</option>
                    <option value='福井県'>福井県</option>
                </optgroup>
                <optgroup label='関東'>
                    <option value='茨城県'>茨城県</option>
                    <option value='栃木県'>栃木県</option>
                    <option value='群馬県'>群馬県</option>
                    <option value='埼玉県'>埼玉県</option>
                    <option value='千葉県'>千葉県</option>
                    <option value='東京都'>東京都</option>
                    <option value='神奈川県'>神奈川県</option>
                </optgroup>
                <optgroup label='東海'>
                    <option value='愛知県'>愛知県</option>
                    <option value='静岡県'>静岡県</option>
                    <option value='岐阜県'>岐阜県</option>
                    <option value='三重県'>三重県</option>
                </optgroup>
                <optgroup label='関西'>
                    <option value='大阪府'>大阪府</option>
                    <option value='兵庫県'>兵庫県</option>
                    <option value='京都府'>京都府</option>
                    <option value='滋賀県'>滋賀県</option>
                    <option value='奈良県'>奈良県</option>
                    <option value='和歌山県'>和歌山県</option>
                </optgroup>
                <optgroup label='中国'>
                    <option value='岡山県'>岡山県</option>
                    <option value='広島県'>広島県</option>
                    <option value='鳥取県'>鳥取県</option>
                    <option value='島根県'>島根県</option>
                    <option value='山口県'>山口県</option>
                </optgroup>
                <optgroup label='四国'>
                    <option value='徳島県'>徳島県</option>
                    <option value='香川県'>香川県</option>
                    <option value='愛媛県'>愛媛県</option>
                    <option value='高知県'>高知県</option>
                </optgroup>
                <optgroup label='九州・沖縄'>
                    <option value='福岡県'>福岡県</option>
                    <option value='佐賀県'>佐賀県</option>
                    <option value='長崎県'>長崎県</option>
                    <option value='熊本県'>熊本県</option>
                    <option value='大分県'>大分県</option>
                    <option value='宮崎県'>宮崎県</option>
                    <option value='鹿児島県'>鹿児島県</option>
                    <option value='沖縄県'>沖縄県</option>
                </optgroup>
            </select>
            <label v-show='errors.companyState' class='text-danger'>{{ errors.companyState ? errors.companyState[0] : '' }}</label>
        </div>
    
        <div class='form-group col-md-8'>
            <label class='col-form-label' for='companyCity'>市町区村</label>
            <input v-model='companyCity' type='text' class='form-control' id='companyCity' name='companyCity' :class='[ errors.companyCity ? "alert-danger" : "" ]'>
            <label v-show='errors.companyCity' class='text-danger'>{{ errors.companyCity ? errors.companyCity[0] : '' }}</label>
        </div>

        <div class='form-group col-md-8'>
            <label class='col-form-label' for='companyAddress1'>丁目・番地</label>
            <input v-model='companyAddress1' type='text' class='form-control' id='companyAddress1' name='companyAddress1' :class='[ errors.companyAddress1 ? "alert-danger" : "" ]'>
            <label v-show='errors.companyAddress1' class='text-danger'>{{ errors.companyAddress1 ? errors.companyAddress1[0] : '' }}</label>
        </div>

        <div class='form-group col-md-8'>
            <label class='col-form-label' for='companyAddress2'>建物名・部屋番号</label>
            <input v-model='companyAddress2' type='text' class='form-control' id='companyAddress2' name='companyAddress2' :class='[ errors.companyAddress2 ? "alert-danger" : "" ]'>
            <label v-show='errors.companyAddress2' class='text-danger'>{{ errors.companyAddress2 ? errors.companyAddress2[0] : '' }}</label>
        </div>

        <hr>

        <div class='form-group col-md-8'>
            <button v-on:click='postCompany()' type='button' class='btn btn-success'>編集</button>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'companyInfo'
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
                companyName: this.companyInfo.companyInfo.companyName,
                companyTel: this.companyInfo.companyInfo.companyTel,
                companyMail: this.companyInfo.companyInfo.companyMail,
                companyZipcode: this.companyInfo.companyInfo.companyZipcode,
                companyState: this.companyInfo.companyInfo.companyState,
                companyCity: this.companyInfo.companyInfo.companyCity,
                companyAddress1: this.companyInfo.companyInfo.companyAddress1,
                companyAddress2: this.companyInfo.companyInfo.companyAddress2,
                message: '',
                errors: []
            }
        },
        methods: {
            postCompany: function() {
                let data = {
                    'companyName'     : this.companyName,
                    'companyTel'      : this.companyTel,
                    'companyMail'     : this.companyMail,
                    'companyZipcode'  : this.companyZipcode,
                    'companyState'    : this.companyState,
                    'companyCity'     : this.companyCity,
                    'companyAddress1' : this.companyAddress1,
                    'companyAddress2' : this.companyAddress2,
                }

                axios.post('/api/company/save', data).then(res => {
                    this.toastSuccess('更新しました。')
                    this.message = ''
                    this.errors = []
                }).catch(err => {
                    this.toastError('更新に失敗しました。')
                    this.message = err.response.data.message
                    this.errors = err.response.data.errors
                })
            }
        }
    }
</script>
