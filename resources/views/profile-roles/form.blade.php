<input type="hidden" name="user" value="{{ request('user') }}">

    {{-- Row 2: Names (3 columns) --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6 mt-4">
        <div>
            <label for="first_name" class="block text-sm font-medium text-gray-700">{{ __('First Name') }}</label>
            <input
                type="text"
                name="first_name"
                id="first_name"
                value="{{ old('first_name', $profileRole->first_name ?? '') }}"
                placeholder="{{ __('First Name') }}"
                required
                maxlength="30"
                oninvalid="this.setCustomValidity('{{ __('First Name is required and max 30 chars') }}')"
                oninput="this.setCustomValidity('')"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
            />
        </div>
        <div>
            <label for="mid_name" class="block text-sm font-medium text-gray-700">{{ __('Middle Name') }}</label>
            <input
                type="text"
                name="mid_name"
                id="mid_name"
                value="{{ old('mid_name', $profileRole->mid_name ?? '') }}"
                placeholder="{{ __('Middle Name') }}"
                required
                maxlength="30"
                oninvalid="this.setCustomValidity('{{ __('Middle Name is required and max 30 chars') }}')"
                oninput="this.setCustomValidity('')"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
            />
        </div>
        <div>
            <label for="last_name" class="block text-sm font-medium text-gray-700">{{ __('Last Name') }}</label>
            <input
                type="text"
                name="last_name"
                id="last_name"
                value="{{ old('last_name', $profileRole->last_name ?? '') }}"
                placeholder="{{ __('Last Name') }}"
                required
                maxlength="30"
                oninvalid="this.setCustomValidity('{{ __('Last Name is required and max 30 chars') }}')"
                oninput="this.setCustomValidity('')"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
            />
        </div>
    </div>

    {{-- Row 3: DOB + Nationality + Document No (3 columns) --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div>
            <label for="date_of_birth" class="block text-sm font-medium text-gray-700">{{ __('Date of Birth') }}</label>
            <input
                type="date"
                name="date_of_birth"
                id="date_of_birth"
                value="{{ old('date_of_birth', $profileRole->date_of_birth ?? '') }}"
                required
                max="{{ date('Y-m-d') }}"
                oninvalid="this.setCustomValidity('{{ __('Date of Birth is required and must be before today') }}')"
                oninput="this.setCustomValidity('')"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
            />
        </div>
        <div>
            <label for="nationality_id" class="block text-sm font-medium text-gray-700">{{ __('Nationality') }}</label>
        <select
            id="nationality_id"
            name="nationality_id"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
            required
            oninvalid="this.setCustomValidity('{{ __('Nationality is required') }}')"
            oninput="this.setCustomValidity('')"
        >
            @foreach($countries as $country)
                <option value="{{ $country->id }}" {{ old('nationality_id') == $country->id ? 'selected' : '' }}>
                    {{ app()->getLocale() === 'ar' ? $country->arabic_name : $country->english_name }}
                </option>
            @endforeach
        </select>

        </div>
        <div>
            <label for="national_no" class="block text-sm font-medium text-gray-700">{{ __('National No') }}</label>
            <input
                type="text"
                name="national_no"
                id="national_no"
                value="{{ old('national_no', $profileRole->national_no ?? '') }}"
                placeholder="{{ __('National No') }}"
                required
                pattern="^[1-2][0-9]{11}$"
                maxlength="12"
                minlength="12"
                oninvalid="this.setCustomValidity('{{ __('National No must start with 1 or 2 and be 12 digits') }}')"
                oninput="this.setCustomValidity('')"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
            />
        </div>
    </div>

    {{-- Row 4: Document Type + Document No + IBAN (3 columns) --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        @php use App\Enums\DocumentTypeEnum; @endphp

        <div>
            <label for="document_type" class="block text-sm font-medium text-gray-700">{{ __('Document Type') }}</label>
            <select
                name="document_type"
                id="document_type"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                required
                oninvalid="this.setCustomValidity('{{ __('Document Type is required') }}')"
                oninput="this.setCustomValidity('')"
            >
                @foreach($documentTypes as $type)
                    <option value="{{ $type->value }}" {{ old('document_type', $profileRole->document_type ?? '') == $type->value ? 'selected' : '' }}>
                        {{ __($type->label()) }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="document_no" class="block text-sm font-medium text-gray-700">{{ __('Document No') }}</label>
            <input
                type="text"
                name="document_no"
                id="document_no"
                value="{{ old('document_no', $profileRole->document_no ?? '') }}"
                placeholder="{{ __('Document No') }}"
                required
                oninvalid="this.setCustomValidity('{{ __('Document No is required') }}')"
                oninput="this.setCustomValidity('')"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
            />
        </div>

        <div>
            <label for="IBAN" class="block text-sm font-medium text-gray-700">{{ __('IBAN') }}</label>
            <input
                type="text"
                name="IBAN"
                id="IBAN"
                value="{{ old('IBAN', $profileRole->IBAN ?? '') }}"
                placeholder="IBAN"
                required
                oninvalid="this.setCustomValidity('{{ __('IBAN is required') }}')"
                oninput="this.setCustomValidity('')"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
            />
        </div>
    </div>

    {{-- Row 5: Document File Upload (full width) --}}
<input
    type="file"
    name="document_file"
    id="document_file"
    accept=".jpg,.jpeg,.png,.gif,.bmp,.webp,.pdf"
    @if (!isset($profileRole)) required @endif
    oninvalid="this.setCustomValidity('{{ __('Document File is required') }}')"
    oninput="this.setCustomValidity('')"
    class="block w-full text-sm text-gray-500
        file:mr-4 file:py-2 file:px-4
        file:rounded-md file:border-0
        file:text-sm file:font-semibold
        file:bg-indigo-50 file:text-indigo-700
        hover:file:bg-indigo-100"
/>

