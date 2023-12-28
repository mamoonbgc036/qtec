@extends('dashboardLayout')
@section('dashboard')
<div class="row">
    @if(session('success'))
    <div class="alert alert-danger">
        {{ session('success') }}
    </div>
    @endif
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title text-center">Url Map</h4>
                <a href="{{ route('dashboard.shorten') }}" class="btn btn-sm btn-success">Short Url</a>
                <div class="table-responsive pt-3">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Long Url</th>
                                <th>Short Url</th>
                                <th>Click</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(empty($short_url_lists))
                            <tr>
                                No product uploaded
                            </tr>
                            @else
                            @foreach($short_url_lists as $short_url)
                            <tr>
                                <td>{{ $short_url->id }}</td>
                                <td>{{ $short_url->long_url }}</td>
                                <td>{{ $short_url->short_url }}</td>
                                <td>{{ $short_url->click }}</td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection