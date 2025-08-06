<?php

namespace App\Http\Controllers;

use App\DocumentTypeEnum;
use App\Http\Requests\StoreProfileRoleRequest;
use App\Http\Requests\UpdateProfileRoleRequest;
use App\Models\ProfileRole;
use App\Models\Country;
use App\Models\User;
use App\StatusEnum;
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
        $targetUser = $userId && auth()->user()->can('profileRoles.create') ? User::findOrFail($userId) : auth()->user();

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
            ->log('Created');

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
            ->log('Updated');

        return redirect()->route('dashboard')>with('success', __('Profile updated successfully.'));
     
    }

    public function showReview(ProfileRole $profileRole)
    {
        $this->authorize('changeStatus', $profileRole);

        $nationalityName = $profileRole->nationality->name;
        return view('profile-roles.review', compact('profileRole', 'nationalityName'));
    }

    public function review(Request $request, ProfileRole $profileRole)
{
    $this->authorize('changeStatus', $profileRole);
    $statusValue = $request->input('status');

    if (!in_array((int)$statusValue, array_column(StatusEnum::cases(), 'value'))) {
        return redirect()->back()->withErrors('Invalid status value.');
    }

    $profileRole->status = StatusEnum::from((int)$statusValue);
    $profileRole->save();

       activity()
            ->causedBy(auth()->user())
            ->performedOn($profileRole)
            ->log('Reviewed');

    return redirect()->route('profile-roles.index')->with('success', __('Status updated.'));
    }

    public function destroy(ProfileRole $profileRole)
    {
        $this->authorize('delete', $profileRole);

        $profileRole->delete();

        activity()
            ->causedBy(auth()->user())
            ->performedOn($profileRole)
            ->log('Deleted');

        return redirect()->route('profile-roles.index')->with('success', __('Profile deleted successfully.'));
    }

    
}
