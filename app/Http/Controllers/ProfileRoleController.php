<?php

namespace App\Http\Controllers;

use App\DocumentTypeEnum;
use App\Models\ProfileRole;
use App\Models\Country;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileRoleController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', ProfileRole::class);
        $user = auth()->user();

        if ($user->can('profileRole.view') || $user->hasRole('admin')) {
            $profileRoles = ProfileRole::with('user')->get();
            return view('profile_roles.index', compact('profileRoles'));
        } 

        return view('profile_roles.show', compact('profileRole'));
    }


    public function create()
    {
         if (auth()->user()->profileRole) {
        return redirect()->route('profile-roles.index')
            ->with('error', 'You already have a profile.');
        } 

        $countries = Country::all();
        $users = User::all();
        $documentTypes = DocumentTypeEnum::cases();
        return view('profile_roles.create', compact(['users', 'countries', 'documentTypes']));
    }

    public function store(Request $request)
    {
         if (auth()->user()->profileRole) {
        return redirect()->route('profile-roles.index')
            ->with('error', 'You already have a profile.');
        }
    
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'first_name' => 'required|string',
            'mid_name' => 'nullable|string',
            'last_name' => 'required|string',
            'date_of_birth' => 'required|date',
            'national_no' => 'nullable|unique:profile_roles,national_no',
            'IBAN' => 'required|unique:profile_roles,IBAN',
            'document_no' => 'required|unique:profile_roles,document_no',
            'document_url' => 'required|string',
            'document_type' => 'required|string',
            'nationality_id' => 'required|exists:countries,id',
            'status' => 'required|boolean',
        ]);

        $profileRole = ProfileRole::create($validated);

        activity()->causedBy(auth()->user())
        ->performedOn($profileRole)
        ->log('profile created');


        return redirect()->route('profile-roles.index')->with('success', 'Profile Role created successfully.');
    }

    public function show(ProfileRole $profileRole)
    {
        $this->authorize('view', $profileRole);

        return view('profile_roles.show', compact('profileRole'));
    }

    public function edit(ProfileRole $profileRole)
    {
        $users = User::all();
        $countries = Country::all();
        return view('profile_roles.edit', compact('profileRole', 'users', 'countries'));
    }

    public function update(Request $request, ProfileRole $profileRole)
    {
        $validated = $request->validate([
            'first_name' => 'sometimes|string',
            'mid_name' => 'sometimes|nullable|string',
            'last_name' => 'sometimes|string',
            'date_of_birth' => 'sometimes|date',
            'national_no' => 'nullable|unique:profile_roles,national_no,' . $profileRole->id,
            'IBAN' => 'sometimes|unique:profile_roles,IBAN,' . $profileRole->id,
            'document_no' => 'sometimes|unique:profile_roles,document_no,' . $profileRole->id,
            'document_url' => 'sometimes|string',
            'document_type' => 'sometimes|string',
            'nationality_id' => 'sometimes|exists:countries,id',
            'status' => 'sometimes|boolean',
        ]);

        $profileRole->update($validated);

        activity()->causedBy(auth()->user())
        ->performedOn($profileRole)
        ->log('profile updated');

        return redirect()->route('profile-roles.index')->with('success', 'Profile Role updated successfully.');
    }

    public function toggleStatus(ProfileRole $profileRole)
    {
        $this->authorize('changeStatus', $profileRole);

        $profileRole->status = !$profileRole->status;
        $profileRole->save();

        activity()->causedBy(auth()->user())
            ->performedOn($profileRole)
            ->log('Toggled status');

        return back()->with('success', 'Status updated.');
    }


    public function destroy(ProfileRole $profileRole)
    {
        $profileRole->delete();

        activity()->causedBy(auth()->user())
        ->performedOn($profileRole)
        ->log('profile deleted');
        return redirect()->route('profile-roles.index')->with('success', 'Profile Role deleted successfully.');
    }
}