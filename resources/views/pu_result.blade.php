@extends('layout.app')


@section('content')

    <div class="container mt-5">
        <div class="d-flex justify-content-between">
            <h3 class="text-uppercase"><b>Results page for polling units</b></h3>
            <a href="{{url()->previous()}}" class="btn btn-dark btn-md ps-5 pe-5">&larr; Go back</a>
        </div>
        <hr>
        <div>
            <p><b class="bg-dark text-white pt-1 pb-1 ps-3 pe-3">PU Name</b> : {{$pu->polling_unit_name}}</p>
            <p><b class="bg-dark text-white pt-1 pb-1 ps-3 pe-3">PU Number</b> : {{$pu->polling_unit_number}}</p>
            <p><b class="bg-dark text-white pt-1 pb-1 ps-3 pe-3">PU Latitude</b> : {{$pu->lat}}</p>
            <p><b class="bg-dark text-white pt-1 pb-1 ps-3 pe-3">PU Longitude</b> : {{$pu->long}}</p>
        </div>
{{--        {{$pu->links('vendor.pagination.bootstrap-4')}}--}}
        <table class="table table-hover table-striped table-bordered">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Party</th>
                <th scope="col">Party Score</th>
            </tr>
            </thead>
            <tbody>
            @foreach($pu->announcedPuResult as $puResult)
                <tr>
                    <th scope="row">{{$puResult->id}}</th>
                    <td>{{$puResult->party_abbreviation}}</td>
                    <td>{{$puResult->party_score}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
