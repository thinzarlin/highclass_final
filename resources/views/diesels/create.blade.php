@extends('layouts.app')

@section('content')
    <div class="pb-5 text-xl text-gray-700">

        <div class="flex justify-start mt-1">
            <a href="{{ route('diesels.index') }}" type="button"
                class="text-white bg-gray-700  focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2.5 me-2 mb-2">
                back</a>
        </div>

        <div>
            <p class="mb-2 text-3xl font-semibold">Create New Record</p>
        </div>

        <div class="w-full">
            <form method="POST" action="{{ route('diesels.store') }}" enctype="multipart/form-data"
                class="px-6 pt-4 pb-8 mb-4 bg-white rounded-lg shadow-lg">
                @csrf

                <div class="grid grid-cols-6 gap-4">
                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="ref_no">
                            Ref No
                        </label>
                        <input
                            class="w-full shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="ref_no" type="text" placeholder="Ref No" name="ref_no"
                            value="{{ old('ref_no', $ref_no) }}" readonly required>

                        @error('ref_no')
                            <div class="p-1 text-base text-red-600">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="out_date">
                            အထွက်နေ့
                        </label>
                        <input
                            class="w-full shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="out_date" type="text" placeholder="အထွက်နေ့" name="out_date" autocomplete="off"
                            value="{{ old('out_date', $today->format('d-m-Y')) }}" required>


                        @error('out_date')
                            <div class="p-1 text-base text-red-600">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="in_date">
                            အပြန်နေ့
                        </label>
                        <input
                            class="w-full shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="in_date" type="text" placeholder="အပြန်နေ့" name="in_date" autocomplete="off"
                            value="{{ old('in_date', $today->format('d-m-Y')) }}" required>


                        @error('in_date')
                            <div class="p-1 text-base text-red-600">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="purchase_date">
                            ဝယ်သည့်နေ့
                        </label>
                        <input
                            class="w-full shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="purchase_date" type="text" placeholder="ဝယ်သည့်နေ့" name="purchase_date"
                            autocomplete="off" value="{{ old('purchase_date', $today->format('d-m-Y')) }}" required>


                        @error('purchase_date')
                            <div class="p-1 text-base text-red-600">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-6 gap-4">
                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="daily_car_list_id">
                            Daily Car List
                        </label>

                        <select
                            class="shadow w-full py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="daily_car_list_id" name="daily_car_list_id">

                            <option value="" disabled selected hidden>Choose one</option>
                            @foreach ($daily_cars as $key => $daily_car)
                                <option value="{{ $daily_car->id }}"
                                    {{ old('daily_car_list_id') == $daily_car->id ? 'selected' : '' }}>
                                    {{ $daily_car->car->car_no . ' ' . $daily_car->tour->short_name }}
                                </option>
                            @endforeach

                        </select>

                        @error('daily_car_list_id')
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
                                <option value="{{ $tour->id }}" {{ old('tour_id') == $tour->id ? 'selected' : '' }}>
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
                                <option value="{{ $car->id }}" {{ old('car_id') == $car->id ? 'selected' : '' }}>
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
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="route_type">
                            In/Out
                        </label>

                        <select
                            class="shadow w-full py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="route_type" name="route_type" required>

                            @foreach (config('enums.route_types') as $key => $value)
                                <option value="{{ $key }}" {{ old('route_type') == $key ? 'selected' : '' }}>
                                    {{ $value }}
                                </option>
                            @endforeach

                        </select>

                        @error('route_type')
                            <div class="p-1 text-base text-red-600">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="payment_type">
                            Payment Type
                        </label>

                        <select
                            class="shadow w-full py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="payment_type" name="payment_type" required>

                            @foreach (config('enums.payment_types') as $key => $value)
                                <option value="{{ $key }}" {{ old('payment_type') == $key ? 'selected' : '' }}>
                                    {{ $value }}
                                </option>
                            @endforeach

                        </select>

                        @error('payment_type')
                            <div class="p-1 text-base text-red-600">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-6 gap-4">
                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="shop_id">
                            Shop
                        </label>

                        <select
                            class="select2 shadow w-185 py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="shop_id" name="shop_id" required>

                            <option value="" disabled selected hidden>Choose one</option>
                            @foreach ($shops as $key => $shop)
                                <option value="{{ $shop->id }}" {{ old('shop_id') == $shop->id ? 'selected' : '' }}>
                                    {{ $shop->name }}
                                </option>
                            @endforeach

                        </select>

                        @error('shop_id')
                            <div class="p-1 text-base text-red-600">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-span-2 mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="remark">
                            Remark
                        </label>
                        <input
                            class="w-full shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="remark" type="text" placeholder="Remark" name="remark"
                            value="{{ old('remark') }}">
                    </div>
                </div>

                <div class="grid grid-cols-8 gap-4">

                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="stock_code">
                            Stock Code
                        </label>
                        <input type="hidden" name="stock_id" value="{{ $diesel_stock->id }}">
                        <input
                            class="w-full shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="stock_code" type="text" placeholder="Stock Code"
                            value="{{ old('stock_code', $diesel_stock->code) }}" readonly>
                    </div>

                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="stock_name">
                            Stock Name
                        </label>
                        <input
                            class="w-full shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="stock_name" type="text" placeholder="Stock Name"
                            value="{{ old('stock_name', $diesel_stock->name) }}" readonly>
                    </div>

                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="liter">
                            Liter
                        </label>
                        <input
                            class="text-right w-full shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="liter" name="liter" type="number" step="any" placeholder="Liter"
                            value="{{ old('liter', 0) }}" oninput="calGallon()">
                        @error('liter')
                            <div class="p-1 text-base text-red-600">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="gallon">
                            Gallon
                        </label>
                        <input
                            class="text-right w-full shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="gallon" name="gallon" type="number" step="any" placeholder="Gallon"
                            value="{{ old('gallon', 0) }}" oninput="calLiter()">
                        @error('gallon')
                            <div class="p-1 text-base text-red-600">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="price">
                            Price
                        </label>
                        <input
                            class="text-right w-full shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="price" name="price" type="number" step="any" placeholder="Price"
                            value="{{ old('price', 0) }}" oninput="calAmount()">
                        @error('price')
                            <div class="p-1 text-base text-red-600">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="discount">
                            Discount
                        </label>
                        <input
                            class="text-right w-full shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="discount" name="discount" type="number" step="any" placeholder="Discount"
                            value="{{ old('discount', 0) }}" oninput="calAmount()">
                        @error('discount')
                            <div class="p-1 text-base text-red-600">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="amount">
                            Amount
                        </label>
                        <input
                            class="text-right w-full shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="amount" name="amount" type="number" step="any" placeholder="Amount"
                            value="{{ old('amount', 0) }}" readonly>
                        @error('amount')
                            <div class="p-1 text-base text-red-600">
                                {{ $message }}
                            </div>
                        @enderror
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
    </div>
@endSection

@section('scripts')
    <script>
        $('.select2').select2();

        let dailyCars = @json($daily_cars);
        const litersInGallon = parseFloat({{ config('ownermain.liters_in_gallon') }}) || 0;

        let selectedDailyCar;

        $('#payment_type').val('credit');

        function calGallon() {
            const liter = parseFloat($('#liter').val()) || 0;
            $('#gallon').val((liter / litersInGallon).toFixed(3));

            calAmount();
        }

        function calLiter() {
            const gallon = parseFloat($('#gallon').val()) || 0;
            $('#litter').val((gallon * litersInGallon).toFixed(3));

            calAmount();
        }

        function calAmount() {
            const liter = parseFloat($('#liter').val()) || 0;
            const price = parseFloat($('#price').val()) || 0;
            const discount = parseFloat($('#discount').val()) || 0;

            $('#amount').val((liter * price - discount).toFixed(0));
        }

        $(document).ready(function() {

            var picker1 = new Pikaday({
                field: document.getElementById('out_date'),
                format: 'DD-MM-YYYY',
            });

            var picker2 = new Pikaday({
                field: document.getElementById('in_date'),
                format: 'DD-MM-YYYY',
            });

            var picker3 = new Pikaday({
                field: document.getElementById('purchase_date'),
                format: 'DD-MM-YYYY',
            });

            function formatDate(date) {
                const arr = date.split('-');
                if (arr.length == 0) {
                    return '';
                }
                return `${arr[2]}-${arr[1]}-${arr[0]}`;
            }

            $('#in_date').on('change', function() {
                const in_date = formatDate($(this).val());

                $.ajax({
                    url: '{{ route('diesels.in_date_related_info') }}',
                    method: 'GET',
                    data: {
                        in_date: in_date
                    },
                    success: function(response) {
                        $('#ref_no').val(response.ref_no);

                        let dailyCarSelect = $('#daily_car_list_id');
                        dailyCarSelect.empty();

                        dailyCarSelect.append(
                            '<option value="" disabled selected hidden>Choose one</option>');

                        if (response.daily_cars.length > 0) {
                            dailyCars = response.daily_cars;

                            $.each(response.daily_cars, function(index, daily_car) {
                                dailyCarSelect.append(
                                    `<option value="${daily_car.id}">
                            ${daily_car.car.car_no} ${daily_car.tour.short_name}
                        </option>`
                                );
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching ref_no: ', error);
                    }
                });
            });

            $('#daily_car_list_id').on('change', function() {
                const dailyCarListId = $(this).val();

                if (typeof dailyCars !== 'undefined' && Array.isArray(dailyCars)) {
                    selectedDailyCar = dailyCars.find(car => car.id == dailyCarListId);
                    // $('#tour').val(selectedDailyCar.tour.short_name);
                    // $('#car_no').val(selectedDailyCar.car.car_no);
                    $('#tour_id').val(selectedDailyCar.tour_id);
                    $('#car_id').val(selectedDailyCar.car_id);

                    $('#route_type').val(selectedDailyCar.tour.route_type);
                } else {
                    console.error('dailyCars array is not available');
                }
            });

            $('#tour_id').on('change', function() {
                const tourId = $(this).val();

                if (selectedDailyCar.tour_id != tourId) {
                    $('#daily_car_list_id').val('');
                }
            });

            $('#car_id').on('change', function() {
                const carId = $(this).val();

                if (selectedDailyCar.car_id != carId) {
                    $('#daily_car_list_id').val('');
                }
            });

            $('#liter').on('keydown', function(event) {
                if (event.key === "Enter") {
                    focusTarget("#price");
                    selectTarget("#price");
                }
            });

            $('#gallon').on('keydown', function(event) {
                if (event.key === "Enter") {
                    focusTarget("#price");
                    selectTarget("#price");
                }
            });

            $('#price').on('keydown', function(event) {
                if (event.key === "Enter") {
                    focusTarget("#discount");
                    selectTarget("#discount");
                }
            });

            $(':input').keypress(function(e) {
                var code = e.keyCode || e.which;
                if (code == 13)
                    return false;
            });

        });
    </script>
@endsection
