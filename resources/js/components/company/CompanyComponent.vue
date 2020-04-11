<template>
    <div class='card'>
        <div class='card-header'>
            <a v-on:click='selected=1' v-bind:class='[ selected === 1 ? "selected" : "" ]' class='mr-3'>Company</a>
            <a v-on:click='selected=2' v-bind:class='[ selected === 2 ? "selected" : "" ]' class='mr-3'>Organization</a>
            <a v-on:click='selected=3' v-bind:class='[ selected === 3 ? "selected" : "" ]' class='mr-3'>Division</a>
        </div>

        <div class='card-body'>
            <div v-show='selected === 1'>
                <company-tab-component v-bind:company-info='{ companyInfo }'></company-tab-component>
            </div>

            <div v-show='selected === 2'>
                <organization-tab-component
                    v-bind:job-category='{ jobCategory }'
                    v-bind:posts='{ posts }'
                    v-bind:recruit-type='{ recruitType }'
                    v-bind:emp-status='{ empStatus }'></organization-tab-component>
            </div>

            <div v-show='selected === 3'>
                <division-tab-component v-bind:divisions='{ divisions }'></division-tab-component>
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
        props:[
            'companyInfo',
            'jobCategory',
            'posts',
            'recruitType',
            'empStatus',
            'divisions'
        ],
        data(){
            return {
                selected: 1
            }
        },
    }
</script>
