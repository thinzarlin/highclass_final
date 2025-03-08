@extends('layouts.app')

@section('content')
    <div class="pb-5 text-xl text-gray-700">

        <div class="flex justify-start mt-1">
            <a href="{{ route('cars.index') }}" type="button"
                class="text-white bg-gray-700  focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2.5 me-2 mb-2">
                back</a>
        </div>

        <div>
            <p class="mb-2 text-3xl font-semibold">Create New Record</p>
        </div>

        <div class="w-full mb-3">
            <form method="POST" action="{{ route('cars.store') }}" enctype="multipart/form-data"
                class="px-6 pt-4 pb-8 mb-4 bg-white rounded-lg shadow-lg">
                @csrf

                <div class="grid grid-cols-6 gap-4">
                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="car_no">
                            Car No
                        </label>
                        <input
                            class="w-full shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="car_no" type="text" placeholder="Car No" name="car_no" value="{{ old('car_no') }}"
                            required autofocus>

                        @error('car_no')
                            <div class="p-1 text-base text-red-600">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="type">
                            Type
                        </label>

                        <select
                            class="shadow w-full py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="type" name="type" required>

                            <option value="" disabled selected hidden>Choose one</option>
                            @foreach (config('enums.car_types') as $key => $value)
                                <option value="{{ $key }}" {{ old('type') == $key ? 'selected' : '' }}>
                                    {{ $value }}
                                </option>
                            @endforeach

                        </select>

                        @error('type')
                            <div class="p-1 text-base text-red-600">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="type_detail">
                            Type Detail
                        </label>

                        <select
                            class="shadow w-full py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="type_detail" name="type_detail" required>

                            <option value="" disabled selected hidden>Choose one</option>
                            @foreach (config('enums.car_type_details') as $key => $value)
                                <option value="{{ $key }}" {{ old('type_detail') == $key ? 'selected' : '' }}>
                                    {{ $value }}
                                </option>
                            @endforeach

                        </select>

                        @error('type_detail')
                            <div class="p-1 text-base text-red-600">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="people">
                            လူဦးရေ
                        </label>
                        <input
                            class="w-full shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="people" type="text" placeholder="လူဦးရေ" name="people"
                            value="{{ old('people', 0) }}" required>

                        @error('people')
                            <div class="p-1 text-base text-red-600">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-2 flex gap-4 col-span-2">
                        <input id="current" name="current" type="checkbox" value="" checked
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 focus:ring-2">
                        <label for="current" class="ms-2 text-sm font-medium text-gray-900">Current</label>

                        <input id="home_car" name="home_car" type="checkbox" value="" checked
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 focus:ring-2">
                        <label for="home_car" class="ms-2 text-sm font-medium text-gray-900">အိမ်ကား</label>

                        <input id="sold" name="sold" type="checkbox" value=""
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 focus:ring-2">
                        <label for="sold" class="ms-2 text-sm font-medium text-gray-900">ရောင်းပြီး</label>
                    </div>
                </div>

                <div class="grid grid-cols-5 gap-4">
                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="owner">
                            Owner
                        </label>
                        <input
                            class="w-full shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="owner" type="text" placeholder="Owner" name="owner" value="{{ old('owner') }}">

                        @error('owner')
                            <div class="p-1 text-base text-red-600">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="driver_1">
                            ယာဉ်မောင်း ၁
                        </label>
                        <input
                            class="w-full shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="driver_1" name="driver_1" type="text" placeholder="ယာဉ်မောင်း ၁"
                            value="{{ old('driver_1') }}">
                    </div>

                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="driver_2">
                            ယာဉ်မောင်း ၂
                        </label>
                        <input
                            class="w-full shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="driver_2" name="driver_2" type="text" placeholder="ယာဉ်မောင်း ၂"
                            value="{{ old('driver_2') }}">
                    </div>

                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="spare">
                            နောက်လိုက်
                        </label>
                        <input
                            class="w-full shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="spare" name="spare" type="text" placeholder="နောက်လိုက်"
                            value="{{ old('spare') }}">
                    </div>

                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="crew">
                            ယာဉ်မောင်/ယာဉ်မယ်
                        </label>
                        <input
                            class="w-full shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="crew" name="crew" type="text" placeholder="ယာဉ်မောင်/ယာဉ်မယ်"
                            value="{{ old('crew') }}">
                    </div> --}}

                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="driver_1_id">
                            ယာဉ်မောင်း ၁
                        </label>
                        <select
                            class="shadow w-full py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                            id="driver_1_id" name="driver_1_id">

                            <option value="" disabled selected hidden>ယာဉ်မောင်း ၁ ရွေးပါ</option>
                            @foreach ($driver_1s as $key => $driver_1)
                                <option value="{{ $driver_1->id }}"
                                    {{ old('driver_1_id') == $driver_1->id ? 'selected' : '' }}>
                                    {{ $driver_1->name }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="driver_2_id">
                            ယာဉ်မောင်း ၂
                        </label>
                        <select
                            class="shadow w-full py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                            id="driver_2_id" name="driver_2_id">

                            <option value="" disabled selected hidden>ယာဉ်မောင်း ၁ ရွေးပါ</option>
                            @foreach ($driver_2s as $key => $driver_2)
                                <option value="{{ $driver_2->id }}"
                                    {{ old('driver_2_id') == $driver_2->id ? 'selected' : '' }}>
                                    {{ $driver_2->name }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="spare_id">
                            နောက်လိုက်
                        </label>
                        <select
                            class="shadow w-full py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                            id="spare_id" name="spare_id">

                            <option value="" disabled selected hidden>ယာဉ်မောင်း ၁ ရွေးပါ</option>
                            @foreach ($spares as $key => $spare)
                                <option value="{{ $spare->id }}"
                                    {{ old('spare_id') == $spare->id ? 'selected' : '' }}>
                                    {{ $spare->name }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="crew_id">
                            ယာဉ်မောင်/ယာဉ်မယ်
                        </label>
                        <select
                            class="shadow w-full py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                            id="crew_id" name="crew_id">

                            <option value="" disabled selected hidden>ယာဉ်မောင်း ၁ ရွေးပါ</option>
                            @foreach ($crews as $key => $crew)
                                <option value="{{ $crew->id }}" {{ old('crew_id') == $crew->id ? 'selected' : '' }}>
                                    {{ $crew->name }}
                                </option>
                            @endforeach

                        </select>
                    </div>
                </div>

                <div class="flex justify-between item-center">
                    <button
                        class="px-4 py-2.5 text-sm font-bold text-white bg-blue-500 rounded hover:bg-blue-700 focus:outline-none focus:shadow-outline"
                        type="submit">
                        Create
                    </button>
                </div>

            </form>

        </div>

        <div class="w-full">
            <form id="carStaffForm" enctype="multipart/form-data"
                class="px-6 pt-4 pb-8 mb-4 bg-white rounded-lg shadow-lg">
                @csrf

                <h2 class="font-bold text-xl mb-3">Create New Staff</h2>

                <div class="grid grid-cols-6 gap-4">
                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="name">
                            အမည်
                        </label>
                        <input
                            class="w-full shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="name" name="name" type="text" placeholder="အမည်"
                            value="{{ old('name') }}" required>

                        <div id="nameError" class="p-1 text-base text-red-600 hidden"></div>
                    </div>

                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="type">
                            Type
                        </label>
                        <select
                            class="shadow w-full py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="type" name="type" required>

                            <option value="" disabled selected hidden>Choose one</option>
                            @foreach ($car_staff_types as $key => $type)
                                <option value="{{ $type->value }}" {{ old('type') == $type->value ? 'selected' : '' }}>
                                    {{ $type->label() }}
                                </option>
                            @endforeach

                        </select>
                        <div id="typeError" class="p-1 text-base text-red-600 hidden"></div>
                    </div>

                    <div class="mb-2">
                        <input id="current" name="current" type="checkbox" value="" checked
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 focus:ring-2">
                        <label for="current" class="ms-2 text-sm font-medium text-gray-900">Current</label>
                    </div>
                </div>

                <div class="flex justify-between item-center">
                    <button id="submitStaffBtn"
                        class="px-4 py-2.5 text-sm font-bold text-white bg-blue-500 rounded hover:bg-blue-700 focus:outline-none focus:shadow-outline"
                        type="submit">
                        Create
                    </button>
                </div>

                <div id="successMessage" class="hidden mt-4 p-2 bg-green-100 text-green-800 rounded">
                    Staff created successfully!
                </div>

            </form>

        </div>
    </div>
@endSection

@section('scripts')
    <script>
        // $('.select2').select2();

        $(document).ready(function() {
            $('#carStaffForm').submit(function(e) {
                e.preventDefault();

                let formData = new FormData(this);

                $.ajax({
                    url: "{{ route('car-staffs.store') }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        $('#submitBtn').prop('disabled', true);
                        $('.text-red-600').addClass('hidden');
                    },
                    success: function(response) {
                        $('#successMessage').removeClass('hidden');
                        $('#carStaffForm')[0].reset();
                    },
                    error: function(xhr) {
                        $('#submitBtn').prop('disabled', false);

                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            if (errors.name) {
                                $('#nameError').text(errors.name[0]).removeClass('hidden');
                            }
                            if (errors.type) {
                                $('#typeError').text(errors.type[0]).removeClass('hidden');
                            }
                        }
                    }
                });
            });

            $(':input').keypress(function(e) {
                var code = e.keyCode || e.which;
                if (code == 13)
                    return false;
            });

        });
    </script>
@endsection
