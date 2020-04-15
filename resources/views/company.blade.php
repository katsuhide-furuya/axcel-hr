@extends('layouts.app')

@section('title', '企業情報')

@section('content')
<div class='container'>
    <div class='row justify-content-center'>
        <div class='col-md-12'>
            <company-component
                v-bind:company-info='{{ $companyInfo }}'
                v-bind:job-category='{{ $jobCategory }}'
                v-bind:posts='{{ $posts }}'
                v-bind:recruit-type='{{ $recruitType }}'
                v-bind:emp-status='{{ $empStatus }}'
                v-bind:divisions='{{ $divisions }}'>
            </company-component>
        </div>
    </div>
</div>
@endsection
