@csrf

<h2 class="text-2xl font-semibold text-gray-800">Add Divorce Case</h2>

{{-- Mother ID --}}
<div>
    <label for="mother_id" class="block text-sm font-medium text-gray-700">Mother</label>
    <select name="mother_id" id="mother_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
        <option value="">-- Select Mother --</option>
        @foreach($profileRoles as $profile)
            <option value="{{ $profile->id }}" {{ old('mother_id') == $profile->id ? 'selected' : '' }}>
                {{ $profile->name }}
            </option>
        @endforeach
    </select>
    @error('mother_id')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>

{{-- Father ID --}}
<div>
    <label for="father_id" class="block text-sm font-medium text-gray-700">Father</label>
    <select name="father_id" id="father_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
        <option value="">-- Select Father --</option>
        @foreach($profileRoles as $profile)
            <option value="{{ $profile->id }}" {{ old('father_id') == $profile->id ? 'selected' : '' }}>
                {{ $profile->name }}
            </option>
        @endforeach
    </select>
    @error('father_id')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>

{{-- Case Number --}}
<div>
    <label for="case_no" class="block text-sm font-medium text-gray-700">Case Number</label>
    <input type="text" name="case_no" id="case_no" value="{{ old('case_no') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
    @error('case_no')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>

{{-- Divorce Date --}}
<div>
    <label for="divorce_date" class="block text-sm font-medium text-gray-700">Divorce Date</label>
    <input type="date" name="divorce_date" id="divorce_date" value="{{ old('divorce_date') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
    @error('divorce_date')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>

{{-- Court Document --}}
<div>
    <label for="court_document" class="block text-sm font-medium text-gray-700">Court Document (PDF/JPG/PNG)</label>
    <input type="file" name="court_document" id="court_document" class="mt-1 block w-full text-sm text-gray-500 file:bg-indigo-600 file:text-white file:rounded file:px-4 file:py-2 hover:file:bg-indigo-700">
    @error('court_document')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>