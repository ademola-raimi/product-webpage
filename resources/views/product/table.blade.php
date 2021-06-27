<h3 class="mb-4">Product List</h3>
<table class="table table-bordered">
    <thead class="thead-light">
    <tr>
        <th scope="col">#</th>
        <th scope="col">Product Name</th>
        <th scope="col">Quantity in Stock</th>
        <th scope="col">Price Per item</th>
        <th scope="col">Date/time submited</th>
        <th scope="col">Actions</th>
    </tr>
    </thead>
    <tbody>
    @if (isset($products) && count($products) > 0)
        @foreach($products as $index => $product)
            <tr>
                <th scope="row">{{ $index + 1}}</th>
                <td>{{$product['name']}}</td>
                <td>{{ $product['quantity'] }}</td>
                <td>{{ $product['price'] }}</td>
                <td>{{ $product['datetime'] }}</td>
                <td>
                <span class="mr-2">
                    <a href="{{route('product.edit', $product['id'])}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                </span>
                    <span id="delete-product" data-id="{{ $product['id'] }}">
                   <i class="fa fa-trash-o" aria-hidden="true"></i>
                </span>

                </td>
            </tr>
        @endforeach
    @else
        <tr>
            <span>No Products found</span>
        </tr>

    @endif

    </tbody>
</table>

