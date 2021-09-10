@extends('layout.app')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-5"><b>Add new results for polling unit</b></h2>

        <div class="row ">
            <div class="col-md-8 border border-1 pt-3 pb-3">
                <form action="{{route('do-pu-add-result', ['pollingUnit' => $pu])}}" method="post">
                    @csrf

                    <div class="mb-3">
                        <label for="entered_by_user" class="form-label">Enter your name</label>
                        <input name="entered_by_user" type="text" class="form-control" id="entered_by_user" required>
                    </div>
                    @foreach($parties as $party)
                        <div class="mb-3">
                            <label for="party-{{$loop->index}}" class="form-label">{{$party}}</label>
                            <input name="{{$party}}" type="number" class="form-control" id="party-{{$loop->index}}" required>
                        </div>
                    @endforeach
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
