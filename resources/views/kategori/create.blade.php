@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-xl mb-4">Tambah Kategori</h1>
    <form action="{{ route('kategori.store') }}" method="POST">
        @include('kategori.form', ['submit' => 'Tambah'])
    </form>
</div>
@endsection
