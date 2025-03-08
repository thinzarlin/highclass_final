@extends('layouts.app')

@section('content')
    <div class="pb-5 text-xl text-gray-700">

        <div class="flex justify-start mt-1">
            <a href="{{ route('daily-car-lists.index') }}" type="button"
                class="text-white bg-gray-700  focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2.5 me-2 mb-2">
                back</a>
        </div>

        <div>
            <p class="mb-2 text-3xl font-semibold">Edit Record</p>
        </div>

        <div class="w-full">
            <form method="POST" action="{{ route('daily-car-lists.update', $dailyCarList->id) }}"
                enctype="multipart/form-data" class="px-6 pt-4 pb-8 mb-4 bg-white rounded-lg shadow-lg">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-6 gap-4">
                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="ref_no">
                            Ref No
                        </label>
                        <input
                            class="w-full shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="ref_no" type="text" placeholder="Ref No" name="ref_no"
                            value="{{ old('ref_no', $dailyCarList->ref_no) }}" readonly required>

                        @error('ref_no')
                            <div class="p-1 text-base text-red-600">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="date">
                            Date
                        </label>
                        <input
                            class="w-full shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="date" type="text" placeholder="Date" name="date" autocomplete="off"
                            value="{{ old('date', $dailyCarList->date) }}" required>


                        @error('date')
                            <div class="p-1 text-base text-red-600">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="sr_no">
                            Sr No
                        </label>
                        <input
                            class="w-full shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="sr_no" type="text" placeholder="Sr No" name="sr_no"
                            value="{{ old('sr_no', $dailyCarList->sr_no) }}" readonly required>

                        @error('sr_no')
                            <div class="p-1 text-base text-red-600">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-6 gap-4">
                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="tour_id">
                            ခရီးစဉ်
                        </label>
                        <select
                            class="shadow w-full py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                            id="tour_id" name="tour_id" required>

                            <option value="" disabled selected hidden>ခရီးစဉ်ရွေးပါ</option>
                            @foreach ($tours as $key => $tour)
                                <option value="{{ $tour->id }}"
                                    {{ old('tour_id', $dailyCarList->tour_id) == $tour->id ? 'selected' : '' }}>
                                    {{ $tour->short_name }}
                                </option>
                            @endforeach

                        </select>

                        @error('tour_id')
                            <div class="p-1 text-sm text-red-600">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="car_id">
                            ကားနံပါတ်
                        </label>
                        <select
                            class="shadow w-full py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                            id="car_id" name="car_id" required>

                            <option value="" disabled selected hidden>ကားနံပါတ်ရွေးပါ</option>
                            @foreach ($cars as $key => $car)
                                <option value="{{ $car->id }}"
                                    {{ old('car_id', $dailyCarList->car_id) == $car->id ? 'selected' : '' }}>
                                    {{ $car->car_no }}
                                </option>
                            @endforeach

                        </select>

                        @error('car_id')
                            <div class="p-1 text-sm text-red-600">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-4 gap-4">
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
                                    {{ old('driver_1_id', $dailyCarList->driver_1_id) == $driver_1->id ? 'selected' : '' }}>
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
                                    {{ old('driver_2_id', $dailyCarList->driver_2_id) == $driver_2->id ? 'selected' : '' }}>
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
                                    {{ old('spare_id', $dailyCarList->spare_id) == $spare->id ? 'selected' : '' }}>
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
                                <option value="{{ $crew->id }}"
                                    {{ old('crew_id', $dailyCarList->crew_id) == $crew->id ? 'selected' : '' }}>
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
                        Update
                    </button>
                </div>

            </form>

        </div>
    </div>
@endSection

@section('scripts')
    <script>
        // $('.select2').select2();

        $(document).ready(function() {
            var picker1 = new Pikaday({
                field: document.getElementById('date'),
                format: 'DD-MM-YYYY',
            });

            function formatDate(date) {
                const arr = date.split('-');
                if (arr.length == 0) {
                    return '';
                }
                return `${arr[2]}-${arr[1]}-${arr[0]}`;
            }

            $('#date').on('change', function() {
                const date = formatDate($(this).val());
                const oldDate = formatDate('{{ $dailyCarList?->date }}');
                const refNo = '{{ $dailyCarList?->ref_no }}';

                $.ajax({
                    url: '{{ route('daily-car-lists.date_related_info') }}',
                    method: 'GET',
                    data: {
                        date: date,
                        old_date: oldDate,
                        old_ref_no: refNo,
                    },
                    success: function(response) {
                        $('#ref_no').val(response.ref_no);
                        $('#sr_no').val(response.sr_no);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching ref_no: ', error);
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
