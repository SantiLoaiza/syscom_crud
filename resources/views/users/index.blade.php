@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Gestión de Usuarios</h2>
    <a href="{{ route('users.create') }}" class="btn btn-primary">Agregar Usuario</a>
    
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Cargo</th>
                <th>Fecha de Ingreso</th>
                <th>Días Trabajados</th>
                <th>Contrato</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td>
                    <td>{{ $user->start_date }}</td>
                    <td>{{ app\Http\Controllers\UserController::getWorkingDays($user->start_date) }}</td>
                    <td>
                        @if($user->contract_path)
                            <a href="{{ route('users.contract', $user->id) }}" target="_blank" class="btn btn-info">Ver Contrato</a>
                        @else
                            <span class="text-danger">No disponible</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
