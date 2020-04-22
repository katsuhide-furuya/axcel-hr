@extends('layouts.app')

@section('title', '企業情報')

@section('content')
<div class='container'>
    <div class='row justify-content-center'>
        <div class='col-md-12'>
            <company-component
                :company-info='{{ $companyInfo }}'
                :job-category='{{ $jobCategory }}'
                :posts='{{ $posts }}'
                :recruit-type='{{ $recruitType }}'
                :emp-status='{{ $empStatus }}'
                :divisions='{{ $divisions }}'>
            </company-component>
        </div>
    </div>
</div>
@endsection
