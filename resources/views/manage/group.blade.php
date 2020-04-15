@extends('layouts.app')

@section('title', '紐付けグループ')

@section('content')
<div class='container'>
    <div class='row justify-content-center'>
        <div class='col-md-12'>
            <group-component
                v-bind:groups='{{ $groups }}'
                v-bind:users='{{ $users }}'>
            </group-component>
        </div>
    </div>
</div>
@endsection
