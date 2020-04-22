@extends('layouts.app')

@section('title', 'ホーム')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <home-component
                :entities='{{ $entities }}'
                :other-entities='{{ $otherEntities }}'
                :periods='{{ $periods }}'>
            </home-component>
        </div>
    </div>
</div>
@endsection
