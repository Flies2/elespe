@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-xl mb-4">Edit Item</h1>
    <form action="{{ route('item.update', $item) }}" method="POST">
        @method('PUT')
        @include('item.form', ['submit' => 'Update'])
    </form>
</div>
@endsection
