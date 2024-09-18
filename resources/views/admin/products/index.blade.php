extends('backpack::layout')

@section('content')
<h2>Products</h2>
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Created At</th>
            <th>Updated At</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
            <tr>
                <td>{{ $product['id'] }}</td>
                <td>{{ $product['fields']['Name'] }}</td>
                <td>{{ $product['fields']['Description'] }}</td>
                <td>{{ $product['fields']['Price'] }}</td>
                <td>{{ $product['fields']['Created At'] }}</td>
                <td>{{ $product['fields']['Updated At'] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection