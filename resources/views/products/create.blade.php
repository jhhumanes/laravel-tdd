<form action="{{route('products.store')}}" method="POST">
    @csrf

    <input type="text" name="name">

    <input type="submit" value="Guardar">
</form>