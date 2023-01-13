<form action="{{route('products.update', $product)}}" method="POST">
    @csrf
    @method('PUT')

    <input type="text" name="name" value="{{$product->name}}">

    <input type="submit" value="Actualizar">
</form>