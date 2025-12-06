@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <h1 class="text-2xl font-bold mb-4">MEMBER</h1>

    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda cum cumque dicta eius, facilis harum impedit iste libero magnam nam nihil perferendis, quo ratione sint, ut vel voluptatem voluptates voluptatum?</p>

    <div>
<x-nav-link 
    href="/users" 
    :active="request()->routeIs('users')"
    :icon="'<svg class=\'w-5 h-5\' fill=\'currentColor\' viewBox=\'0 0 20 20\'><path d=\'M10 0C4.486 0 0 4.486 0 10s4.486 10 10 10 10-4.486 10-10S15.514 0 10 0zm0 3a3 3 0 110 6 3 3 0 010-6zm0 14c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 2 0 5.97 1.09 6 3.08C14.71 15.72 12.5 17 10 17z\'/></svg>'"
>
    Users
</x-nav-link>

    </div>
@endsection
