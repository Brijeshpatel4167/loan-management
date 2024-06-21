@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>EMI Details</h1>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <table class="table">
            <thead>
                <tr>
                    <th>Client ID</th>
                    @if ($emiDetails->isNotEmpty())
                        @foreach (array_keys((array) $emiDetails->first()) as $column)
                            @if ($column != 'clientid')
                                <th>{{ $column }}</th>
                            @endif
                        @endforeach
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($emiDetails as $emiDetail)
                    <tr>
                        @foreach ((array) $emiDetail as $value)
                            <td>{{ $value }}</td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
