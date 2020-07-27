<template>
    <div class='card'>
        <div class='card-header'>
            <a v-on:click='selected = 1' :class='[ selected === 1 ? "selected" : "" ]' class='mr-3 pointer'>自分のシート</a>
            <a v-on:click='selected = 2' :class='[ selected === 2 ? "selected" : "" ]' class='mr-3 pointer'>他の閲覧可能なシート</a>
            <select v-model='periodId' class='form-control float-right' id='period-dropdown' @change='changePeriod($event)'>
                <option value=''></option>
                <option v-for='(period, idx) in periods' :key='idx' :value='period.id' :selected='period.status == 0 ? "selected" : ""'>{{ period.period_name }}</option>
            </select>
        </div>

        <div class='card-body'>
            <div v-show='selected === 1'>
                <div>自分のシートまたは自分が評価者のシートが表示されます。</div>
                <table class='table table-bordered table-base'>
                    <thead>
                        <tr>
                            <th class='text-center bg-light'>被評価者</th>
                            <th class='text-center bg-light'>シート名</th>
                            <th class='text-center bg-light'>ステータス</th>
                            <th class='text-center bg-light'>評価者</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-show='dispEntities.length === 0'>
                            <td colspan='4'>
                                <span>データがありません。</span>
                            </td>
                        </tr>

                        <tr v-show='dispEntities.length !== 0' v-for='(entity, index) in dispEntities' :key='`entity-${index}`'>
                            <td class='text-center align-middle'>{{ entity.evaluatee.name }}</td>
                            <td class='text-center align-middle'><a :href='`/entity/${entity.id}`'>{{ entity.sheet.sheet_name }}</a></td>
                            <td class='text-center align-middle'>{{ statusLabel(entity.status) }}</td>
                            <td class='text-center align-middle'>{{ entity.rater.name }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div v-show='selected === 2'>
                <div>他の閲覧可能なシートが表示されます。</div>
                <table class='table table-bordered table-base'>
                    <thead>
                        <tr>
                            <th class='text-center bg-light'>被評価者</th>
                            <th class='text-center bg-light'>シート名</th>
                            <th class='text-center bg-light'>ステータス</th>
                            <th class='text-center bg-light'>評価者</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-show='dispEntitiesOther.length === 0'>
                            <td colspan='4'>
                                <span>データがありません。</span>
                            </td>
                        </tr>

                        <tr v-show='dispEntitiesOther.length !== 0' v-for='(entity, index) in dispEntitiesOther' :key='`other-entity-${index}`'>
                            <td class='text-center align-middle'>{{ entity.evaluatee.name }}</td>
                            <td class='text-center align-middle'><a :href='`/entity/${entity.id}`'>{{ entity.sheet.sheet_name }}</a></td>
                            <td class='text-center align-middle'>{{ statusLabel(entity.status) }}</td>
                            <td class='text-center align-middle'>{{ entity.rater.name }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<style scoped>
a.selected {
    border-bottom: 1px solid rgba(0, 0, 0, 0.5) !important;
}
a.pointer {
    cursor: pointer !important;
}
#period-dropdown {
    width: 30% !important;
}
</style>

<script>
    export default {
        props: [
            'entities',
            'otherEntities',
            'periods'
        ],
        mounted() {
            this.periodId = this.periods.find(p => p.status == 0).id
            this.dispEntities = this.entities.filter(e => e.sheet.period_id == this.periodId)
        },
        data() {
            return {
                selected: 1,
                periodId: '',
                dispEntities: this.entities,
                dispEntitiesOther: this.otherEntities,
            }
        },
        methods: {
            changePeriod: function(e) {
                this.periodId = e.target.value
                this.dispEntities = this.entities.filter(e => e.sheet.period_id == this.periodId)
                this.dispEntitiesOther = this.otherEntities.filter(e => e.sheet.period_id == this.periodId)
            },
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
        }
    }
</script>
