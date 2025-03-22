<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Eps;
use Illuminate\Http\Request;

class EpsController extends Controller
{
    public function index()
    {
        $epss = Eps::paginate(10);
        return view('admin.eps.index', compact('epss'));
    }

    public function create()
    {
        return view('admin.eps.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100|unique:eps',
        ]);

        Eps::create($request->all());

        return redirect()->route('admin.eps.index')
            ->with('success', 'EPS creada exitosamente.');
    }

    public function show(Eps $ep)
    {
        return view('admin.eps.show', compact('ep'));
    }

    public function edit(Eps $ep)
    {
        return view('admin.eps.edit', compact('ep'));
    }

    public function update(Request $request, Eps $ep)
    {
        $request->validate([
            'nombre' => 'required|string|max:100|unique:eps,nombre,' . $ep->id,
        ]);

        $ep->update($request->all());

        return redirect()->route('admin.eps.index')
            ->with('success', 'EPS actualizada exitosamente.');
    }

    public function destroy(Eps $ep)
    {
        try {
            $ep->delete();
            return redirect()->route('admin.eps.index')
                ->with('success', 'EPS eliminada exitosamente.');
        } catch (\Exception $e) {
            return redirect()->route('admin.eps.index')
                ->with('error', 'No se puede eliminar esta EPS porque está en uso.');
        }
    }
}
