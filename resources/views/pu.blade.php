@extends('layout.app')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-5">Available polling units</h1>
        @if(count($pus) > 0)
            {{$pus->links('vendor.pagination.bootstrap-4')}}
            <table class="table table-hover table-striped table-bordered">
                <thead>
                <tr>
                    <th scope="col">PU ID</th>
                    <th scope="col">PU Number</th>
                    <th scope="col">PU Name</th>
                    <th scope="col">Pu Description</th>
                    <th scope="col">Lat</th>
                    <th scope="col">Long</th>
                    <th scope="col">*</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($pus as $pu)
                        <tr>
                            <th scope="row">{{$pu->id}}</th>
                            <td>{{$pu->polling_unit_number}}</td>
                            <td>{{$pu->polling_unit_name}}</td>
                            <td>{{($pu->polling_unit_description) ? $pu->polling_unit_description : "---"}}</td>
                            <td>{{$pu->lat}}</td>
                            <td>{{$pu->long}}</td>
                            <td class="text-center"><a href="{{route('pu-result', ['pollingUnit' => $pu])}}" class="btn btn-sm btn-dark">See results &rarr;</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
