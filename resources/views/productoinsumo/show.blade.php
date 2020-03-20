@extends("app")

@section('contenido')
<div class="row">
    <div class="col">
        <h3 class="text-center">Productos  <a href="/producto/insumos"> Crear</a></h3>
        @if (session('status'))
            @if(session('status') == '1')
                <div class="alert alert-success">
                    Se guardo
                </div>
            @else
                <div class="alert alert-danger">
                    {{session('status') }}
                </div>
            @endif
        @endif
    </div>
</div>
<div class="row">
    <div class="col">
        <table class="table"> 
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Categoria</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Insumos</th>
                </tr>
            </thead>
            <tbody>
                @foreach($productos as $value)
                    <tr>
                        <td>{{ $value->id }}</td>
                        <td>{{ $value->nombre }}</td>
                        <td>{{ $value->categoria }}</td>
                        <td>{{ $value->cantidad }}</td>
                        <td>{{ $value->precio }}</td>
                        <td>
                            <a class="btn btn-info" href="/producto/listar?id={{ $value->id }}">Ver</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>    
    </div>
</div>

@if(count($insumos) > 0)
    <div class="row">
        <div class="col">
            <table class="table">
                <thead>
                    <t>
                        <th colspan="4" class="text-center">Insumos</th>
                    </tr>
                    <t>
                        <th>Nombre</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Sub total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($insumos as $value)
                        <tr>
                            <td>{{$value->nombre}}</td>
                            <td>{{$value->cantidad_c}}</td>
                            <td>{{$value->precio}}</td>
                            <td>{{$value->precio * $value->cantidad_c}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endif

@endsection