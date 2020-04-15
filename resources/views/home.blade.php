@extends('layouts.app')

@section('title', 'ホーム')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">ホーム</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class='table table-bordered table-base'>
                        <thead>
                            <tr>
                                <th class='text-center bg-light wd-10'>被評価者</th>
                                <th class='text-center bg-light wd-10'>シート名</th>
                                <th class='text-center bg-light wd-10'>ステータス</th>
                                <th class='text-center bg-light wd-10'>評価者</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class='text-center middle'>test</td>
                                <td class='text-center middle'>test</td>
                                <td class='text-center middle'>test</td>
                                <td class='text-center middle'>test</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
