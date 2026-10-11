<?php

namespace App\Http\Controllers\Studio;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDistributorRequest;
use App\Http\Requests\UpdateDistributorRequest;
use App\Models\Distributor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class DistributorController extends Controller
{
    public function index(): View
    {
        return view('studio.distributors.index', [
            'distributors' => Distributor::query()->orderBy('name')->get(),
        ]);
    }

    public function create(): View
    {
        return view('studio.distributors.create');
    }

    public function store(StoreDistributorRequest $request): RedirectResponse
    {
        $attributes = $request->safe()->except('logo');

        if ($request->hasFile('logo')) {
            $attributes['logo_path'] = $request->file('logo')->store('distributors', 'public');
        }

        Distributor::query()->create($attributes);

        return to_route('studio.distributors.index')->with('status', __('hellios.studio.distributor_added'));
    }

    public function edit(Distributor $distributor): View
    {
        return view('studio.distributors.edit', ['distributor' => $distributor]);
    }

    public function update(UpdateDistributorRequest $request, Distributor $distributor): RedirectResponse
    {
        $attributes = $request->safe()->except('logo');

        if ($request->hasFile('logo')) {
            if ($distributor->logo_path) {
                Storage::disk('public')->delete($distributor->logo_path);
            }

            $attributes['logo_path'] = $request->file('logo')->store('distributors', 'public');
        }

        $distributor->update($attributes);

        return to_route('studio.distributors.index')->with('status', __('hellios.studio.distributor_updated'));
    }

    public function destroy(Distributor $distributor): RedirectResponse
    {
        if ($distributor->logo_path) {
            Storage::disk('public')->delete($distributor->logo_path);
        }

        $distributor->delete();

        return to_route('studio.distributors.index')->with('status', __('hellios.studio.distributor_removed'));
    }
}
