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
                <h4 class="card-title">Product table</h4>
                <div class="table-responsive pt-3">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(empty($products))
                            <tr>
                                No product uploaded
                            </tr>
                            @else
                            @foreach($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->quantity }}</td>
                                <td>{{ $product->price }}</td>
                                <td class="d-flex">
                                    <a href="{{ route( 'product.edit', $product->id ) }}" class="btn btn-info">Edit</a>
                                    <a href="{{ route( 'product.show', $product->id ) }}" class="btn btn-info">Show</a>
                                    <form action="{{ route('product.destroy', $product->id ) }}" method="POST" class="col-sm-6 col-md-4 col-lg-3">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Trash</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                    {{ $products->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection