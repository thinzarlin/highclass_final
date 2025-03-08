@extends('layouts.app')

@section('content')
    <div class="pb-5 text-xl text-gray-700">

        <div class="flex justify-start mt-1">
            <a href="{{ route('cargos.index') }}" type="button"
                class="text-white bg-gray-700  focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2.5 me-2 mb-2">
                back</a>
        </div>

        <div>
            <p class="mb-2 text-3xl font-semibold">Edit Record</p>
        </div>

        <div class="w-full">
            <form method="POST" action="{{ route('cargos.update', $cargo->id) }}" enctype="multipart/form-data"
                class="px-6 pt-4 pb-8 mb-4 bg-white rounded-lg shadow-lg">
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
                            value="{{ old('ref_no', $cargo->ref_no) }}" readonly required>

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
                            value="{{ old('date', $cargo->date) }}" required>


                        @error('date')
                            <div class="p-1 text-base text-red-600">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="tour_id">
                            ခရီးစဉ်
                        </label>
                        <select
                            class="shadow w-full py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                            id="tour_id" name="tour_id" required>

                            <option value="" disabled selected hidden>ခရီးစဉ်ရွေးပါ</option>
                            @foreach ($tours as $key => $tour)
                                <option value="{{ $tour->id }}" {{ old('tour_id', $cargo->tour_id) == $tour->id ? 'selected' : '' }}>
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
                                <option value="{{ $car->id }}" {{ old('car_id', $cargo->car_id) == $car->id ? 'selected' : '' }}>
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

                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="cargo_no">
                            ကုန်နံပါတ်
                        </label>
                        <input
                            class="w-full shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="cargo_no" type="text" placeholder="ကုန်နံပါတ်" name="cargo_no"
                            value="{{ old('cargo_no', $cargo->cargo_no) }}" required>

                        @error('cargo_no')
                            <div class="p-1 text-base text-red-600">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="remark">
                            မှတ်ချက်
                        </label>
                        <input
                            class="w-full shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="remark" type="text" placeholder="မှတ်ချက်" name="remark"
                            value="{{ old('remark', $cargo->remark) }}">

                        @error('remark')
                            <div class="p-1 text-base text-red-600">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                </div>

                <div class="grid grid-cols-4 gap-4">
                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="from_city_id">
                            မှ
                        </label>
                        <select
                            class="shadow w-full py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                            id="from_city_id" name="from_city_id" required>

                            <option value="" disabled selected hidden>မြို့ရွေးပါ</option>
                            @foreach ($cities as $key => $city)
                                <option value="{{ $city->id }}"
                                    {{ old('from_city_id', $cargo->from_city_id) == $city->id ? 'selected' : '' }}>
                                    {{ $city->mm_name }}
                                </option>
                            @endforeach

                        </select>

                        @error('from_city_id')
                            <div class="p-1 text-sm text-red-600">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="from_gate_id">
                            မှ
                        </label>
                        <select
                            class="shadow w-full py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                            id="from_gate_id" name="from_gate_id" required>

                            <option value="" disabled selected hidden>ဂိတ်ရွေးပါ</option>
                            @foreach ($from_gates as $key => $gate)
                                <option value="{{ $gate->id }}"
                                    {{ old('from_gate_id', $cargo->from_gate_id) == $gate->id ? 'selected' : '' }}>
                                    {{ $gate->mm_name }}
                                </option>
                            @endforeach

                        </select>

                        @error('from_gate_id')
                            <div class="p-1 text-sm text-red-600">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="to_city_id">
                            သို့
                        </label>
                        <select
                            class="shadow w-full py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                            id="to_city_id" name="to_city_id" required>

                            <option value="" disabled selected hidden>မြို့ရွေးပါ</option>
                            @foreach ($cities as $key => $city)
                                <option value="{{ $city->id }}"
                                    {{ old('to_city_id', $cargo->to_city_id) == $city->id ? 'selected' : '' }}>
                                    {{ $city->mm_name }}
                                </option>
                            @endforeach

                        </select>

                        @error('to_city_id')
                            <div class="p-1 text-sm text-red-600">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="to_gate_id">
                            သို့
                        </label>
                        <select
                            class="shadow w-full py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                            id="to_gate_id" name="to_gate_id" required>

                            <option value="" disabled selected hidden>ဂိတ်ရွေးပါ</option>
                            @foreach ($to_gates as $key => $gate)
                                <option value="{{ $gate->id }}"
                                    {{ old('to_gate_id', $cargo->to_gate_id) == $gate->id ? 'selected' : '' }}>
                                    {{ $gate->mm_name }}
                                </option>
                            @endforeach

                        </select>

                        @error('to_gate_id')
                            <div class="p-1 text-sm text-red-600">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-4 gap-4">
                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="sender_name">
                            ပို့သူ
                        </label>
                        <input
                            class="w-full shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="sender_name" name="sender_name" type="text" placeholder="ပို့သူ"
                            value="{{ old('sender_name', $cargo->sender_name) }}" required>
                    </div>

                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="sender_phone">
                            ဖုန်းနံပါတ်
                        </label>
                        <input
                            class="w-full shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="sender_phone" name="sender_phone" type="text" placeholder="ဖုန်းနံပါတ်"
                            value="{{ old('sender_phone', $cargo->sender_phone) }}">
                    </div>

                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="receiver_name">
                            လက်ခံသူ
                        </label>
                        <input
                            class="w-full shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="receiver_name" name="receiver_name" type="text" placeholder="လက်ခံသူ"
                            value="{{ old('receiver_name', $cargo->receiver_name) }}" required>
                    </div>

                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="receiver_phone">
                            ဖုန်းနံပါတ်
                        </label>
                        <input
                            class="w-full shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="receiver_phone" name="receiver_phone" type="text" placeholder="ဖုန်းနံပါတ်"
                            value="{{ old('receiver_phone', $cargo->receiver_phone) }}">
                    </div>
                </div>

                <div class="grid grid-cols-9 gap-4">
                    <div class="mb-2 col-span-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="item_name">
                            ကုန်အမျိုးအစား
                        </label>
                        <input
                            class="w-full shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="item_name" name="item_name" type="text" placeholder="ကုန်အမျိုးအစား"
                            value="{{ old('item_name', $cargo->item_name) }}" required>
                    </div>

                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="qty">
                            အရေအတွက်
                        </label>
                        <input
                            class="text-right w-full shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="qty" name="qty" type="number" placeholder="အရေအတွက်"
                            value="{{ old('qty', $cargo->qty) }}" required>
                    </div>

                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="cargo_amt">
                            တန်ဆာခ
                        </label>
                        <input
                            class="text-right w-full shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="cargo_amt" name="cargo_amt" type="number" placeholder="တန်ဆာခ"
                            value="{{ old('cargo_amt', $cargo->cargo_amt) }}" oninput="calTotal()" required>
                    </div>

                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="khauk_to">
                            ခေါက်တိုကြေး
                        </label>
                        <input
                            class="text-right w-full shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="khauk_to" name="khauk_to" type="number" placeholder="ခေါက်တိုကြေး"
                            value="{{ old('khauk_to', $cargo->khauk_to) }}" oninput="calTotal()" required>
                    </div>

                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="deli">
                            အရောက်ပို့ကြေး
                        </label>
                        <input
                            class="text-right w-full shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="deli" name="deli" type="number" placeholder="အရောက်ပို့ကြေး"
                            value="{{ old('deli', $cargo->deli) }}" oninput="calTotal()" required>
                    </div>

                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="bawdar_fee">
                            ဘော်ဒါကြေး
                        </label>
                        <input
                            class="text-right w-full shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="bawdar_fee" name="bawdar_fee" type="number" placeholder="ဘော်ဒါကြေး"
                            value="{{ old('bawdar_fee', $cargo->bawdar_fee) }}" oninput="calTotal()" required>
                    </div>

                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="site_shin">
                            စိုက်ရှင်းငွေ
                        </label>
                        <input
                            class="text-right w-full shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="site_shin" name="site_shin" type="number" placeholder="စိုက်ရှင်းငွေ"
                            value="{{ old('site_shin', $cargo->site_shin) }}" oninput="calTotal()" required>
                    </div>

                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="total">
                            ကျသင့်ငွေ
                        </label>
                        <input
                            class="text-right w-full shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="total" name="total" type="number" placeholder="ကျသင့်ငွေ"
                            value="{{ old('total', $cargo->total) }}" readonly>
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

        function calTotal() {
            const cargoAmt = parseFloat($('#cargo_amt').val()) || 0;
            const khaukTo = parseFloat($('#khauk_to').val()) || 0;
            const deli = parseFloat($('#deli').val()) || 0;
            const bawdarFee = parseFloat($('#bawdar_fee').val()) || 0;
            const siteShin = parseFloat($('#site_shin').val()) || 0;

            const total = cargoAmt + khaukTo + deli + bawdarFee;

            $('#total').val(total);
        }

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

                $.ajax({
                    url: '{{ route('cargos.date_related_info') }}',
                    method: 'GET',
                    data: {
                        date: date
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

            $('#from_city_id').on('change', function() {
                const cityId = $(this).val();

                $.ajax({
                    url: '{{ route('cargos.gates_by_city') }}',
                    method: 'GET',
                    data: {
                        city_id: cityId
                    },
                    success: function(response) {
                        let fromGateSelect = $('#from_gate_id');
                        fromGateSelect.empty();

                        fromGateSelect.append(
                            '<option value="" disabled selected hidden>ဂိတ်ရွေးပါ</option>'
                        );

                        $.each(response.gates, function(index, gate) {
                            fromGateSelect.append(
                                `<option value="${gate.id}" data-name="${gate.mm_name}">
                            ${gate.mm_name}
                        </option>`
                            );
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching ref_no: ', error);
                    }
                });
            });

            $('#to_city_id').on('change', function() {
                const cityId = $(this).val();

                $.ajax({
                    url: '{{ route('cargos.gates_by_city') }}',
                    method: 'GET',
                    data: {
                        city_id: cityId
                    },
                    success: function(response) {
                        let toGateSelect = $('#to_gate_id');
                        toGateSelect.empty();

                        toGateSelect.append(
                            '<option value="" disabled selected hidden>ဂိတ်ရွေးပါ</option>'
                        );

                        $.each(response.gates, function(index, gate) {
                            toGateSelect.append(
                                `<option value="${gate.id}" data-name="${gate.mm_name}">
                            ${gate.mm_name}
                        </option>`
                            );
                        });
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
