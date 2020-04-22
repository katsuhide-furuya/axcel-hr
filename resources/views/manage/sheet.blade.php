@extends('layouts.app')

@section('title', 'シート')

@section('content')
<div class='container'>
    <div class='row justify-content-center'>
        <div class='col-md-12'>
            <sheet-component
                :sheets='{{ $sheets }}'
                :groups='{{ $groups }}'
                :periods='{{ $periods }}'>
            </sheet-component>
        </div>
    </div>
</div>
@endsection
