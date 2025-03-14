@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Registrar Usuario</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Nombre:</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        
        <div class="mb-3">
            <label>Correo Electrónico:</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Cargo:</label>
            <select name="role" class="form-control" required>
                <option value="Empleado">Empleado</option>
                <option value="Jefe">Jefe</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Fecha de Ingreso:</label>
            <input type="date" name="start_date" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
