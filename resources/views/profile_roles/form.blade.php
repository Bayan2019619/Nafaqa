{{-- Wrap whole form with padding --}}
<div class="p-8 max-w-6xl mx-auto bg-white rounded shadow mt-10">

    {{-- Row 1: User select --}}
    @php
        $canSelectUser = auth()->user()->can('profileRole.create') || auth()->user()->hasRole('admin');
    @endphp

    @if ($canSelectUser)
        <div class="mb-6 max-w-md">
            <label for="user_id" class="block text-sm font-medium text-gray-700 mb-1">{{ __('User') }}</label>
            <select name="user_id" id="user_id" class="block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ old('user_id', $profileRole->user_id ?? '') == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>
    @else
        <input type="hidden" name="user_id" value="{{ auth()->id() }}">
    @endif

    {{-- Row 2: Names (3 columns) --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6 mt-4">
        <div>
            <label for="first_name" class="block text-sm font-medium text-gray-700">{{ __('First Name') }}</label>
            <input type="text" name="first_name" id="first_name" value="{{ old('first_name', $profileRole->first_name ?? '') }}" placeholder="{{ __('First Name') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
        </div>
        <div>
            <label for="mid_name" class="block text-sm font-medium text-gray-700">{{ __('Middle Name') }}</label>
            <input type="text" name="mid_name" id="mid_name" value="{{ old('mid_name', $profileRole->mid_name ?? '') }}" placeholder="{{ __('Middle Name') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
        </div>
        <div>
            <label for="last_name" class="block text-sm font-medium text-gray-700">{{ __('Last Name') }}</label>
            <input type="text" name="last_name" id="last_name" value="{{ old('last_name', $profileRole->last_name ?? '') }}" placeholder="{{ __('Last Name') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
        </div>
    </div>

    {{-- Row 3: DOB + Nationality + Document No (3 columns) --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div>
            <label for="date_of_birth" class="block text-sm font-medium text-gray-700">{{ __('Date of Birth') }}</label>
            <input type="date" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth', $profileRole->date_of_birth ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
        </div>
        <div>
            <label for="nationality_id" class="block text-sm font-medium text-gray-700">{{ __('Nationality') }}</label>
            <select id="nationality_id" name="nationality_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @foreach($countries as $country)
                    <option value="{{ $country->id }}" {{ old('nationality_id') == $country->id ? 'selected' : '' }}>
                    {{ app()->getLocale() === 'ar' ? $country->arabic_name : $country->english_name }}
                    </option>

                @endforeach
            </select>
        </div>
  <div>
            <label for="national_no" class="block text-sm font-medium text-gray-700">{{ __('National No') }}</label>
            <input type="text" name="national_no" id="national_no" value="{{ old('national_no', $profileRole->national_no ?? '') }}" placeholder="{{ __('National No') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
        </div>
    </div>

    {{-- Row 4: National No + IBAN + Document Type (3 columns) --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            @php
    use App\Enums\DocumentTypeEnum;
@endphp

<div>
    <label for="document_type" class="block text-sm font-medium text-gray-700">{{ __('Document Type') }}</label>
    <select name="document_type" id="document_type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
        @foreach($documentTypes as $type)
            <option value="{{ $type->value }}" {{ old('document_type', $profileRole->document_type ?? '') == $type->value ? 'selected' : '' }}>
                {{ __($type->label()) }}
            </option>
        @endforeach
    </select>
</div>
              <div>
            <label for="document_no" class="block text-sm font-medium text-gray-700">{{ __('Document No') }}</label>
            <input type="text" name="document_no" id="document_no" value="{{ old('document_no', $profileRole->document_no ?? '') }}" placeholder="{{ __('Document No') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
        </div>
        
        <div>
            <label for="IBAN" class="block text-sm font-medium text-gray-700">{{ __('IBAN') }}</label>
            <input type="text" name="IBAN" id="IBAN" value="{{ old('IBAN', $profileRole->IBAN ?? '') }}" placeholder="{{ __('IBAN') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
        </div>

    </div>

    {{-- Row 5: Document File Upload (full width) --}}
    <div class="mb-6 max-w-md">
        <label for="document_file" class="block text-sm font-medium text-gray-700 mb-1">{{ __('Document File') }}</label>
        <input type="file" name="document_file" id="document_file" class="block w-full text-sm text-gray-500
            file:mr-4 file:py-2 file:px-4
            file:rounded-md file:border-0
            file:text-sm file:font-semibold
            file:bg-indigo-50 file:text-indigo-700
            hover:file:bg-indigo-100
        " />
    </div>

    {{-- Save button --}}

<div class="mt-8 flex justify-center space-x-8">
  <button
    type="submit"
    class="
      w-48
      px-6 py-3
      bg-blue-100
      text-blue-700
      font-semibold
      rounded-md
      hover:bg-blue-200
      focus:outline-none
      focus:ring-2
      focus:ring-blue-300
      focus:ring-offset-2
      transition
      duration-150
      ease-in-out
    "
  >
    {{ __('Save') }}
  </button>

  <a href="{{ route('dashboard') }}" 
    class="
      w-48
      px-6 py-3
      bg-gray-100
      text-gray-700
      font-semibold
      rounded-md
      hover:bg-gray-200
      focus:outline-none
      focus:ring-2
      focus:ring-gray-300
      focus:ring-offset-2
      transition
      duration-150
      ease-in-out
      text-center
      inline-block
    "
  >
    {{ __('Back') }}
  </a>
</div>








</div>
