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
                                <th>Action</th>
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
                                <td>
                                    <a href="{{ route('url.edit', $short_url) }}" class="col-sm-6 col-md-4 col-lg-3"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                        </svg>
                                    </a>
                                </td>
                                <td>
                                    <form action="{{ route('url.destroy', $short_url->id ) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                                <line x1="14" y1="11" x2="14" y2="17"></line>
                                            </svg></button>
                                    </form>
                                </td>
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