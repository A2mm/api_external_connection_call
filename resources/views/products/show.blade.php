@extends('layouts.app')

@section('content')
    <h1 class="mt-4">{{ $product->title }}</h1>
    <p>{{ $product->description }}</p>
    <p class="font-weight-bold">Price: ${{ $product->price }}</p>
    <a href="{{ route('products.index') }}" class="btn btn-secondary">Back to List</a>
@endsection
