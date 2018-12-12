<table class="table table-bordered" id="data-table-basic-product">
    <thead>
        <tr>
            <th scope="col">{{ __('Title') }} </th>
            <th scope="col">{{ __('Price') }} </th>
            <th scope="col">{{ __('Quantity') }} </th>
            <th scope="col">{{ __('SKU') }} </th>
            <th scope="col">{{ __('Content') }} </th>
            <th scope="col">{{ __('Action') }} </th>
        </tr>
    </thead>
    <tbody>
        @forelse($products as $product)
            <tr>
                <td> {{ $product->title }} </td>
                <td> {{ $product->price }} </td>
                <td> {{ $product->quantity }} </td>
                <td> {{ $product->product_sku }} </td>
                <td> {!! str_limit($product->content, 30, " &raquo") !!}  </td>
                <td> 
                    <a href="{{ route('products.edit', Crypt::encrypt($product->id)) }}">Edit</a> &nbsp; | &nbsp;
                    <a href="javascript:void(0)" data-href="{{ route('products.destroy', Crypt::encrypt($product->id)) }}" class="delete-product" data-id="{{$product->id}}" data-token="{{csrf_token()}}">Delete</a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6">{{ __('No any product found.') }}</td>
            </tr>
        @endforelse
    </tbody>
</table>

{!! $products->render() !!}