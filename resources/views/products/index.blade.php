<table>
    <tbody>
        @forelse ($products as $product)
            <tr>
                <td>{{$product->name}}</td>
            </tr>
        @empty
            <tr>
                <td>No hay productos registrados</td>
            </tr>
        @endforelse
    </tbody>
</table>

{{$products->links()}}