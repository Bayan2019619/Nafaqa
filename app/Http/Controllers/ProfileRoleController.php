<?php

namespace App\Http\Controllers;

use App\DocumentTypeEnum;
use App\Http\Requests\StoreProfileRoleRequest;
use App\Http\Requests\UpdateProfileRoleRequest;
use App\Models\ProfileRole;
use App\Models\Country;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class ProfileRoleController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', ProfileRole::class);

        $profileRoles = ProfileRole::with('user')->paginate(10);

        return view('profile-roles.index', compact('profileRoles'));
    }

    public function create()
    {
        $this->authorize('create', ProfileRole::class);

        $countries = Country::all();
        $documentTypes = DocumentTypeEnum::cases();

        return view('profile-roles.create', compact(['countries', 'documentTypes']));
    }

    public function store(StoreProfileRoleRequest $request)
    {
        $this->authorize('create', ProfileRole::class);

        $userId = $request->user;
        $targetUser = $userId && auth()->user()->can('profileRole.create') ? User::findOrFail($userId) : auth()->user();

        if ($targetUser->profileRole) {
            return redirect()->route('dashboard')
                ->with('error', __('This user already has a profile.'));
        }

        $validated = $request->validated();
        $validated['gender'] = $request->input('gender');
        $validated['document_file_url'] = $request->file('document_file')->store('documents', 'public');
        $validated['user_id'] = $targetUser->id;

        $profileRole = ProfileRole::create($validated);

        activity()
            ->causedBy(auth()->user())
            ->performedOn($profileRole)
            ->log('Profile created for user: ' . $targetUser->id);

        return redirect()->route('dashboard')->with('success', __('Profile created successfully.'));
    }

    public function show(ProfileRole $profileRole)
    {
        $this->authorize('view', $profileRole);

        $nationalityName = $profileRole->nationality->name;
        return view('profile-roles.show', compact('profileRole', 'nationalityName'));
    }

    public function edit(ProfileRole $profileRole)
    {
        $this->authorize('update', $profileRole);

        $countries = Country::all();
        $documentTypes = DocumentTypeEnum::cases();

        return view('profile-roles.edit', compact('profileRole', 'countries', 'documentTypes'));
    }

    public function update(UpdateProfileRoleRequest $request, ProfileRole $profileRole)
    {
        $this->authorize('update', $profileRole);

        $validated = $request->validated();
        $validated['gender'] = $request->input('gender');

        if($request->file('document_file')){
            $validated['document_file_url'] = $request->file('document_file')->store('documents', 'public');
        }

        $profileRole->update($validated);

        activity()
            ->causedBy(auth()->user())
            ->performedOn($profileRole)
            ->log('Profile updated for user: ' . $profileRole->user_id);

        return redirect()->route('dashboard')->with('success', __('Profile updated successfully.'));
     
    }

    public function toggleStatus(ProfileRole $profileRole)
    {

        $profileRole->status = !$profileRole->status;
        $profileRole->save();

        activity()
            ->causedBy(auth()->user())
            ->performedOn($profileRole)
            ->log('Toggled status for user: ' . $profileRole->user_id);

        return back()->with('success', __('Status updated.'));
    }

    public function destroy(ProfileRole $profileRole)
    {
        $this->authorize('delete', $profileRole);

        $profileRole->delete();

        activity()
            ->causedBy(auth()->user())
            ->performedOn($profileRole)
            ->log('Profile deleted for user: ' . $profileRole->user_id);

        return redirect()->route('profileRole.index')->with('success', __('Profile deleted successfully.'));
    }

    
}
