<div>
    <label>User:</label>
    <select name="user_id">
        @foreach($users as $user)
            <option value="{{ $user->id }}" {{ old('user_id', $profileRole->user_id ?? '') == $user->id ? 'selected' : '' }}>
                {{ $user->name }}
            </option>
        @endforeach
    </select>
</div>

<input name="first_name" value="{{ old('first_name', $profileRole->first_name ?? '') }}" placeholder="First Name">
<input name="mid_name" value="{{ old('mid_name', $profileRole->mid_name ?? '') }}" placeholder="Middle Name">
<input name="last_name" value="{{ old('last_name', $profileRole->last_name ?? '') }}" placeholder="Last Name">
<input type="date" name="date_of_birth" value="{{ old('date_of_birth', $profileRole->date_of_birth ?? '') }}">
<input name="national_no" value="{{ old('national_no', $profileRole->national_no ?? '') }}" placeholder="National No">
<input name="IBAN" value="{{ old('IBAN', $profileRole->IBAN ?? '') }}" placeholder="IBAN">
<input name="document_no" value="{{ old('document_no', $profileRole->document_no ?? '') }}" placeholder="Document No">
<input name="document_url" value="{{ old('document_url', $profileRole->document_url ?? '') }}" placeholder="Document URL">
<input name="document_type" value="{{ old('document_type', $profileRole->document_type ?? '') }}" placeholder="Document Type">

<select name="nationality_id">
    @foreach($countries as $country)
        <option value="{{ $country->id }}" {{ old('nationality_id', $profileRole->nationality_id ?? '') == $country->id ? 'selected' : '' }}>
            {{ $country->name }}
        </option>
    @endforeach
</select>

<select name="status">
    <option value="1" {{ old('status', $profileRole->status ?? '') == 1 ? 'selected' : '' }}>Active</option>
    <option value="0" {{ old('status', $profileRole->status ?? '') == 0 ? 'selected' : '' }}>Inactive</option>
</select>
