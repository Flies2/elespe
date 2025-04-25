@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-xl mb-4">Edit Kategori</h1>
    <form action="{{ route('kategori.update', $kategori) }}" method="POST">
        @method('PUT')
        @include('kategori.form', ['submit' => 'Update'])
    </form>
</div>
@endsection
