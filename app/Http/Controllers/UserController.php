<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Barryvdh\DomPDF\Facade as PDF;


class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'role' => 'required|in:Empleado,Jefe',
            'start_date' => 'required|date',
        ]);

        $user = User::create($request->all());

        // Generar contrato PDF
        $pdf = PDF::loadView('users.contract', compact('user'));
        $contractPath = 'contracts/' . $user->id . '.pdf';
        $pdf->save(storage_path('app/public/' . $contractPath));

        // Guardar la ruta en la BD
        $user->contract_path = $contractPath;
        $user->save();

        return redirect()->route('users.index');
    }

    public function generateContract($id)
{
    $user = User::findOrFail($id);

    // Cargar la vista del contrato con los datos del usuario
    $pdf = PDF::loadView('users.contract', compact('user'));

    // Definir el nombre del archivo
    $fileName = 'contrato_' . $user->id . '.pdf';

    // Guardar el contrato en storage/app/public/contracts/
    $filePath = 'contracts/' . $fileName;
    $pdf->save(storage_path('app/public/' . $filePath));

    // Actualizar la ruta del contrato en la base de datos
    $user->contract_path = $filePath;
    $user->save();

    // Descargar el PDF o abrir en el navegador
    return $pdf->stream($fileName);
}

    public function getWorkingDays($startDate)
    {
        $start = Carbon::parse($startDate);
        $today = Carbon::today();
        $workingDays = 0;

        $holidays = collect(Http::get('https://api-colombia.com/api/v1/holiday/year/2025')->json());

        while ($start <= $today) {
            if (!$start->isWeekend() && !$holidays->contains('date', $start->toDateString())) {
                $workingDays++;
            }
            $start->addDay();
        }

        return $workingDays;
    }
}

