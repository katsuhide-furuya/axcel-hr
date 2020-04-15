@extends('layouts.app')

@section('title', '評価期間')

@section('content')
<div class='container'>
    <div class='row justify-content-center'>
        <div class='col-md-12'>
            <period-component v-bind:periods='{{ $periods }}'></period-component>
        </div>
    </div>
</div>
@endsection
