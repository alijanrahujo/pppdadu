<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UnionCouncil;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UnionCouncilController extends Controller
{
    /**
     * Display a listing of union councils.
     */
    public function index(): View
    {
        $councils = UnionCouncil::query()->orderBy('order')->orderBy('id')->get();

        return view('admin.councils.index', compact('councils'));
    }

    /**
     * Show form for creating a new union council.
     */
    public function create(): View
    {
        return view('admin.councils.form', [
            'council' => new UnionCouncil([
                'order' => UnionCouncil::query()->max('order') + 1,
                'members' => [
                    ['role' => 'Chairman', 'name' => '', 'image' => 'images-6.jpg'],
                    ['role' => 'Vice Chairman', 'name' => '', 'image' => '1755606233581.jpg'],
                    ['role' => 'Secretary', 'name' => '', 'image' => 'Asif_Ali_Zardari_with_Obamas_cropped.jpg'],
                    ['role' => 'Additional Member', 'name' => '', 'image' => '0Ha8CGJO.jpg'],
                ],
            ]),
        ]);
    }

    /**
     * Store a newly created union council.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'order' => ['nullable', 'integer', 'min:0'],
            'image' => ['nullable', 'string', 'max:255'],
            'image_file' => ['nullable', 'image', 'max:5120'],
            'members' => ['nullable', 'array'],
            'members.*.role' => ['required', 'string', 'max:100'],
            'members.*.name' => ['required', 'string', 'max:150'],
            'members.*.image' => ['nullable', 'string', 'max:255'],
        ]);

        $imagePath = $validated['image'] ?? 'images.jpg';
        if ($request->hasFile('image_file')) {
            $imagePath = $request->file('image_file')->store('uploads/councils', 'public');
        }

        $members = array_values($validated['members'] ?? []);

        UnionCouncil::query()->create([
            'name' => $validated['name'],
            'order' => $validated['order'] ?? 0,
            'image' => $imagePath,
            'members' => $members,
        ]);

        return redirect()->route('admin.councils.index')
            ->with('status', 'Union Council added successfully.');
    }

    /**
     * Show form for editing the union council.
     */
    public function edit(UnionCouncil $council): View
    {
        return view('admin.councils.form', compact('council'));
    }

    /**
     * Update the specified union council.
     */
    public function update(Request $request, UnionCouncil $council): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'order' => ['nullable', 'integer', 'min:0'],
            'image' => ['nullable', 'string', 'max:255'],
            'image_file' => ['nullable', 'image', 'max:5120'],
            'members' => ['nullable', 'array'],
            'members.*.role' => ['required', 'string', 'max:100'],
            'members.*.name' => ['required', 'string', 'max:150'],
            'members.*.image' => ['nullable', 'string', 'max:255'],
        ]);

        $imagePath = $council->image;
        if ($request->hasFile('image_file')) {
            $imagePath = $request->file('image_file')->store('uploads/councils', 'public');
        } elseif ($request->filled('image')) {
            $imagePath = $validated['image'];
        }

        $members = array_values($validated['members'] ?? []);

        $council->update([
            'name' => $validated['name'],
            'order' => $validated['order'] ?? 0,
            'image' => $imagePath,
            'members' => $members,
        ]);

        return redirect()->route('admin.councils.index')
            ->with('status', 'Union Council updated successfully.');
    }

    /**
     * Remove the specified union council.
     */
    public function destroy(UnionCouncil $council): RedirectResponse
    {
        $council->delete();

        return redirect()->route('admin.councils.index')
            ->with('status', 'Union Council removed successfully.');
    }
}
