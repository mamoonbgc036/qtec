@extends('dashboardLayout')
@section('dashboard')
<div class="row">
    @if(session('alart'))
    <div class="alert alert-danger">
        {{ session('alart') }}
    </div>
    @endif
    <div class="col-md-12 stretch-card">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title text-center">Update Shorten Url</h2>
                <form action="{{ route('url.update', $url_edit->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label class="form-label">Long Url</label>
                                <input type="text" name="long_url" value="{{ $url_edit->long_url }}" class="form-control" placeholder="Enter Long Url">
                            </div>
                            @error('long_url')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div><!-- Col -->
                    </div><!-- Row -->
                    <button type="submit" class="btn btn-primary submit">Shorten</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection