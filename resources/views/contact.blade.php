@extends('layouts.app') <!-- This will fetch the headers and footers, which is in resources/views/layouts/app.blade.php -->


@section('content') <!-- this will fill in @yield('content') thats on layouts/app.blade.php -->
    <h1>Contact Page</h1>
    
    @if (count($people)) <!-- If there are people, then we'll list them out -->
        <ul>
        @foreach($people as $person)
            <li>{{$person}}</li>
        @endforeach
        </ul>
    @endif

@section('footer')
    <!-- <script>alert('Hello Visitors')</script> -->
    
@stop