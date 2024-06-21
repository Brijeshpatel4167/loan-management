@extends('layouts.app')

@section('content')
<div class="container">
    <h1>EMI Details</h1>
    <form action="{{ route('emi.details.process') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary">Process Data</button>
    </form>
</div>
@endsection
