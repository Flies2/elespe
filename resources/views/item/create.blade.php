@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-xl mb-4">Tambah Item</h1>
    <form action="{{ route('item.store') }}" method="POST">
        @include('item.form', ['submit' => 'Tambah'])
    </form>
</div>
@endsection