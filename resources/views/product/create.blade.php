@extends('dashboardLayout')
@section('dashboard')
<div class="row">
    <div class="col-md-12 stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Form Grid</h6>
                <form action="{{ route('product.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label class="form-label">Product Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Enter first name">
                            </div>
                            @error('name')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div><!-- Col -->
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label class="form-label">Quantity</label>
                                <input type="text" name="quantity" class="form-control" placeholder="Enter last name">
                            </div>
                            @error('quantity')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div><!-- Col -->
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label class="form-label">Price</label>
                                <input type="text" name="price" class="form-control" placeholder="Enter last name">
                            </div>
                            @error('price')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div><!-- Col -->
                    </div><!-- Row -->
                    <button type="submit" class="btn btn-primary submit">Create</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection