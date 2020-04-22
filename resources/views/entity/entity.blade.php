@extends('layouts.app')

@section('title', 'シート')

@section('content')
<div class='container'>
    <div class='row justify-content-center'>
        <div class='col-md-12'>
            <entity-component
                :entity='{{ $entity }}'
                :auth='{{ Auth::user()->id }}'>
            </entity-component>
        </div>
    </div>
</div>
@endsection
