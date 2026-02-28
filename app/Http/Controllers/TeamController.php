<?php

namespace App\Http\Controllers;

use App\Models\TeamMember;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function create()
    {
        return view('backend.team.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => ['required', 'string', 'max:255'],
            'designation' => ['required', 'string', 'max:255'],
            'photo'       => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'sort_order'  => ['nullable', 'integer', 'min:0'],
            'is_active'   => ['nullable', 'boolean'],
        ]);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('team', 'public');
        }

        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['is_active']  = $request->has('is_active') ? 1 : 0;

        TeamMember::create($data);

        return redirect()->route('dashboard', ['panel' => 'team'])
            ->with('team_success', 'Team member added successfully!');
    }

    public function edit(TeamMember $team)
    {
        return view('backend.team.edit', compact('team'));
    }

    public function update(Request $request, TeamMember $team)
    {
        $data = $request->validate([
            'name'        => ['required', 'string', 'max:255'],
            'designation' => ['required', 'string', 'max:255'],
            'photo'       => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'sort_order'  => ['nullable', 'integer', 'min:0'],
            'is_active'   => ['nullable', 'boolean'],
        ]);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('team', 'public');
        } else {
            unset($data['photo']);
        }

        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['is_active']  = $request->has('is_active') ? 1 : 0;

        $team->update($data);

        return redirect()->route('dashboard', ['panel' => 'team'])
            ->with('team_success', 'Team member updated successfully!');
    }

    public function destroy(TeamMember $team)
    {
        if ($team->photo) {
            \Storage::disk('public')->delete($team->photo);
        }
        $team->delete();

        return redirect()->route('dashboard', ['panel' => 'team'])
            ->with('team_success', 'Team member deleted successfully!');
    }
}
