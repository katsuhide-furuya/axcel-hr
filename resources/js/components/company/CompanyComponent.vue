<template>
    <div class='card'>
        <div class='card-header'>
            <a v-on:click='selected = 1' :class='[ selected === 1 ? "selected" : "" ]' class='mr-3'>企業</a>
            <a v-on:click='selected = 2' :class='[ selected === 2 ? "selected" : "" ]' class='mr-3'>組織</a>
            <a v-on:click='selected = 3' :class='[ selected === 3 ? "selected" : "" ]' class='mr-3'>部署</a>
        </div>

        <div class='card-body'>
            <div v-show='selected === 1'>
                <company-tab-component :company-info='{ companyInfo }'></company-tab-component>
            </div>

            <div v-show='selected === 2'>
                <organization-tab-component
                    :job-category='{ jobCategory }'
                    :posts='{ posts }'
                    :recruit-type='{ recruitType }'
                    :emp-status='{ empStatus }'></organization-tab-component>
            </div>

            <div v-show='selected === 3'>
                <division-tab-component :divisions='{ divisions }'></division-tab-component>
            </div>
        </div>
    </div>
</template>

<style scoped>
a.selected {
    border-bottom: 1px solid rgba(0, 0, 0, 0.5) !important;
    cursor: pointer !important;
}
</style>

<script>
    export default {
        props: [
            'companyInfo',
            'jobCategory',
            'posts',
            'recruitType',
            'empStatus',
            'divisions'
        ],
        data() {
            return {
                selected: 1
            }
        },
    }
</script>
