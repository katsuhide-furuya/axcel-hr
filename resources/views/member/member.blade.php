@extends('layouts.app')

@section('title', 'メンバー')

@section('content')
<div class='container'>
    <div class='row justify-content-center'>
        <div class='col-md-12'>
            <member-component
                :users='{{ $users }}'
                :job-categories='{{ $jobCategories }}'
                :posts='{{ $posts }}'
                :recruit-type='{{ $recruitType }}'
                :emp-status='{{ $empStatus }}'
                :divisions='{{ $divisions }}'>
            </member-component>
        </div>
    </div>
</div>
@endsection
