@extends('layouts.app')

@section('content')
    <div class="pb-5 text-xl text-gray-700">

        <div class="flex justify-start mt-1">
            <a href="{{ route('home-car-mains.index') }}" type="button"
                class="text-white bg-gray-700  focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2.5 me-2 mb-2">
                back</a>
        </div>

        <div>
            <p class="mb-2 text-3xl font-semibold">Create New Record</p>
        </div>

        <div class="w-full">
            <form method="POST" action="{{ route('home-car-mains.store') }}" enctype="multipart/form-data"
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
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="daily_car_list_id">
                            Daily Car List
                        </label>

                        <select
                            class="shadow w-full py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="daily_car_list_id" name="daily_car_list_id" required>

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

                    {{-- <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="tour_id">
                            Tours
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
                            <div class="p-1 text-base text-red-600">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="car_id">
                            Cars
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
                            <div class="p-1 text-base text-red-600">
                                {{ $message }}
                            </div>
                        @enderror
                    </div> --}}

                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="tour">
                            ခရီးစဉ်
                        </label>
                        <input
                            class="w-full shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="tour" name="tour" type="text" placeholder="ခရီးစဉ်" value="{{ old('tour') }}" readonly>
                    </div>

                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="car_no">
                            ကားနံပါတ်
                        </label>
                        <input
                            class="w-full shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="car_no" name="car_no" type="text" placeholder="ကားနံပါတ်" value="{{ old('car_no') }}" readonly>
                    </div>
                </div>

                <div class="grid grid-cols-4 gap-4">
                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="driver_1">
                            ယာဉ်မောင်း ၁
                        </label>
                        <input
                            class="w-full shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="driver_1" name="driver_1" type="text" placeholder="ယာဉ်မောင်း ၁" value="{{ old('driver_1') }}"
                            readonly>
                    </div>

                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="driver_2">
                            ယာဉ်မောင်း ၂
                        </label>
                        <input
                            class="w-full shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="driver_2" name="driver_2" type="text" placeholder="ယာဉ်မောင်း ၂" value="{{ old('driver_2') }}"
                            readonly>
                    </div>

                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="spare">
                            နောက်လိုက်
                        </label>
                        <input
                            class="w-full shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="spare" name="spare" type="text" placeholder="နောက်လိုက်" value="{{ old('spare') }}" readonly>
                    </div>

                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="crew">
                            ယာဉ်မောင်/ယာဉ်မယ်
                        </label>
                        <input
                            class="w-full shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="crew" name="crew" type="text" placeholder="ယာဉ်မောင်/ယာဉ်မယ်" value="{{ old('crew') }}"
                            readonly>
                    </div>
                </div>

                <div class="grid grid-cols-4 gap-4">

                    <div class="col-span-2 mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="remark">
                            Remark
                        </label>
                        <input
                            class="w-full shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="remark" type="text" placeholder="Remark" name="remark"
                            value="{{ old('remark', 'ကြက်ကြော်') }}">
                    </div>

                </div>

                {{-- Ticket --}}
                <section class="bg-slate-50 px-4 py-2 border rounded-lg shadow my-2 text-gray-800">
                    <div class="flex items-center justify-between" id="ticketToggleSection">
                        <p class="text-xl font-semibold">Ticket Detail</p>
                        <button type="button" class="px-4 py-2 focus:outline-none">
                            <svg class="w-6 h-6 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="none" viewBox="0 0 24 24" id="ticketShowBtn">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m19 9-7 7-7-7" />
                            </svg>
                            <svg class="w-6 h-6 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="none" viewBox="0 0 24 24" id="ticketHideBtn">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m5 15 7-7 7 7" />
                            </svg>
                        </button>
                    </div>

                    <div id="ticketSection">
                        <div class="grid grid-cols-9 gap-4">
                            <div class="hidden mb-2">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="ticket_line_no">
                                    Line No
                                </label>
                                <input
                                    class="text-right w-full shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                                    id="ticket_line_no" name="max_ticket_line_no" type="number" min="0"
                                    value="{{ old('max_ticket_line_no', 1) }}">
                            </div>

                            <div class="col-span-2 mb-2">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="ticket_type">
                                    Type
                                </label>

                                <select
                                    class="shadow w-full py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                    id="ticket_type">

                                    <option value="" disabled selected hidden>Choose Type</option>
                                    @foreach (config('enums.home_car_main_ticket_types') as $key => $value)
                                        <option value="{{ $key }}" data-name="{{ $value }}">
                                            {{ $value }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="mb-2">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="ticket_people">
                                    People
                                </label>
                                <input
                                    class="text-right w-full shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                                    id="ticket_people" type="number" placeholder="People" min="0"
                                    value="0">
                            </div>

                            <div class="mb-2">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="ticket_amount">
                                    Amount
                                </label>
                                <input
                                    class="text-right w-full shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                                    id="ticket_amount" type="number" placeholder="Amount" min="0"
                                    value="0">
                            </div>

                            <div class="col-span-2 mb-2">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="ticket_remark">
                                    Remark
                                </label>
                                <input
                                    class="w-full shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                                    id="ticket_remark" type="text" placeholder="Remark">
                            </div>

                            <div class="mb-2 mt-7">
                                <button
                                    class="px-5 py-2.5 font-bold text-base text-white bg-blue-500 rounded-lg hover:bg-blue-700 focus:outline-none focus:shadow-outline"
                                    type="button" id="ticketAddBtn">
                                    Add
                                </button>
                            </div>

                        </div>

                        <div class="grid grid-cols-5 gap-5 mb-4">
                            <div class="relative overflow-x-auto col-span-4">
                                <table
                                    class="w-full text-sm text-left rtl:text-right text-gray-500 shadow-md ticket-table datatable">
                                    <thead class="text-sm text-white font-bold text-center uppercase bg-blue-400">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 w-2 border-blue-300"></th>
                                            <th scope="col" class="px-6 py-3 w-2 border-blue-300">
                                                No.
                                            </th>
                                            <th scope="col" class="px-6 py-3 border-blue-300">
                                                Type
                                            </th>
                                            <th scope="col" class="px-6 py-3 w-1 border-blue-300">
                                                People
                                            </th>
                                            <th scope="col" class="px-6 py-3 border-blue-300">
                                                Amount
                                            </th>
                                            <th scope="col" class="px-6 py-3 border-blue-300">
                                                Remark
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="bg-slate-50 text-gray-800 text-sm border-b border-gray-200">
                                            <td class="px-3 py-2 border">
                                                <button type="button" class="ticketDeleteBtn">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                        fill="currentColor" class="w-5 h-5">
                                                        <path fill-rule="evenodd"
                                                            d="M8.75 1A2.75 2.75 0 0 0 6 3.75v.443c-.795.077-1.584.176-2.365.298a.75.75 0 1 0 .23 1.482l.149-.022.841 10.518A2.75 2.75 0 0 0 7.596 19h4.807a2.75 2.75 0 0 0 2.742-2.53l.841-10.52.149.023a.75.75 0 0 0 .23-1.482A41.03 41.03 0 0 0 14 4.193V3.75A2.75 2.75 0 0 0 11.25 1h-2.5ZM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4ZM8.58 7.72a.75.75 0 0 0-1.5.06l.3 7.5a.75.75 0 1 0 1.5-.06l-.3-7.5Zm4.34.06a.75.75 0 1 0-1.5-.06l-.3 7.5a.75.75 0 1 0 1.5.06l.3-7.5Z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </button>
                                            </td>
                                            <td class="px-3 py-2 text-right border">
                                                <input type="hidden" value="{{ 1 }}"
                                                    name='ticket_line_no[]'>
                                                1
                                            </td>
                                            <td class="px-3 py-2 border">
                                                <input type="hidden" value="{{'cash' }}"
                                                    name='ticket_type[]'>
                                                <input type="hidden" value="{{ 'လက်ငင်း' }}"
                                                    name='ticket_type_name[]'>
                                                လက်ငင်း
                                            </td>
                                            <td class="px-3 py-2 text-right border">
                                                <input type="hidden" value="{{ 1 }}"
                                                    name='ticket_people[]'>1
                                            </td>
                                            <td class="px-3 py-2 text-right border">
                                                <input type="hidden" value="{{ 100000 }}"
                                                    name='ticket_amount[]'>100000
                                            </td>
                                            <td class="px-3 py-2 border">
                                                <input type="hidden" value=""
                                                    name='ticket_remark[]'>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="grid grid-cols-2 text-sm gap-y-3 text-gray-800">
                                <p>လက်ငင်း</p>
                                <p>: <span id="total_ticket_cash_label">0</span></p>
                                <p>လမ်းတောင်း</p>
                                <p>: <span id="total_ticket_lan_tg_label">0</span></p>
                                <p>ရန်ကုန်</p>
                                <p>: <span id="total_ticket_ygn_tg_label">0</span></p>
                                <p>နောက်ကားနဲ့ပါ</p>
                                <p>: <span id="total_ticket_next_car_label">0</span></p>
                            </div>
                        </div>

                        @error('ticket_line_no')
                            <div class="p-1 text-base text-red-600">
                                The tickets cannot be empty.
                            </div>
                        @enderror

                        <div class="justify-end gap-5 hidden">
                            <div class="mt-2 ">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="total_ticket_cash">
                                    လက်ငင်း Total
                                </label>
                                <input
                                    class="text-right w-32 shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                                    id="total_ticket_cash" name="total_ticket_cash" type="number"
                                    placeholder="လက်ငင်း Total" value="{{ old('total_ticket_cash', 0) }}" readonly>
                            </div>

                            <div class="mt-2">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="total_ticket_lan_tg">
                                    လမ်းတောင်း Total
                                </label>
                                <input
                                    class="text-right w-32 shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                                    id="total_ticket_lan_tg" name="total_ticket_lan_tg" type="number"
                                    placeholder="လမ်းတောင်း Total" value="{{ old('total_ticket_lan_tg', 0) }}" readonly>
                            </div>

                            <div class="mt-2">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="total_ticket_ygn_tg">
                                    ရန်ကုန် Total
                                </label>
                                <input
                                    class="text-right w-32 shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                                    id="total_ticket_ygn_tg" name="total_ticket_ygn_tg" type="number"
                                    placeholder="ရန်ကုန် Total" value="{{ old('total_ticket_ygn_tg', 0) }}" readonly>
                            </div>

                            <div class="mt-2">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="total_ticket_next_car">
                                    နောက်ကားနဲ့ပါ Total
                                </label>
                                <input
                                    class="text-right w-32 shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                                    id="total_ticket_next_car" name="total_ticket_next_car" type="number"
                                    placeholder="နောက်ကားနဲ့ပါ Total" value="{{ old('total_ticket_next_car', 0) }}"
                                    readonly>
                            </div>
                        </div>
                    </div>
                </section>

                <div class="flex justify-end gap-5">
                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="total_people">
                            Total People
                        </label>
                        <input
                            class="text-right w-32 shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="total_people" name="total_people" type="number" placeholder="လူဦးရေ Total"
                            value="{{ old('total_people', 0) }}" readonly>
                    </div>

                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="total_ticket">
                            Total
                        </label>
                        <input
                            class="text-right w-32 shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="total_ticket" name="total_ticket" type="number" placeholder="Total"
                            value="{{ old('total_ticket', 0) }}" readonly>
                    </div>

                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="insurance">
                            (-) အာမခံ
                        </label>
                        <input type="hidden" id="insurance_rate" value="0">
                        <input
                            class="text-right w-32 shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="insurance" name="insurance" type="number" placeholder="အာမခံ"
                            value="{{ old('insurance', 0) }}" oninput="calTicketIncome()">
                    </div>

                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="ticket_income">
                            Ticket Income
                        </label>
                        <input
                            class="text-right w-32 shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="ticket_income" name="ticket_income" type="number" placeholder="Ticket Income"
                            value="{{ old('ticket_income', 0) }}" readonly>
                    </div>
                </div>

                {{-- <div class="flex justify-end gap-5">
                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="insurance">
                            (-) အာမခံ
                        </label>
                        <input type="hidden" id="insurance_rate" value="0">
                        <input
                            class="text-right w-32 shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="insurance" name="insurance" type="number" placeholder="အာမခံ"
                            value="{{ old('insurance', 0) }}" oninput="calTicketIncome()">
                    </div>
                </div> --}}

                {{-- <div class="flex justify-end gap-5">
                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="ticket_income">
                            Ticket Income
                        </label>
                        <input
                            class="text-right w-32 shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="ticket_income" name="ticket_income" type="number" placeholder="Ticket Income"
                            value="{{ old('ticket_income', 0) }}" readonly>
                    </div>
                </div> --}}

                <section class="bg-slate-50 px-4 py-2 border rounded-lg shadow my-2 text-gray-800">
                    <div class="flex items-center justify-between mb-2" id="cargoToggleSection">
                        <p class="text-xl font-semibold">Cargo Detail</p>
                        <button type="button" class="px-4 py-2 focus:outline-none">
                            <svg class="w-6 h-6 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="none" viewBox="0 0 24 24" id="cargoShowBtn">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m19 9-7 7-7-7" />
                            </svg>
                            <svg class="w-6 h-6 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="none" viewBox="0 0 24 24" id="cargoHideBtn">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m5 15 7-7 7 7" />
                            </svg>
                        </button>
                    </div>

                    <div id="cargoSection">
                        <div class="grid grid-cols-8 gap-5">
                            <div class="mb-2">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="total_cargo">
                                    တန်ဆာစုစုပေါင်း
                                </label>
                                <input
                                    class="text-right w-32 shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                                    id="total_cargo" name="total_cargo" type="number" placeholder="တန်ဆာစုစုပေါင်း"
                                    value="{{ old('total_cargo', 0) }}" oninput="calCashCargo('total')">
                            </div>

                            <div class="mb-2">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="cash_cargo">
                                    ရှင်းပြီးတန်ဆာ
                                </label>
                                <input
                                    class="text-right w-32 shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                                    id="cash_cargo" name="cash_cargo" type="number" placeholder="ရှင်းပြီးတန်ဆာ"
                                    value="{{ old('cash_cargo', 0) }}" oninput="calCashCargo('cash')">
                            </div>

                            <div class="mb-2">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="credit_cargo">
                                    ကုန်ကြွေး
                                </label>
                                <input
                                    class="text-right w-32 shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                                    id="credit_cargo" name="credit_cargo" type="number" placeholder="ကုန်ကြွေး"
                                    value="{{ old('credit_cargo', 0) }}" oninput="calCashCargo('credit')">
                            </div>

                            <div class="mb-2">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="cargo_bd">
                                    (-) Cargo BD
                                </label>
                                <input
                                    class="text-right w-32 shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                                    id="cargo_bd" name="cargo_bd" type="number" placeholder="Cargo BD"
                                    value="{{ old('cargo_bd', 0) }}" oninput="calCargoIncome()">
                            </div>

                            <div class="mb-2">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="lu_par_cargo">
                                    (+) လူပါတန်ဆာ
                                </label>
                                <input
                                    class="text-right w-32 shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                                    id="lu_par_cargo" name="lu_par_cargo" type="number" placeholder="လူပါတန်ဆာ"
                                    value="{{ old('lu_par_cargo', 0) }}" oninput="calCargoIncome()">
                            </div>
                        </div>

                        <div>
                            <p class="my-2 text-lg font-medium">အသွားကုန်ကြွေးပေါင်းချုပ်စာရင်း</p>
                        </div>

                        <div class="grid grid-cols-7 gap-4">
                            <div class="hidden mb-2">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="out_cargo_line_no">
                                    Line No
                                </label>
                                <input
                                    class="text-right w-full shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                                    id="out_cargo_line_no" name="max_out_cargo_line_no" type="number" min="0"
                                    value="{{ old('max_out_cargo_line_no', 1) }}">
                            </div>

                            <div class="mb-2">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="out_cargo_city_id">
                                    မြို့ (ဂိတ်)
                                </label>

                                <select
                                    class="shadow w-full py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                    id="out_cargo_city_id">
                                    <option value="" disabled selected hidden>Choose City</option>
                                </select>
                            </div>

                            <div class="mb-2">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="out_credit_cargo">
                                    အသားတင်ကုန်ကြွေး (+)
                                </label>
                                <input
                                    class="text-right w-full shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                                    id="out_credit_cargo" type="number" placeholder="အသားတင်ကုန်ကြွေး" min="0"
                                    value="0">
                            </div>

                            <div class="mb-2">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="out_cargo_deli">
                                    အရောက်ပို့လက်ငင်း (-)
                                </label>
                                <input
                                    class="text-right w-full shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                                    id="out_cargo_deli" type="number" placeholder="အရောက်ပို့လက်ငင်း" min="0"
                                    value="0">
                            </div>

                            <div class="mb-2">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="out_credit_khauk_to">
                                    ခေါက်တိုကြွေး (+)
                                </label>
                                <input
                                    class="text-right w-full shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                                    id="out_credit_khauk_to" type="number" placeholder="ခေါက်တိုကြွေး" min="0"
                                    value="0">
                            </div>

                            <div class="mb-2">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="out_site_shin">
                                    စိုက်ရှင်းငွေ (+)
                                </label>
                                <input
                                    class="text-right w-full shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                                    id="out_site_shin" type="number" placeholder="စိုက်ရှင်းငွေ" min="0"
                                    value="0">
                            </div>

                            <div class="mb-2">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="out_cargo_percent">
                                    အသွား ဂိတ် % (-)
                                </label>
                                <input
                                    class="text-right w-full shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                                    id="out_cargo_percent" type="number" placeholder="အသွား ဂိတ် %" min="0"
                                    value="0">
                            </div>

                            <div class="mb-2 mt-6 flex gap-3">
                                <div>
                                    <input id="out_cargo_paid" type="checkbox" value="" checked
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 focus:ring-2">
                                    <label for="out_cargo_paid"
                                        class="ms-2 text-sm font-medium text-gray-900">ရှင်းပြီး</label>
                                </div>

                                <div>
                                    <button
                                        class="px-5 py-2.5 font-bold text-base text-white bg-blue-500 rounded-lg hover:bg-blue-700 focus:outline-none focus:shadow-outline"
                                        type="button" id="outCargoAddBtn">
                                        Add
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-5 gap-5 mb-4">
                            <div class="relative overflow-x-auto col-span-4">
                                <table
                                    class="w-full text-sm text-left rtl:text-right text-gray-500 shadow-md out-cargo-table datatable">
                                    <thead class="text-sm text-white font-bold text-center uppercase bg-blue-400">
                                        <tr>
                                            <th scope="col" class="px-2 py-3 w-2 border-blue-300"></th>
                                            <th scope="col" class="px-2 py-3 w-2 border-blue-300">
                                                No.
                                            </th>
                                            <th scope="col" class="px-2 py-3 border-blue-300">
                                                မြို့ (ဂိတ်)
                                            </th>
                                            <th scope="col" class="px-2 py-3 border-blue-300">
                                                အသားတင်ကုန်ကြွေး
                                            </th>
                                            <th scope="col" class="px-2 py-3 border-blue-300">
                                                အရောက်ပို့လက်ငင်း
                                            </th>
                                            <th scope="col" class="px-2 py-3 border-blue-300">
                                                ခေါက်တိုကြွေး
                                            </th>
                                            <th scope="col" class="px-2 py-3 border-blue-300">
                                                စိုက်ရှင်းငွေ
                                            </th>
                                            <th scope="col" class="px-2 py-3 border-blue-300">
                                                အသွား ဂိတ် %
                                            </th>
                                            <th scope="col" class="px-1 py-3 w-1 text-xs border-blue-300">
                                                ရှင်းပြီး
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="bg-slate-50 text-gray-800 text-sm border-b border-gray-200">
                                            <td class="px-3 py-2 border">
                                                <button type="button" class="outCargoDeleteBtn">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                        fill="currentColor" class="w-5 h-5">
                                                        <path fill-rule="evenodd"
                                                            d="M8.75 1A2.75 2.75 0 0 0 6 3.75v.443c-.795.077-1.584.176-2.365.298a.75.75 0 1 0 .23 1.482l.149-.022.841 10.518A2.75 2.75 0 0 0 7.596 19h4.807a2.75 2.75 0 0 0 2.742-2.53l.841-10.52.149.023a.75.75 0 0 0 .23-1.482A41.03 41.03 0 0 0 14 4.193V3.75A2.75 2.75 0 0 0 11.25 1h-2.5ZM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4ZM8.58 7.72a.75.75 0 0 0-1.5.06l.3 7.5a.75.75 0 1 0 1.5-.06l-.3-7.5Zm4.34.06a.75.75 0 1 0-1.5-.06l-.3 7.5a.75.75 0 1 0 1.5.06l.3-7.5Z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </button>
                                            </td>
                                            <td class="px-3 py-2 text-right border">
                                                <input type="hidden" value="{{ 1 }}"
                                                    name='out_cargo_line_no[]'>
                                                1
                                            </td>
                                            <td class="px-3 py-2 border">
                                                <input type="hidden" value="{{ '1' }}"
                                                    name='out_cargo_city_id[]'>
                                                <input type="hidden" value="{{ 'Yangon' }}"
                                                    name='out_cargo_city_name[]'>
                                                Yangon
                                            </td>
                                            <td class="px-3 py-2 text-right border">
                                                <input type="hidden" value="{{ 100000 }}"
                                                    name='out_credit_cargo[]'>100000
                                            </td>
                                            <td class="px-3 py-2 text-right border">
                                                <input type="hidden" value="{{ 5000 }}"
                                                    name='out_cargo_deli[]'>5000
                                            </td>
                                            <td class="px-3 py-2 text-right border">
                                                <input type="hidden" value="{{ 0 }}"
                                                    name='out_credit_khauk_to[]'>0
                                            </td>
                                            <td class="px-3 py-2 text-right border">
                                                <input type="hidden" value="{{ 0 }}"
                                                    name='out_site_shin[]'>0
                                            </td>
                                            <td class="px-3 py-2 text-right border">
                                                <input type="hidden" value="{{ 0 }}"
                                                    name='out_cargo_percent[]'>0
                                            </td>
                                            <td class="px-3 py-2 text-center border">
                                                <input type="hidden" value="{{ true }}"
                                                    name='out_cargo_paid[]'>Yes
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="grid grid-cols-2 text-sm gap-y-3 text-gray-800">
                                <p>အသားတင်ကုန်ကြွေး</p>
                                <p>: <span id="total_out_credit_cargo_label">0</span></p>
                                <p>အရောက်ပို့လက်ငင်း</p>
                                <p>: <span id="total_out_cargo_deli_label">0</span></p>
                                <p>ခေါက်တိုကြွေး</p>
                                <p>: <span id="total_out_credit_khauk_to_label">0</span></p>
                                <p>စိုက်ရှင်းငွေ</p>
                                <p>: <span id="total_out_site_shin_label">0</span></p>
                                <p>အသွား ဂိတ် %</p>
                                <p>: <span id="total_out_cargo_percent_label">0</span></p>
                            </div>
                        </div>

                        <div class="justify-end gap-5 hidden">
                            <div class="mt-2 ">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="total_out_credit_cargo">
                                    အသားတင်ကုန်ကြွေး Total
                                </label>
                                <input
                                    class="text-right w-32 shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                                    id="total_out_credit_cargo" name="total_out_credit_cargo" type="number"
                                    placeholder="အသားတင်ကုန်ကြွေး Total" value="{{ old('total_out_credit_cargo', 0) }}"
                                    readonly>
                            </div>

                            <div class="mt-2">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="total_out_cargo_deli">
                                    အရောက်ပို့လက်ငင်း Total
                                </label>
                                <input
                                    class="text-right w-32 shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                                    id="total_out_cargo_deli" name="total_out_cargo_deli" type="number"
                                    placeholder="အရောက်ပို့လက်ငင်း Total" value="{{ old('total_out_cargo_deli', 0) }}"
                                    readonly>
                            </div>

                            <div class="mt-2">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="total_out_credit_khauk_to">
                                    ခေါက်တိုကြွေး Total
                                </label>
                                <input
                                    class="text-right w-32 shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                                    id="total_out_credit_khauk_to" name="total_out_credit_khauk_to" type="number"
                                    placeholder="ခေါက်တိုကြွေး Total" value="{{ old('total_out_credit_khauk_to', 0) }}"
                                    readonly>
                            </div>

                            <div class="mt-2">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="total_out_site_shin">
                                    စိုက်ရှင်းငွေ Total
                                </label>
                                <input
                                    class="text-right w-32 shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                                    id="total_out_site_shin" name="total_out_site_shin" type="number"
                                    placeholder="စိုက်ရှင်းငွေ Total" value="{{ old('total_out_site_shin', 0) }}"
                                    readonly>
                            </div>

                            <div class="mt-2">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="total_out_cargo_percent">
                                    အသွား ဂိတ် % Total
                                </label>
                                <input
                                    class="text-right w-32 shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                                    id="total_out_cargo_percent" name="total_out_cargo_percent" type="number"
                                    placeholder="အသွား ဂိတ် % Total" value="{{ old('total_out_cargo_percent', 0) }}"
                                    readonly>
                            </div>
                        </div>
                    </div>
                </section>

                <div class="flex justify-end gap-5">
                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="cargo_income">
                            Cargo Income
                        </label>
                        <input
                            class="text-right w-32 shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="cargo_income" name="cargo_income" type="number" placeholder="Cargo Income"
                            value="{{ old('cargo_income', 0) }}" readonly>
                    </div>
                </div>

                <div class="flex justify-end gap-5">
                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="grand_total">
                            Grand Total
                        </label>
                        <input readonly
                            class="text-right w-32 shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="grand_total" name="grand_total" type="number" placeholder="Grand Total"
                            value="{{ old('grand_total', 0) }}">
                    </div>
                </div>

                <div class="flex justify-end gap-5">
                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="gate_percent">
                            ဂိတ် %
                        </label>
                        <input readonly
                            class="text-right w-32 shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="gate_percent" name="gate_percent" type="number" placeholder="ဂိတ် %"
                            value="{{ old('gate_percent', 0) }}">
                    </div>

                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="gate_commission">
                            (-) ဂိတ်ကြေး
                        </label>
                        <input readonly
                            class="text-right w-32 shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="gate_commission" name="gate_commission" type="number" placeholder="ဂိတ်ကြေး"
                            value="{{ old('gate_commission', 0) }}">
                    </div>
                </div>

                <section class="bg-slate-50 px-4 py-2 border rounded-lg shadow my-2 text-gray-800">
                    <div class="flex items-center justify-between mb-2" id="expenseToggleSection">
                        <p class="text-xl font-semibold">Expenses</p>
                        <button type="button" class="px-4 py-2 focus:outline-none">
                            <svg class="w-6 h-6 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="none" viewBox="0 0 24 24" id="expenseShowBtn">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m19 9-7 7-7-7" />
                            </svg>
                            <svg class="w-6 h-6 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="none" viewBox="0 0 24 24" id="expenseHideBtn">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m5 15 7-7 7 7" />
                            </svg>
                        </button>
                    </div>

                    <div id="expenseSection">
                        <div class="grid lg:grid-cols-8 md:grid-cols-4 gap-5">
                            <div class="mb-2">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="water_small_qty">
                                    ရေသန့်အသေး
                                </label>
                                <input
                                    class="text-right w-32 shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                                    id="water_small_qty" name="water_small_qty" type="number" placeholder="ရေသန့်အသေး"
                                    value="{{ old('water_small_qty', 0) }}"
                                    oninput="calExpenseAmt('water_small', this.value)">
                            </div>

                            <div class="mb-2">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="water_small_amt">
                                    Amount
                                </label>
                                <input
                                    class="text-right w-32 shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                                    id="water_small_amt" name="water_small_amt" type="number" placeholder="Amount"
                                    value="{{ old('water_small_amt', 0) }}" oninput="calExpenseTotal()">
                            </div>

                            <div class="mb-2">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="water_large_qty">
                                    ရေသန့်အကြီး
                                </label>
                                <input
                                    class="text-right w-32 shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                                    id="water_large_qty" name="water_large_qty" type="number" placeholder="ရေသန့်အကြီး"
                                    value="{{ old('water_large_qty', 0) }}"
                                    oninput="calExpenseAmt('water_large', this.value)">
                            </div>

                            <div class="mb-2">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="water_large_amt">
                                    Amount
                                </label>
                                <input
                                    class="text-right w-32 shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                                    id="water_large_amt" name="water_large_amt" type="number" placeholder="Amount"
                                    value="{{ old('water_large_amt', 0) }}" oninput="calExpenseTotal()">
                            </div>

                            <div class="mb-2">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="drink_qty">
                                    အအေး
                                </label>
                                <input
                                    class="text-right w-32 shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                                    id="drink_qty" name="drink_qty" type="number" placeholder="အအေး"
                                    value="{{ old('drink_qty', 0) }}" oninput="calExpenseAmt('drink', this.value)">
                            </div>

                            <div class="mb-2">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="drink_amt">
                                    Amount
                                </label>
                                <input
                                    class="text-right w-32 shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                                    id="drink_amt" name="drink_amt" type="number" placeholder="Amount"
                                    value="{{ old('drink_amt', 0) }}" oninput="calExpenseTotal()">
                            </div>

                            <div class="mb-2">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="snack_qty">
                                    မုန့်
                                </label>
                                <input
                                    class="text-right w-32 shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                                    id="snack_qty" name="snack_qty" type="number" placeholder="မုန့်"
                                    value="{{ old('snack_qty', 0) }}" oninput="calExpenseAmt('snack', this.value)">
                            </div>

                            <div class="mb-2">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="snack_amt">
                                    Amount
                                </label>
                                <input
                                    class="text-right w-32 shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                                    id="snack_amt" name="snack_amt" type="number" placeholder="Amount"
                                    value="{{ old('snack_amt', 0) }}" oninput="calExpenseTotal()">
                            </div>

                            <div class="mb-2">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="snack_special_qty">
                                    မုန့် (အထူး)
                                </label>
                                <input
                                    class="text-right w-32 shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                                    id="snack_special_qty" name="snack_special_qty" type="number"
                                    placeholder="မုန့် (အထူး)" value="{{ old('snack_special_qty', 0) }}"
                                    oninput="calExpenseAmt('snack_special', this.value)">
                            </div>

                            <div class="mb-2">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="snack_special_amt">
                                    Amount
                                </label>
                                <input
                                    class="text-right w-32 shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                                    id="snack_special_amt" name="snack_special_amt" type="number" placeholder="Amount"
                                    value="{{ old('snack_special_amt', 0) }}" oninput="calExpenseTotal()">
                            </div>

                            <div class="mb-2">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="towel_qty">
                                    တာဝါ
                                </label>
                                <input
                                    class="text-right w-32 shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                                    id="towel_qty" name="towel_qty" type="number" placeholder="တာဝါ"
                                    value="{{ old('towel_qty', 0) }}" oninput="calExpenseAmt('towel', this.value)">
                            </div>

                            <div class="mb-2">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="towel_amt">
                                    Amount
                                </label>
                                <input
                                    class="text-right w-32 shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                                    id="towel_amt" name="towel_amt" type="number" placeholder="Amount"
                                    value="{{ old('towel_amt', 0) }}" oninput="calExpenseTotal()">
                            </div>

                            <div class="mb-2">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="plastic_bag_qty">
                                    ကျွတ်ကျွတ်
                                </label>
                                <input
                                    class="text-right w-32 shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                                    id="plastic_bag_qty" name="plastic_bag_qty" type="number" placeholder="ကျွတ်ကျွတ်"
                                    value="{{ old('plastic_bag_qty', 0) }}"
                                    oninput="calExpenseAmt('plastic_bag', this.value)">
                            </div>

                            <div class="mb-2">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="plastic_bag_amt">
                                    Amount
                                </label>
                                <input
                                    class="text-right w-32 shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                                    id="plastic_bag_amt" name="plastic_bag_amt" type="number" placeholder="Amount"
                                    value="{{ old('plastic_bag_amt', 0) }}" oninput="calExpenseTotal()">
                            </div>

                            <div class="mb-2">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="candy_qty">
                                    သကြားလုံး
                                </label>
                                <input
                                    class="text-right w-32 shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                                    id="candy_qty" name="candy_qty" type="number" placeholder="သကြားလုံး"
                                    value="{{ old('candy_qty', 0) }}" oninput="calExpenseAmt('candy', this.value)">
                            </div>

                            <div class="mb-2">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="candy_amt">
                                    Amount
                                </label>
                                <input
                                    class="text-right w-32 shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                                    id="candy_amt" name="candy_amt" type="number" placeholder="Amount"
                                    value="{{ old('candy_amt', 0) }}" oninput="calExpenseTotal()">
                            </div>

                            <div class="mb-2">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="guest_reg">
                                    ဧည့်
                                </label>
                                <input
                                    class="text-right w-32 shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                                    id="guest_reg" name="guest_reg" type="number" placeholder="ဧည့်"
                                    value="{{ old('guest_reg', 0) }}" oninput="calExpenseTotal()">
                            </div>

                            <div class="mb-2">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="medicine">
                                    ဆေး
                                </label>
                                <input
                                    class="text-right w-32 shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                                    id="medicine" name="medicine" type="number" placeholder="ဆေး"
                                    value="{{ old('medicine', 0) }}" oninput="calExpenseTotal()">
                            </div>

                            <div class="mb-2">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="coffee">
                                    Coffee
                                </label>
                                <input
                                    class="text-right w-32 shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                                    id="coffee" name="coffee" type="number" placeholder="Coffee"
                                    value="{{ old('coffee', 0) }}" oninput="calExpenseTotal()">
                            </div>

                            <div class="mb-2">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="coffee_cup">
                                    Coffee Cup
                                </label>
                                <input
                                    class="text-right w-32 shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                                    id="coffee_cup" name="coffee_cup" type="number" placeholder="Coffee Cup"
                                    value="{{ old('coffee_cup', 0) }}" oninput="calExpenseTotal()">
                            </div>

                            <div class="mb-2">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="ticket_disc">
                                    ကံထူးရှင်
                                </label>
                                <input
                                    class="text-right w-32 shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                                    id="ticket_disc" name="ticket_disc" type="number" placeholder="ကံထူးရှင်"
                                    value="{{ old('ticket_disc', 0) }}" oninput="calExpenseTotal()">
                            </div>
                        </div>
                    </div>
                </section>

                <div class="flex justify-end gap-5">
                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="total_expense">
                            (-) Total Expense
                        </label>
                        <input readonly
                            class="text-right w-32 shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="total_expense" name="total_expense" type="number" placeholder="Total Expense"
                            value="{{ old('total_expense', 0) }}">
                    </div>
                </div>

                <div class="flex justify-end gap-5">
                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="pot_sat">
                            ပို့ဆက်
                        </label>
                        <input
                            class="text-right w-32 shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="pot_sat" name="pot_sat" type="number" placeholder="ပို့ဆက်"
                            value="{{ old('pot_sat', 0) }}" oninput="calRtaExpenseTotal()">
                    </div>

                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="la_tha">
                            လသ
                        </label>
                        <input
                            class="text-right w-32 shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="la_tha" name="la_tha" type="number" placeholder="လသ"
                            value="{{ old('la_tha', 0) }}" oninput="calRtaExpenseTotal()">
                    </div>

                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="copy">
                            မိတ္တူ
                        </label>
                        <input
                            class="text-right w-32 shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="copy" name="copy" type="number" placeholder="မိတ္တူ"
                            value="{{ old('copy', 0) }}" oninput="calRtaExpenseTotal()">
                    </div>

                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="total_rta">
                            (-) Total RTA Expense
                        </label>
                        <input readonly
                            class="text-right w-32 shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="total_rta" name="total_rta" type="number" placeholder="Total RTA Expense"
                            value="{{ old('total_rta', 0) }}">
                    </div>
                </div>

                {{-- <div class="flex justify-end gap-5">
                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="credit_cargo_readonly">
                            (-) ကုန်ကြွေး
                        </label>
                        <input readonly
                            class="text-right w-32 shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="credit_cargo_readonly" type="number" placeholder="ကုန်ကြွေး"
                            value="{{ old('credit_cargo_readonly', 0) }}">
                    </div>
                </div> --}}

                <div class="flex justify-end gap-5">
                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="credit_cargo_readonly">
                            (-) ကုန်ကြွေး
                        </label>
                        <input readonly
                            class="text-right w-32 shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="credit_cargo_readonly" type="number" placeholder="ကုန်ကြွေး"
                            value="{{ old('credit_cargo_readonly', 0) }}">
                    </div>

                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="ygn_lan_tg_ticket">
                            (-) ရကအပြန်တောင်း
                        </label>
                        <input readonly
                            class="text-right w-32 shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="ygn_lan_tg_ticket" name="ygn_lan_tg_ticket" type="number" placeholder="ရကအပြန်တောင်း"
                            value="{{ old('ygn_lan_tg_ticket', 0) }}">
                    </div>

                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="lan_tg_ticket">
                            (-) လမ်းတက်ငွေတောင်း
                        </label>
                        <input readonly
                            class="text-right w-32 shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="lan_tg_ticket" name="lan_tg_ticket" type="number" placeholder="လမ်းတက်ငွေတောင်း"
                            value="{{ old('lan_tg_ticket', 0) }}">
                    </div>

                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="gate_out">
                            (-) ဂိတ်ထုတ်
                        </label>
                        <input
                            class="text-right w-32 shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="gate_out" name="gate_out" type="number" placeholder="ဂိတ်ထုတ်"
                            value="{{ old('gate_out', 0) }}" oninput="calTotal()">
                    </div>
                </div>

                {{-- <div class="flex justify-end gap-5">
                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="gate_out">
                            (-) ဂိတ်ထုတ်
                        </label>
                        <input
                            class="text-right w-32 shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="gate_out" name="gate_out" type="number" placeholder="ဂိတ်ထုတ်"
                            value="{{ old('gate_out', 0) }}" oninput="calTotal()">
                    </div>
                </div> --}}

                <div class="flex justify-end gap-5">
                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="ferry">
                            (-) Ferry
                        </label>
                        <input
                            class="text-right w-32 shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="ferry" name="ferry" type="number" placeholder="Ferry"
                            value="{{ old('ferry', 0) }}" oninput="calTotal()">
                    </div>

                    <div class="mb-2">
                        <label class="block mb-2 text-xs font-bold text-gray-700" for="ask_khauk_to">
                            (+/-) အောင်ဆန်းခေါက်တို
                        </label>
                        <input
                            class="text-right w-32 shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="ask_khauk_to" name="ask_khauk_to" type="number" placeholder="အောင်ဆန်းခေါက်တို"
                            value="{{ old('ask_khauk_to', 0) }}" oninput="calTotal()">
                    </div>

                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="deli">
                            (+/-) အရောက်ပို့ခ
                        </label>
                        <input
                            class="text-right w-32 shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="deli" name="deli" type="number" placeholder="အရောက်ပို့ခ"
                            value="{{ old('deli', 0) }}" oninput="calTotal()">
                    </div>

                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="khauk_to">
                            (+/-) ခေါက်တိုခကြွေး
                        </label>
                        <input
                            class="text-right w-32 shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="khauk_to" name="khauk_to" type="number" placeholder="ခေါက်တိုခကြွေး"
                            value="{{ old('khauk_to', 0) }}" oninput="calTotal()">
                    </div>

                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="other_expense">
                            (+/-) အခြားစရိတ်
                        </label>
                        <input
                            class="text-right w-32 shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="other_expense" name="other_expense" type="number" placeholder="အခြားစရိတ်"
                            value="{{ old('other_expense', 0) }}" oninput="calTotal()">
                    </div>

                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="site_shin">
                            (+/-) စိုက်ရှင်းငွေ
                        </label>
                        <input
                            class="text-right w-32 shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="site_shin" name="site_shin" type="number" placeholder="စိုက်ရှင်းငွေ"
                            value="{{ old('site_shin', 0) }}" oninput="calTotal()">
                    </div>
                </div>

                {{-- <div class="flex justify-end gap-5">
                    <div class="mb-2">
                        <label class="block mb-2 text-xs font-bold text-gray-700" for="ask_khauk_to">
                            (+/-) အောင်ဆန်းခေါက်တို
                        </label>
                        <input
                            class="text-right w-32 shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="ask_khauk_to" name="ask_khauk_to" type="number" placeholder="အောင်ဆန်းခေါက်တို"
                            value="{{ old('ask_khauk_to', 0) }}" oninput="calTotal()">
                    </div>
                </div> --}}

                {{-- <div class="flex justify-end gap-5">
                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="deli">
                            (+/-) အရောက်ပို့ခ
                        </label>
                        <input
                            class="text-right w-32 shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="deli" name="deli" type="number" placeholder="အရောက်ပို့ခ"
                            value="{{ old('deli', 0) }}" oninput="calTotal()">
                    </div>
                </div> --}}

                {{-- <div class="flex justify-end gap-5">
                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="khauk_to">
                            (+/-) ခေါက်တိုခကြွေး
                        </label>
                        <input
                            class="text-right w-32 shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="khauk_to" name="khauk_to" type="number" placeholder="ခေါက်တိုခကြွေး"
                            value="{{ old('khauk_to', 0) }}" oninput="calTotal()">
                    </div>
                </div> --}}

                {{-- <div class="flex justify-end gap-5">
                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="other_expense">
                            (+/-) အခြားစရိတ်
                        </label>
                        <input
                            class="text-right w-32 shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="other_expense" name="other_expense" type="number" placeholder="အခြားစရိတ်"
                            value="{{ old('other_expense', 0) }}" oninput="calTotal()">
                    </div>
                </div> --}}

                {{-- <div class="flex justify-end gap-5">
                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="site_shin">
                            (+/-) စိုက်ရှင်းငွေ
                        </label>
                        <input
                            class="text-right w-32 shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="site_shin" name="site_shin" type="number" placeholder="စိုက်ရှင်းငွေ"
                            value="{{ old('site_shin', 0) }}" oninput="calTotal()">
                    </div>
                </div> --}}

                <div class="flex justify-end gap-5">
                    <div class="mb-2">
                        <label class="block mb-2 text-base font-bold text-gray-700" for="total">
                            Total
                        </label>
                        <input readonly
                            class="text-right w-32 shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="total" name="total" type="number" placeholder="Total"
                            value="{{ old('total', 0) }}">
                    </div>
                </div>

                {{-- <table class="table text-base table-bordered table-striped table-hover border dataTable">
                    <thead>
                        <tr>
                            <th></th>
                            <th>No.</th>
                            <th>Type</th>
                            <th>People</th>
                            <th>Amount</th>
                            <th>Remark</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (old('ticket_line_no'))
                            @for ($i = 0; $i < count(old('ticket_line_no')); $i++)
                                <tr>
                                    <td class="flex">
                                        <button type="button" class="ticketDeleteBtn">

                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                fill="currentColor" class="w-5 h-5">
                                                <path fill-rule="evenodd"
                                                    d="M8.75 1A2.75 2.75 0 0 0 6 3.75v.443c-.795.077-1.584.176-2.365.298a.75.75 0 1 0 .23 1.482l.149-.022.841 10.518A2.75 2.75 0 0 0 7.596 19h4.807a2.75 2.75 0 0 0 2.742-2.53l.841-10.52.149.023a.75.75 0 0 0 .23-1.482A41.03 41.03 0 0 0 14 4.193V3.75A2.75 2.75 0 0 0 11.25 1h-2.5ZM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4ZM8.58 7.72a.75.75 0 0 0-1.5.06l.3 7.5a.75.75 0 1 0 1.5-.06l-.3-7.5Zm4.34.06a.75.75 0 1 0-1.5-.06l-.3 7.5a.75.75 0 1 0 1.5.06l.3-7.5Z"
                                                    clip-rule="evenodd" />
                                            </svg>

                                        </button>
                                    </td>
                                    <td class="text-end"><input type="hidden" value="{{ old('ticket_line_no')[$i] }}"
                                            name='ticket_line_no[]'>{{ old('ticket_line_no')[$i] }}</td>
                                    <td><input type="hidden" value="{{ old('item_id')[$i] }}" name='item_id[]'><input
                                            type="hidden" value="{{ old('item_name')[$i] }}"
                                            name='item_name[]'>{{ old('item_name')[$i] }}</td>
                                    <td><input type="hidden" value="{{ old('ticket_remark')[$i] }}"
                                            name='ticket_remark[]'>{{ old('ticket_remark')[$i] }}</td>
                                    <td class="text-end"><input type="hidden" value="{{ old('qty')[$i] }}"
                                            name='qty[]'>{{ old('qty')[$i] }}</td>
                                    <td class="text-end"><input type="hidden" value="{{ old('unit_price')[$i] }}"
                                            name='unit_price[]'>{{ old('unit_price')[$i] }}</td>
                                    <td class="text-end"><input type="hidden" value="{{ old('detail_discount')[$i] }}"
                                            name='detail_discount[]'>{{ old('detail_discount')[$i] }}</td>
                                    <td class="text-end"><input type="hidden" value="{{ old('amount')[$i] }}"
                                            name='amount[]'>{{ old('amount')[$i] }}</td>
                                </tr>
                            @endfor
                        @endif
                    </tbody>
                </table> --}}

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
        //    new DataTable('.ticket-table');
        // $('.select2').select2();
        let dailyCars = @json($daily_cars);
        let settings = @json($settings);
        let cities = @json($cities);
        let gatePercents = @json($gate_percents);
        let expenseList = @json(config('ownermain.expense_list'));
        let rtaExpenseList = @json(config('ownermain.rta_expense_list'));
        let minusList = @json(config('ownermain.minus_list'));
        let plusList = @json(config('ownermain.plus_list'));

        let routeType;
        let gatePercentsByTour;
        let selectedDailyCar;
        let selectedSetting;
        let selectedGatePercent;

        $('#ticket_type').val('cash');

        $('#ticketSection').hide();
        $('#ticketHideBtn').hide();

        $('#cargoSection').hide();
        $('#cargoHideBtn').hide();

        $('#expenseSection').hide();
        $('#expenseHideBtn').hide();

        function calTicketIncome() {
            const totalAmount = parseInt($('#total_ticket').val()) || 0;
            const ticketInsurance = parseInt($('#insurance').val()) || 0;

            $('#ticket_income').val(totalAmount - ticketInsurance);
            calGrandTotal();
        }

        function calCashCargo(from) {
            let totalCargo = parseInt($('#total_cargo').val()) || 0;
            let cashCargo = parseInt($('#cash_cargo').val()) || 0;
            let creditCargo = parseInt($('#credit_cargo').val()) || 0;

            if (routeType == 'out') {
                $('#total_cargo').val(cashCargo + creditCargo);
            } else {
                $('#cash_cargo').val(totalCargo - creditCargo);
            }

            $('#credit_cargo_readonly').val(creditCargo);

            if (from == 'total') {
                calCargoIncome();
            }
        }

        function calCargoIncome() {
            let totalCargo = parseInt($('#total_cargo').val()) || 0;
            let cargoBd = parseInt($('#cargo_bd').val()) || 0;
            let luParCargo = parseInt($('#lu_par_cargo').val()) || 0;

            $('#cargo_income').val(totalCargo - cargoBd + luParCargo);
            calGrandTotal();
        }

        function calGrandTotal() {
            let ticketIncome = parseInt($('#ticket_income').val()) || 0;
            let cargoIncome = parseInt($('#cargo_income').val()) || 0;

            let grandTotal = ticketIncome + cargoIncome;
            $('#grand_total').val(grandTotal);

            let gatePercent = 0;
            if (gatePercentsByTour) {
                selectedGatePercent = gatePercentsByTour.find(gatePercent => grandTotal >= gatePercent
                    .start_amount && grandTotal <= gatePercent.end_amount);

                if (selectedGatePercent) {
                    gatePercent = selectedGatePercent?.percent || 0;
                }
            }

            let commission = grandTotal * (gatePercent / 100);
            let roundedCommission = Math.round(commission / 100) * 100;

            $('#gate_percent').val(gatePercent);
            $('#gate_commission').val(roundedCommission);

            calTotal();
        }

        function calExpenseAmt(type, val) {
            val = parseInt(val) || 0;
            if (selectedSetting != undefined) {
                let amt = 0;
                switch (type) {
                    case 'water_small':
                        amt = selectedSetting.water_small * val;
                        break;
                    case 'water_large':
                        amt = selectedSetting.water_large * val;
                        break;
                    case 'drink':
                        amt = selectedSetting.drink * val;
                        break;
                    case 'snack':
                        amt = selectedSetting.snack * val;
                        break;
                    case 'snack_special':
                        amt = selectedSetting.snack_special * val;
                        break;
                    case 'towel':
                        amt = selectedSetting.towel * val;
                        break;
                    case 'plastic_bag':
                        amt = selectedSetting.plastic_bag * val;
                        break;
                    case 'candy':
                        amt = selectedSetting.candy * val;
                        break;
                }

                $('#' + type + '_amt').val(amt);

                calExpenseTotal();
            }
        }

        function calExpenseTotal() {
            let totalExpense = 0;
            $.each(expenseList, function(index, expense) {
                totalExpense += parseInt($('#' + expense).val()) || 0;
            });

            $('#total_expense').val(totalExpense);

            calTotal();
        }

        function calRtaExpenseTotal() {
            let totalRta = 0;
            $.each(rtaExpenseList, function(index, rtaExpense) {
                totalRta += parseInt($('#' + rtaExpense).val()) || 0;
            });

            $('#total_rta').val(totalRta);

            calTotal();
        }

        function calTotal() {
            let grandTotal = parseInt($('#grand_total').val()) || 0;
            let total = grandTotal;

            $.each(minusList, function(index, expense) {
                total -= parseInt($('#' + expense).val()) || 0;
            });

            $.each(plusList, function(index, plus) {
                total += parseInt($('#' + plus).val()) || 0;
            });

            $('#total').val(total);
        }

        $(document).ready(function() {
            // @if (old('description'))
            //     $("#description").val("{{ old('description') }}");
            // @endif

            var picker1 = new Pikaday({
                field: document.getElementById('out_date'),
                format: 'DD-MM-YYYY',
                // onSelect: function() {
                //     document.getElementById('date').value = moment(document.getElementById('date')
                //         .value).format('DD MMM YYYY');
                // },
            });

            var picker2 = new Pikaday({
                field: document.getElementById('in_date'),
                format: 'DD-MM-YYYY',
                // onSelect: function() {
                //     document.getElementById('date').value = moment(document.getElementById('date')
                //         .value).format('DD MMM YYYY');
                // },
            });

            function formatDate(date) {
                const arr = date.split('-');
                if (arr.length == 0) {
                    return '';
                }
                return `${arr[2]}-${arr[1]}-${arr[0]}`;
            }

            function calTicketTotal() {
                let totalPeople = 0;
                let totalAmount = 0;
                let totalTicketCash = 0;
                let totalTicketLanTg = 0;
                let totalTicketYgnTg = 0;
                let totalTicketNextCar = 0;
                const ticketInsuranceRate = parseInt($('#insurance_rate').val()) || 0;
                let ticketInsurance = 0;
                let ticketIncome = 0;

                $(".ticket-table tbody tr").each(function() {
                    const rowType = $(this).find("td:eq(2) input").val();
                    const rowPeople = parseInt($(this).find("td:eq(3)").text()) || 0;
                    const rowAmount = parseInt($(this).find("td:eq(4)").text()) || 0;

                    switch (rowType) {
                        case 'lan_tg':
                            totalTicketLanTg += rowAmount;
                            break;
                        case 'ygn_tg':
                            totalTicketYgnTg += rowAmount;
                            break;
                        case 'next_car':
                            totalTicketNextCar += rowAmount;
                            break;
                        default:
                            totalTicketCash += rowAmount;
                            break;
                    }

                    totalPeople += rowPeople;
                    totalAmount += rowAmount;
                });

                ticketInsurance = totalPeople * ticketInsuranceRate;

                $('#total_ticket_cash').val(totalTicketCash);
                $('#total_ticket_lan_tg').val(totalTicketLanTg);
                $('#total_ticket_ygn_tg').val(totalTicketYgnTg);
                $('#total_ticket_next_car').val(totalTicketNextCar);

                $('#total_ticket_cash_label').text(totalTicketCash.toLocaleString());
                $('#total_ticket_lan_tg_label').text(totalTicketLanTg.toLocaleString());
                $('#total_ticket_ygn_tg_label').text(totalTicketYgnTg.toLocaleString());
                $('#total_ticket_next_car_label').text(totalTicketNextCar.toLocaleString());

                $('#ygn_lan_tg_ticket').val(totalTicketYgnTg);
                $('#lan_tg_ticket').val(totalTicketLanTg + totalTicketNextCar);

                $('#total_people').val(totalPeople);
                $('#total_ticket').val(totalAmount);
                $('#insurance').val(ticketInsurance);

                calTicketIncome();
            }

            function calOutCargoTotal() {
                let totalCreditCargo = 0;
                let totalDeli = 0;
                let totalCreditKhaukTo = 0;
                let totalSiteShin = 0;
                let totalGatePercent = 0;

                $(".out-cargo-table tbody tr").each(function() {
                    totalCreditCargo += parseInt($(this).find("td:eq(3)").text()) || 0;
                    totalDeli += parseInt($(this).find("td:eq(4)").text()) || 0;
                    totalCreditKhaukTo += parseInt($(this).find("td:eq(5)").text()) || 0;
                    totalSiteShin += parseInt($(this).find("td:eq(6)").text()) || 0;
                    totalGatePercent += parseInt($(this).find("td:eq(7)").text()) || 0;
                });

                $('#total_out_credit_cargo').val(totalCreditCargo);
                $('#total_out_cargo_deli').val(totalDeli);
                $('#total_out_credit_khauk_to').val(totalCreditKhaukTo);
                $('#total_out_site_shin').val(totalSiteShin);
                $('#total_out_cargo_percent').val(totalGatePercent);

                $('#total_out_credit_cargo_label').text(totalCreditCargo.toLocaleString());
                $('#total_out_cargo_deli_label').text(totalDeli.toLocaleString());
                $('#total_out_credit_khauk_to_label').text(totalCreditKhaukTo.toLocaleString());
                $('#total_out_site_shin_label').text(totalSiteShin.toLocaleString());
                $('#total_out_cargo_percent_label').text(totalGatePercent.toLocaleString());
            }

            function ticketToggle() {
                $('#ticketSection').slideToggle(300);
                $('#ticketHideBtn').toggle();
                $('#ticketShowBtn').toggle();
            }

            function cargoToggle() {
                $('#cargoSection').slideToggle(300);
                $('#cargoHideBtn').toggle();
                $('#cargoShowBtn').toggle();
            }

            function expenseToggle() {
                $('#expenseSection').slideToggle(300);
                $('#expenseHideBtn').toggle();
                $('#expenseShowBtn').toggle();
            }

            function focusOnCargoSection() {
                let element = (routeType == 'out') ? 'cash_cargo' : 'total_cargo';

                if (!$('#cargoSection').is(':visible')) {
                    cargoToggle();
                }

                focusTarget('#' + element);
                selectTarget('#' + element);
            }

            function focusOnExpenseSection() {
                if (!$('#expenseSection').is(':visible')) {
                    expenseToggle();
                }

                focusTarget('#water_small_qty');
                selectTarget('#water_small_qty');
            }

            $('#in_date').on('change', function() {
                const in_date = formatDate($(this).val());

                $.ajax({
                    url: '{{ route('home_car_mains.in_date_related_info') }}',
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

                        gatePercents = response.gate_percents;
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
                    $('#tour').val(selectedDailyCar.tour.short_name);
                    $('#car_no').val(selectedDailyCar.car.car_no);
                    $('#driver_1').val(selectedDailyCar.driver_1?.name || '');
                    $('#driver_2').val(selectedDailyCar.driver_2?.name || '');
                    $('#spare').val(selectedDailyCar.spare?.name || '');
                    $('#crew').val(selectedDailyCar.crew?.name || '');

                    selectedSetting = settings.find(setting => setting.tour_id == selectedDailyCar.tour_id);
                    $('#insurance_rate').val(selectedSetting?.insurance || 0);
                    $('#guest_reg').val(selectedSetting?.guest_reg || 0);
                    $('#medicine').val(selectedSetting?.medicine || 0);
                    $('#pot_sat').val(selectedSetting?.pot_sat || 0);
                    $('#la_tha').val(selectedSetting?.la_tha || 0);
                    $('#gate_out').val(selectedSetting?.gate_out || 0);
                    $('#ask_khauk_to').val(selectedSetting?.ask || 0);

                    routeType = selectedDailyCar.tour.route_type;

                    let outCargoCitySelect = $('#out_cargo_city_id');
                    outCargoCitySelect.empty();

                    outCargoCitySelect.append(
                        '<option value="" disabled selected hidden>Choose city</option>');

                    $.each(selectedDailyCar.tour.cities, function(index, city) {
                        outCargoCitySelect.append(
                            `<option value="${city.id}" data-name="${city.en_name}">
                            ${city.en_name}
                        </option>`
                        );
                    });

                    gatePercentsByTour = gatePercents.filter(gatePercent => gatePercent.tour_id ==
                        selectedDailyCar.tour_id);

                    let grandTotal = parseInt($('#grand_total').val()) || 0;
                    let gatePercent = 0;
                    selectedGatePercent = gatePercentsByTour.find(gatePercent => grandTotal >= gatePercent
                        .start_amount && grandTotal <= gatePercent.end_amount);

                    if (selectedGatePercent) {
                        gatePercent = selectedGatePercent?.percent || 0;
                    }

                    $('#gate_percent').val(gatePercent);

                    calExpenseTotal();
                    calRtaExpenseTotal();

                    if (!$('#ticketSection').is(':visible')) {
                        ticketToggle();
                    }

                    $('#ticket_people').focus().select();
                } else {
                    console.error('dailyCars array is not available');
                }
            });

            $('#ticketToggleSection').click(function() {
                ticketToggle();
            });

            $("#ticketAddBtn").click(function() {
                var lineNo = $("#ticket_line_no").val();
                var type = $("#ticket_type").val();
                var typeName = $('#ticket_type :selected').data('name');
                var remark = $("#ticket_remark").val();
                var people = $("#ticket_people").val();
                var amount = $("#ticket_amount").val();

                if (!lineNo || !type || !people || !amount) {
                    alert("Please fill the relevant fields.");
                    return false;
                }

                var lineNoCol = "<input type='hidden' value='" + lineNo +
                    "' name='ticket_line_no[]'>" +
                    lineNo;
                var typeCol = "<input type='hidden' value='" + type +
                    "' name='ticket_type[]'>" + "<input type='hidden' value='" + typeName +
                    "' name='ticket_type_name[]'>" +
                    typeName;
                var remarkCol = "<input type='hidden' value='" + remark +
                    "' name='ticket_remark[]'>" + remark;
                var peopleCol = "<input type='hidden' value='" + people + "' name='ticket_people[]'>" +
                    people;
                var amountCol = "<input type='hidden' value='" + amount +
                    "' name='ticket_amount[]'>" +
                    amount;

                var existingRow = $(".ticket-table tbody tr").filter(function() {
                    return $(this).find('td:eq(1) input').val() == lineNo;
                });

                if (existingRow.length > 0) {
                    existingRow.find('td:eq(2)').html(typeCol);
                    existingRow.find('td:eq(3)').html(peopleCol);
                    existingRow.find('td:eq(4)').html(amountCol);
                    existingRow.find('td:eq(5)').html(remarkCol);
                } else {
                    var newRow = $("<tr>").append(
                        $("<td>").append(
                            '<button type="button" class="ticketDeleteBtn">' +
                            '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">' +
                            '<path fill-rule="evenodd" d="M8.75 1A2.75 2.75 0 0 0 6 3.75v.443c-.795.077-1.584.176-2.365.298a.75.75 0 1 0 .23 1.482l.149-.022.841 10.518A2.75 2.75 0 0 0 7.596 19h4.807a2.75 2.75 0 0 0 2.742-2.53l.841-10.52.149.023a.75.75 0 0 0 .23-1.482A41.03 41.03 0 0 0 14 4.193V3.75A2.75 2.75 0 0 0 11.25 1h-2.5ZM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4ZM8.58 7.72a.75.75 0 0 0-1.5.06l.3 7.5a.75.75 0 1 0 1.5-.06l-.3-7.5Zm4.34.06a.75.75 0 1 0-1.5-.06l-.3 7.5a.75.75 0 1 0 1.5.06l.3-7.5Z" clip-rule="evenodd" /></svg>' +
                            '</button>'
                        ).addClass('px-3 py-2 border'),
                        $("<td>").append(lineNoCol).addClass('px-3 py-2 text-right border'),
                        $("<td>").append(typeCol).addClass('px-3 py-2 border'),
                        $("<td>").append(peopleCol).addClass('px-3 py-2 text-right border'),
                        $("<td>").append(amountCol).addClass('px-3 py-2 text-right border'),
                        $("<td>").append(remarkCol).addClass('px-3 py-2 border'),
                    ).addClass('bg-slate-50 text-gray-800 text-sm border-b border-gray-200');

                    $(".ticket-table").append(newRow);
                }

                calTicketTotal();

                let count = 0;
                $(".ticket-table tbody tr").each(function(index, row) {
                    count += 1;
                });

                $('#ticket_line_no').val(count + 1);
                $('#ticket_type').val('cash');
                $("#ticket_remark").val("");
                $("#ticket_people, #ticket_amount").val("0");

                focusTarget('#ticket_people');
                selectTarget('#ticket_people');
            });

            $(".ticket-table tbody").on("click", "tr", function() {
                if ($(event.target).closest(".ticketDeleteBtn").length) {
                    return;
                }

                var lineNo = $(this).find("td:eq(1) input").val();
                var type = $(this).find("td:eq(2) input").val();
                var people = $(this).find("td:eq(3) input").val();
                var amount = $(this).find("td:eq(4) input").val();
                var remark = $(this).find("td:eq(5) input").val();

                $('#ticket_line_no').val(lineNo);
                $("#ticket_type").val(type);
                $("#ticket_people").val(people);
                $("#ticket_amount").val(amount);
                $("#ticket_remark").val(remark);

                focusTarget('#ticket_people');
                selectTarget('#ticket_people');
            });

            $(".ticket-table").on('click', 'button.ticketDeleteBtn', function(event) {
                event.stopPropagation();

                if (confirm("Are you sure you want to delete this row?")) {
                    $(this).closest('tr').remove();

                    var count = 0;
                    $(".ticket-table tbody tr").each(function(index, row) {
                        var lineNoCol = "<input type='hidden' value='" + (index + 1) +
                            "' name='ticket_line_no[]'>" +
                            (index + 1);

                        $(row).find('td:eq(1)').html(lineNoCol);
                        count += 1;
                    });

                    $('#ticket_line_no').val(count + 1);

                    calTicketTotal();
                }
            });

            $('#cargoToggleSection').click(function() {
                cargoToggle();
            });

            $("#outCargoAddBtn").click(function() {
                let lineNo = $("#out_cargo_line_no").val();
                let city = $("#out_cargo_city_id").val();
                let cityName = $('#out_cargo_city_id :selected').data('name');
                let creditCargo = $("#out_credit_cargo").val();
                let deli = $("#out_cargo_deli").val() || 0;
                let khaukTo = $("#out_credit_khauk_to").val() || 0;
                let siteShin = $("#out_site_shin").val() || 0;
                let percent = $("#out_cargo_percent").val() || 0;
                let paid = $("#out_cargo_paid").prop('checked');
                let paidText = (paid == true) ? 'Yes' : 'No';

                if (!lineNo || !city || !creditCargo) {
                    alert("Please fill the relevant fields.");
                    return false;
                }

                let lineNoCol = "<input type='hidden' value='" + lineNo +
                    "' name='out_cargo_line_no[]'>" + lineNo;
                let cityCol = "<input type='hidden' value='" + city +
                    "' name='out_cargo_city_id[]'>" + "<input type='hidden' value='" + cityName +
                    "' name='out_cargo_city_name[]'>" + cityName;
                let creditCargoCol = "<input type='hidden' value='" + creditCargo +
                    "' name='out_credit_cargo[]'>" + creditCargo;
                let deliCol = "<input type='hidden' value='" + deli + "' name='out_cargo_deli[]'>" +
                    deli;
                let khaukToCol = "<input type='hidden' value='" + khaukTo +
                    "' name='out_credit_khauk_to[]'>" + khaukTo;
                let siteShinCol = "<input type='hidden' value='" + siteShin + "' name='out_site_shin[]'>" +
                    siteShin;
                let percentCol = "<input type='hidden' value='" + percent +
                    "' name='out_cargo_percent[]'>" + percent;
                let paidCol = "<input type='hidden' value='" + paid + "' name='out_cargo_paid[]'>" +
                    paidText;

                let existingRow = $(".out-cargo-table tbody tr").filter(function() {
                    return $(this).find('td:eq(1) input').val() == lineNo;
                });

                if (existingRow.length > 0) {
                    existingRow.find('td:eq(2)').html(cityCol);
                    existingRow.find('td:eq(3)').html(creditCargoCol);
                    existingRow.find('td:eq(4)').html(deliCol);
                    existingRow.find('td:eq(5)').html(khaukToCol);
                    existingRow.find('td:eq(6)').html(siteShinCol);
                    existingRow.find('td:eq(7)').html(percentCol);
                    existingRow.find('td:eq(8)').html(paidCol);
                } else {
                    let newRow = $("<tr>").append(
                        $("<td>").append(
                            '<button type="button" class="outCargoDeleteBtn">' +
                            '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">' +
                            '<path fill-rule="evenodd" d="M8.75 1A2.75 2.75 0 0 0 6 3.75v.443c-.795.077-1.584.176-2.365.298a.75.75 0 1 0 .23 1.482l.149-.022.841 10.518A2.75 2.75 0 0 0 7.596 19h4.807a2.75 2.75 0 0 0 2.742-2.53l.841-10.52.149.023a.75.75 0 0 0 .23-1.482A41.03 41.03 0 0 0 14 4.193V3.75A2.75 2.75 0 0 0 11.25 1h-2.5ZM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4ZM8.58 7.72a.75.75 0 0 0-1.5.06l.3 7.5a.75.75 0 1 0 1.5-.06l-.3-7.5Zm4.34.06a.75.75 0 1 0-1.5-.06l-.3 7.5a.75.75 0 1 0 1.5.06l.3-7.5Z" clip-rule="evenodd" /></svg>' +
                            '</button>'
                        ).addClass('px-3 py-2 border'),
                        $("<td>").append(lineNoCol).addClass('px-3 py-2 text-right border'),
                        $("<td>").append(cityCol).addClass('px-3 py-2 border'),
                        $("<td>").append(creditCargoCol).addClass('px-3 py-2 text-right border'),
                        $("<td>").append(deliCol).addClass('px-3 py-2 text-right border'),
                        $("<td>").append(khaukToCol).addClass('px-3 py-2 text-right border'),
                        $("<td>").append(siteShinCol).addClass('px-3 py-2 text-right border'),
                        $("<td>").append(percentCol).addClass('px-3 py-2 text-right border'),
                        $("<td>").append(paidCol).addClass('px-3 py-2 text-center border'),
                    ).addClass('bg-slate-50 text-gray-800 text-sm border-b border-gray-200');

                    $(".out-cargo-table").append(newRow);
                }

                calOutCargoTotal();

                let count = 0;
                $(".out-cargo-table tbody tr").each(function(index, row) {
                    count += 1;
                });

                $('#out_cargo_line_no').val(count + 1);
                $("#out_cargo_city_id, #ticket_remark").val("");
                $("#out_credit_cargo, #out_cargo_deli, #out_credit_khauk_to, #out_site_shin, #out_cargo_percent")
                    .val("0");
                $("#out_cargo_paid").prop('checked', true);

                focusTarget('#out_cargo_city_id');
                selectTarget('#out_cargo_city_id');
            });

            $(".out-cargo-table tbody").on("click", "tr", function() {
                if ($(event.target).closest(".outCargoDeleteBtn").length) {
                    return;
                }

                let lineNo = $(this).find("td:eq(1) input").val();
                let city = $(this).find("td:eq(2) input").val();
                let creditCargo = $(this).find("td:eq(3) input").val();
                let deli = $(this).find("td:eq(4) input").val();
                let khaukTo = $(this).find("td:eq(5) input").val();
                let siteShin = $(this).find("td:eq(6) input").val();
                let percent = $(this).find("td:eq(7) input").val();
                let paidText = $(this).find("td:eq(8)").text().trim();
                let paid = (paidText == 'Yes') ? true : false;

                $('#out_cargo_line_no').val(lineNo);
                $("#out_cargo_city_id").val(city);
                $("#out_credit_cargo").val(creditCargo);
                $("#out_cargo_deli").val(deli);
                $("#out_credit_khauk_to").val(khaukTo);
                $("#out_site_shin").val(siteShin);
                $("#out_cargo_percent").val(percent);
                $("#out_cargo_paid").prop('checked', paid);

                focusTarget('#out_credit_cargo');
                selectTarget('#out_credit_cargo');
            });

            $(".out-cargo-table").on('click', 'button.outCargoDeleteBtn', function(event) {
                event.stopPropagation();

                if (confirm("Are you sure you want to delete this row?")) {
                    $(this).closest('tr').remove();

                    var count = 0;
                    $(".out-cargo-table tbody tr").each(function(index, row) {
                        var lineNoCol = "<input type='hidden' value='" + (index + 1) +
                            "' name='out_cargo_line_no[]'>" +
                            (index + 1);

                        $(row).find('td:eq(1)').html(lineNoCol);
                        count += 1;
                    });

                    $('#out_cargo_line_no').val(count + 1);

                    calOutCargoTotal();
                }
            });

            $('#expenseToggleSection').click(function() {
                expenseToggle();
            });

            $('#ticket_people').on('keydown', function(event) {
                if (event.key === "Enter") {
                    focusTarget("#ticket_amount");
                    selectTarget("#ticket_amount");
                } else if (event.key === "Control") {
                    focusOnCargoSection();
                }
            });

            $('#ticket_amount').on('keydown', function(event) {
                if (event.key === "Enter") {
                    focusTarget("#ticket_remark");
                    selectTarget("#ticket_remark");
                } else if (event.key === "Control") {
                    focusOnCargoSection();
                }
            });

            $('#ticket_remark').on('keydown', function(event) {
                if (event.key === "Enter") {
                    $('#ticketAddBtn').click();
                } else if (event.key === "Control") {
                    focusOnCargoSection();
                }
            });

            $('#total_cargo').on('keydown', function(event) {
                if (event.key === "Enter") {
                    focusTarget("#credit_cargo");
                    selectTarget("#credit_cargo");
                }
            });

            $('#cash_cargo').on('keydown', function(event) {
                if (event.key === "Enter") {
                    focusTarget("#credit_cargo");
                    selectTarget("#credit_cargo");
                }
            });

            $('#credit_cargo').on('keydown', function(event) {
                if (event.key === "Enter") {
                    focusTarget("#cargo_bd");
                    selectTarget("#cargo_bd");
                }
            });

            $('#cargo_bd').on('keydown', function(event) {
                if (event.key === "Enter") {
                    focusTarget("#lu_par_cargo");
                    selectTarget("#lu_par_cargo");
                }
            });

            $('#lu_par_cargo').on('keydown', function(event) {
                if (event.key === "Enter") {
                    let element = (routeType == 'out') ? 'out_cargo_city_id' : 'pot_sat';
                    focusTarget("#" + element);
                    selectTarget("#" + element);
                }
            });

            $('#out_cargo_city_id').on('keydown', function(event) {
                if (event.key === "Enter") {
                    focusTarget('#out_credit_cargo');
                    selectTarget('#out_credit_cargo');
                } else if (event.key === "Control") {
                    focusOnExpenseSection();
                }
            });

            $('#out_credit_cargo').on('keydown', function(event) {
                if (event.key === "Enter") {
                    focusTarget('#out_cargo_deli');
                    selectTarget('#out_cargo_deli');
                } else if (event.key === "Control") {
                    focusOnExpenseSection();
                }
            });

            $('#out_cargo_deli').on('keydown', function(event) {
                if (event.key === "Enter") {
                    focusTarget('#out_credit_khauk_to');
                    selectTarget('#out_credit_khauk_to');
                } else if (event.key === "Control") {
                    focusOnExpenseSection();
                }
            });

            $('#out_credit_khauk_to').on('keydown', function(event) {
                if (event.key === "Enter") {
                    focusTarget('#out_site_shin');
                    selectTarget('#out_site_shin');
                } else if (event.key === "Control") {
                    focusOnExpenseSection();
                }
            });

            $('#out_site_shin').on('keydown', function(event) {
                if (event.key === "Enter") {
                    focusTarget('#out_cargo_percent');
                    selectTarget('#out_cargo_percent');
                } else if (event.key === "Control") {
                    focusOnExpenseSection();
                }
            });

            $('#out_cargo_percent').on('keydown', function(event) {
                if (event.key === "Enter") {
                    $('#outCargoAddBtn').click();
                } else if (event.key === "Control") {
                    focusOnExpenseSection();
                }
            });

            $('#water_small_qty').on('keydown', function(event) {
                if (event.key === "Enter") {
                    focusTarget('#water_small_amt');
                    selectTarget('#water_small_amt');
                } 
            });

            $('#water_small_amt').on('keydown', function(event) {
                if (event.key === "Enter") {
                    focusTarget('#water_large_qty');
                    selectTarget('#water_large_qty');
                } 
            });

            $('#water_large_qty').on('keydown', function(event) {
                if (event.key === "Enter") {
                    focusTarget('#water_large_amt');
                    selectTarget('#water_large_amt');
                } 
            });

            $('#water_large_amt').on('keydown', function(event) {
                if (event.key === "Enter") {
                    focusTarget('#drink_qty');
                    selectTarget('#drink_qty');
                } 
            });

            $('#drink_qty').on('keydown', function(event) {
                if (event.key === "Enter") {
                    focusTarget('#drink_amt');
                    selectTarget('#drink_amt');
                } 
            });

            $('#drink_amt').on('keydown', function(event) {
                if (event.key === "Enter") {
                    focusTarget('#snack_qty');
                    selectTarget('#snack_qty');
                } 
            });

            $('#snack_qty').on('keydown', function(event) {
                if (event.key === "Enter") {
                    focusTarget('#snack_amt');
                    selectTarget('#snack_amt');
                } 
            });

            $('#snack_amt').on('keydown', function(event) {
                if (event.key === "Enter") {
                    focusTarget('#snack_special_qty');
                    selectTarget('#snack_special_qty');
                } 
            });

            $('#snack_special_qty').on('keydown', function(event) {
                if (event.key === "Enter") {
                    focusTarget('#snack_special_amt');
                    selectTarget('#snack_special_amt');
                } 
            });

            $('#snack_special_amt').on('keydown', function(event) {
                if (event.key === "Enter") {
                    focusTarget('#towel_qty');
                    selectTarget('#towel_qty');
                } 
            });

            $('#towel_qty').on('keydown', function(event) {
                if (event.key === "Enter") {
                    focusTarget('#towel_amt');
                    selectTarget('#towel_amt');
                } 
            });

            $('#towel_amt').on('keydown', function(event) {
                if (event.key === "Enter") {
                    focusTarget('#plastic_bag_qty');
                    selectTarget('#plastic_bag_qty');
                } 
            });

            $('#plastic_bag_qty').on('keydown', function(event) {
                if (event.key === "Enter") {
                    focusTarget('#plastic_bag_amt');
                    selectTarget('#plastic_bag_amt');
                } 
            });

            $('#plastic_bag_amt').on('keydown', function(event) {
                if (event.key === "Enter") {
                    focusTarget('#candy_qty');
                    selectTarget('#candy_qty');
                } 
            });

            $('#candy_qty').on('keydown', function(event) {
                if (event.key === "Enter") {
                    focusTarget('#candy_amt');
                    selectTarget('#candy_amt');
                } 
            });

            $('#candy_amt').on('keydown', function(event) {
                if (event.key === "Enter") {
                    focusTarget('#guest_reg');
                    selectTarget('#guest_reg');
                } 
            });

            $('#guest_reg').on('keydown', function(event) {
                if (event.key === "Enter") {
                    focusTarget('#medicine');
                    selectTarget('#medicine');
                } 
            });

            $('#medicine').on('keydown', function(event) {
                if (event.key === "Enter") {
                    focusTarget('#coffee');
                    selectTarget('#coffee');
                } 
            });

            $('#coffee').on('keydown', function(event) {
                if (event.key === "Enter") {
                    focusTarget('#coffee_cup');
                    selectTarget('#coffee_cup');
                } 
            });

            $('#coffee_cup').on('keydown', function(event) {
                if (event.key === "Enter") {
                    focusTarget('#ticket_disc');
                    selectTarget('#ticket_disc');
                } 
            });

            $('#ticket_disc').on('keydown', function(event) {
                if (event.key === "Enter") {
                    focusTarget('#pot_sat');
                    selectTarget('#pot_sat');
                } 
            });

            $('#pot_sat').on('keydown', function(event) {
                if (event.key === "Enter") {
                    focusTarget('#la_tha');
                    selectTarget('#la_tha');
                } 
            });

            $('#la_tha').on('keydown', function(event) {
                if (event.key === "Enter") {
                    focusTarget('#copy');
                    selectTarget('#copy');
                } 
            });

            $('#copy').on('keydown', function(event) {
                if (event.key === "Enter") {
                    focusTarget('#ferry');
                    selectTarget('#ferry');
                } 
            });

            $('#ferry').on('keydown', function(event) {
                if (event.key === "Enter") {
                    focusTarget('#ask_khauk_to');
                    selectTarget('#ask_khauk_to');
                } 
            });

            $('#ask_khauk_to').on('keydown', function(event) {
                if (event.key === "Enter") {
                    focusTarget('#deli');
                    selectTarget('#deli');
                } 
            });

            $('#deli').on('keydown', function(event) {
                if (event.key === "Enter") {
                    focusTarget('#khauk_to');
                    selectTarget('#khauk_to');
                } 
            });

            $('#khauk_to').on('keydown', function(event) {
                if (event.key === "Enter") {
                    focusTarget('#other_expense');
                    selectTarget('#other_expense');
                } 
            });

            $('#other_expense').on('keydown', function(event) {
                if (event.key === "Enter") {
                    focusTarget('#site_shin');
                    selectTarget('#site_shin');
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
