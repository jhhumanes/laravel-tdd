<a href="{{route('products.create')}}">Crear</a>

<table>
    <tbody>
        @forelse ($products as $product)
            <tr>
                <td>{{$product->name}}</td>
                <td><a href="{{route('products.show', $product)}}">Ver</a></td>
                <td><a href="{{route('products.edit', $product)}}">Editar</a></td>
                <td>
                    <form action="{{route('products.destroy', $product)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="Eliminar">
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td>No hay productos registrados</td>
            </tr>
        @endforelse
    </tbody>
</table>

{{$products->links()}}