@extends('layouts.app')

@section('content')
    <div class="container">
        <movie-component
            :all_movie="{{json_encode($movie)}}"
            :all_seat="{{json_encode($seat)}}"
            :auth_user="{{json_encode($user)}}"
        >
        </movie-component>
    </div>
@endsection
