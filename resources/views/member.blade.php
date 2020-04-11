@extends('layouts.app')

@section('title', 'Members')

@section('content')
<div class='container'>
    <div class='row justify-content-center'>
        <div class='col-md-12'>
            <member-component
                v-bind:users='{{ $users }}'
                v-bind:job-categories='{{ $jobCategories }}'
                v-bind:posts='{{ $posts }}'
                v-bind:recruit-type='{{ $recruitType }}'
                v-bind:emp-status='{{ $empStatus }}'
                v-bind:divisions='{{ $divisions }}'>
            </member-component>
        </div>
    </div>
</div>
@endsection
