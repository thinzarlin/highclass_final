@extends('layouts.app')

@section('content')
    <div class="pb-5 text-xl text-gray-700">

        <div class="flex justify-start mt-1">
            @php
                $route =
                    $from == 'main'
                        ? route('home-car-mains.edit', $homeCarMainCb->main->id)
                        : route('home-car-main-cbs.index');
            @endphp
            <a href="{{ $route }}" type="button"
                class="text-white bg-gray-700  focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2.5 me-2 mb-2">
                back</a>
        </div>

        <div>
            <p class="mb-2 text-3xl font-semibold">Edit Record</p>
        </div>

        <div class="w-full">
            <form method="POST" action="{{ route('home-car-main-cbs.update', $homeCarMainCb->id) }}"
                enctype="multipart/form-data" class="px-6 pt-4 pb-8 mb-4 bg-white rounded-lg shadow-lg">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-6 gap-4">
                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="ref_no">
                            Ref No
                        </label>
                        <input type="hidden" name="main_id" value="{{ old('main_id', $homeCarMainCb->main->id) }}">
                        <input type="hidden" name="from" value="{{ $from }}">
                        <input
                            class="w-full shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="ref_no" type="text" placeholder="Ref No" name="ref_no"
                            value="{{ old('ref_no', $homeCarMainCb->ref_no) }}" readonly required>

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
                            value="{{ old('out_date', $homeCarMainCb->main->out_date) }}" required>


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
                            value="{{ old('in_date', $homeCarMainCb->main->in_date) }}" required>


                        @error('in_date')
                            <div class="p-1 text-base text-red-600">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="tour">
                            ခရီးစဉ်
                        </label>
                        <input
                            class="w-full shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="tour" name="tour" type="text" placeholder="ခရီးစဉ်"
                            value="{{ old('tour', $homeCarMainCb->main->tour->short_name) }}" readonly>
                    </div>

                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="car_no">
                            ကားနံပါတ်
                        </label>
                        <input
                            class="w-full shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="car_no" name="car_no" type="text" placeholder="ကားနံပါတ်"
                            value="{{ old('car_no', $homeCarMainCb->main->car->car_no) }}" readonly>
                    </div>
                </div>

                <div class="grid grid-cols-4 gap-4">
                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="driver_1">
                            ယာဉ်မောင်း ၁
                        </label>
                        <input
                            class="w-full shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="driver_1" name="driver_1" type="text" placeholder="ယာဉ်မောင်း ၁"
                            value="{{ old('driver_1', $homeCarMainCb->main->daily_car_list->driver_1?->name) }}" readonly>
                    </div>

                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="driver_2">
                            ယာဉ်မောင်း ၂
                        </label>
                        <input
                            class="w-full shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="driver_2" name="driver_2" type="text" placeholder="ယာဉ်မောင်း ၂"
                            value="{{ old('driver_2', $homeCarMainCb->main->daily_car_list->driver_2?->name) }}" readonly>
                    </div>

                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="spare">
                            နောက်လိုက်
                        </label>
                        <input
                            class="w-full shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="spare" name="spare" type="text" placeholder="နောက်လိုက်"
                            value="{{ old('spare', $homeCarMainCb->main->daily_car_list->spare?->name) }}" readonly>
                    </div>

                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="crew">
                            ယာဉ်မောင်/ယာဉ်မယ်
                        </label>
                        <input
                            class="w-full shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="crew" name="crew" type="text" placeholder="ယာဉ်မောင်/ယာဉ်မယ်"
                            value="{{ old('crew', $homeCarMainCb->main->daily_car_list->crew?->name) }}" readonly>
                    </div>
                </div>


                <section id="detailSection">
                    <div class="grid grid-cols-9 gap-4">
                        <div class="hidden mb-2">
                            <label class="block mb-2 text-sm font-bold text-gray-700" for="line_no">
                                Line No
                            </label>
                            <input
                                class="text-right w-full shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                                id="line_no" name="max_line_no" type="number" min="0"
                                value="{{ old('max_line_no', count($homeCarMainCb->details) + 1) }}">
                        </div>

                        <div class="col-span-2 mb-2">
                            <label class="block mb-2 text-sm font-bold text-gray-700" for="coa_id">
                                Account
                            </label>

                            <select
                                class="select2 shadow w-full py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                id="coa_id">

                                <option value="" disabled selected hidden>Choose Account</option>
                                @foreach ($coas as $key => $coa)
                                    <option value="{{ $coa->id }}" data-name="{{ $coa->name }}"
                                        data-code="{{ $coa->code }}">
                                        {{ $coa->code . ' ' . $coa->name }}
                                    </option>
                                @endforeach

                            </select>
                        </div>

                        <div class="col-span-2 mb-2">
                            <label class="block mb-2 text-sm font-bold text-gray-700" for="remark">
                                Remark
                            </label>
                            <input
                                class="w-full shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                                id="remark" type="text" placeholder="Remark">
                        </div>

                        <div class="mb-2">
                            <label class="block mb-2 text-sm font-bold text-gray-700" for="debit">
                                Debit
                            </label>
                            <input
                                class="text-right w-full shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                                id="debit" type="number" placeholder="Debit" min="0" value="0">
                        </div>

                        <div class="mb-2">
                            <label class="block mb-2 text-sm font-bold text-gray-700" for="credit">
                                Credit
                            </label>
                            <input
                                class="text-right w-full shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                                id="credit" type="number" placeholder="Credit" min="0" value="0">
                        </div>

                        <div class="mb-2 mt-7">
                            <button
                                class="px-5 py-2.5 font-bold text-base text-white bg-blue-500 rounded-lg hover:bg-blue-700 focus:outline-none focus:shadow-outline"
                                type="button" id="addBtn">
                                Add
                            </button>
                        </div>

                    </div>

                    <div class="mb-4">
                        <div class="relative overflow-x-auto">
                            <table
                                class="w-full text-sm text-left rtl:text-right text-gray-500 shadow-md detail-table datatable">
                                <thead class="text-sm text-white font-bold text-center uppercase bg-blue-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 w-2 border-blue-300"></th>
                                        <th scope="col" class="px-6 py-3 w-2 border-blue-300">
                                            No.
                                        </th>
                                        <th scope="col" class="px-6 py-3 w-20 border-blue-300">
                                            Code
                                        </th>
                                        <th scope="col" class="px-6 py-3 w-72 border-blue-300">
                                            Account Name
                                        </th>
                                        <th scope="col" class="px-6 py-3 border-blue-300">
                                            Remark
                                        </th>
                                        <th scope="col" class="px-6 py-3 w-32 border-blue-300">
                                            Debit
                                        </th>
                                        <th scope="col" class="px-6 py-3 w-32 border-blue-300">
                                            Credit
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($homeCarMainCb->details)
                                        @foreach ($homeCarMainCb->details as $detail)
                                            <tr class="bg-slate-50 text-gray-800 text-sm border-b border-gray-200">
                                                <td class="px-3 py-2 border">
                                                    <button type="button" class="deleteBtn">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                            fill="currentColor" class="w-5 h-5">
                                                            <path fill-rule="evenodd"
                                                                d="M8.75 1A2.75 2.75 0 0 0 6 3.75v.443c-.795.077-1.584.176-2.365.298a.75.75 0 1 0 .23 1.482l.149-.022.841 10.518A2.75 2.75 0 0 0 7.596 19h4.807a2.75 2.75 0 0 0 2.742-2.53l.841-10.52.149.023a.75.75 0 0 0 .23-1.482A41.03 41.03 0 0 0 14 4.193V3.75A2.75 2.75 0 0 0 11.25 1h-2.5ZM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4ZM8.58 7.72a.75.75 0 0 0-1.5.06l.3 7.5a.75.75 0 1 0 1.5-.06l-.3-7.5Zm4.34.06a.75.75 0 1 0-1.5-.06l-.3 7.5a.75.75 0 1 0 1.5.06l.3-7.5Z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                    </button>
                                                </td>

                                                <td class="px-3 py-2 text-right border"><input type="hidden"
                                                        value="{{ $detail->line_no }}"
                                                        name='line_no[]'>{{ $detail->line_no }}
                                                </td>
                                                <td class="px-3 py-2 border text-right">{{ $detail->coa->code }}</td>
                                                <td class="px-3 py-2 border"><input type="hidden"
                                                        value="{{ $detail->coa_id }}" name='coa_id[]'><input
                                                        type="hidden" value="{{ $detail->coa->name }}"
                                                        name='coa_name[]'>{{ $detail->coa->name }}</td>

                                                <td class="px-3 py-2 border"><input type="hidden"
                                                        value="{{ $detail->remark }}"
                                                        name='remark[]'>{{ $detail->remark }}</td>
                                                <td class="px-3 py-2 text-right border"><input type="hidden"
                                                        value="{{ $detail->debit }}" name='debit[]'>{{ $detail->debit }}
                                                </td>
                                                <td class="px-3 py-2 text-right border"><input type="hidden"
                                                        value="{{ $detail->credit }}"
                                                        name='credit[]'>{{ $detail->credit }}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>

                    @error('line_no')
                        <div class="p-1 text-base text-red-600">
                            The details cannot be empty.
                        </div>
                    @enderror
                </section>
                
                <div class="flex justify-end gap-5">
                    <div class="mb-2">
                        <input
                            class="text-right w-32 shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="net_amount_debit_label" name="net_amount_debit_label" type="text" placeholder="Net Amount"
                            value="{{ old('net_amount_debit_label', number_format($homeCarMainCb->net_amount_debit)) }}" readonly>
                    </div>

                    <div class="mb-2">
                        <input
                            class="text-right w-32 shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="net_amount_credit_label" name="net_amount_credit_label" type="text" placeholder="Net Amount"
                            value="{{ old('net_amount_credit_label', number_format($homeCarMainCb->net_amount_credit)) }}" readonly>
                    </div>
                </div>

                <div class="flex justify-end gap-5">
                    <div class="mb-2">
                        <input
                            class="text-right w-32 shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="total_1_label" name="total_1_label" type="text" placeholder="Total"
                            value="{{ old('total_1_label', number_format($homeCarMainCb->total)) }}" readonly>
                    </div>

                    <div class="mb-2">
                        <input
                            class="text-right w-32 shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="total_2_label" name="total_2_label" type="text" placeholder="Total"
                            value="{{ old('total_2_label', number_format($homeCarMainCb->total)) }}" readonly>
                    </div>
                </div>

                <div class="flex justify-end gap-5">
                    <div class="mb-2">
                        <input
                            class="text-right w-32 shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="total_income_label" name="total_income_label" type="text" placeholder="Debit Total"
                            value="{{ old('total_income_label', number_format($homeCarMainCb->total_income)) }}" readonly>
                    </div>

                    <div class="mb-2">
                        <input
                            class="text-right w-32 shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="total_expense_label" name="total_expense_label" type="text" placeholder="Credit Total"
                            value="{{ old('total_expense_label', number_format($homeCarMainCb->total_expense)) }}" readonly>
                    </div>
                </div>

                <div class="justify-end gap-5 hidden">
                    <div class="mb-2">
                        <input
                            class="text-right w-32 shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="net_amount_debit" name="net_amount_debit" type="number" placeholder="Net Amount"
                            value="{{ old('net_amount_debit', $homeCarMainCb->net_amount_debit) }}" readonly>
                    </div>

                    <div class="mb-2">
                        <input
                            class="text-right w-32 shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="net_amount_credit" name="net_amount_credit" type="number" placeholder="Net Amount"
                            value="{{ old('net_amount_credit', $homeCarMainCb->net_amount_credit) }}" readonly>
                    </div>
                </div>

                <div class="justify-end gap-5 hidden">
                    <div class="mb-2">
                        <input
                            class="text-right w-32 shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="total_1" name="total_1" type="number" placeholder="Total"
                            value="{{ old('total_1', $homeCarMainCb->total) }}" readonly>
                    </div>

                    <div class="mb-2">
                        <input
                            class="text-right w-32 shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="total_2" name="total_2" type="number" placeholder="Total"
                            value="{{ old('total_2', $homeCarMainCb->total) }}" readonly>
                    </div>
                </div>

                <div class="justify-end gap-5 hidden">
                    <div class="mb-2">
                        <input
                            class="text-right w-32 shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="total_income" name="total_income" type="number" placeholder="Debit Total"
                            value="{{ old('total_income', $homeCarMainCb->total_income) }}" readonly>
                    </div>

                    <div class="mb-2">
                        <input
                            class="text-right w-32 shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                            id="total_expense" name="total_expense" type="number" placeholder="Credit Total"
                            value="{{ old('total_expense', $homeCarMainCb->total_expense) }}" readonly>
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
        $('.select2').select2();

        $(document).ready(function() {
            var picker1 = new Pikaday({
                field: document.getElementById('out_date'),
                format: 'DD-MM-YYYY',
            });

            var picker2 = new Pikaday({
                field: document.getElementById('in_date'),
                format: 'DD-MM-YYYY',
            });

            function formatDate(date) {
                const arr = date.split('-');
                if (arr.length == 0) {
                    return '';
                }
                return `${arr[2]}-${arr[1]}-${arr[0]}`;
            }

            function calTotal() {
                let netIncomeDebit = 0;
                let netIncomeCredit = 0;
                let total = 0;
                let totalDebit = 0;
                let totalCredit = 0;

                $(".detail-table tbody tr").each(function() {
                    const rowDebit = parseInt($(this).find("td:eq(5)").text()) || 0;
                    const rowCredit = parseInt($(this).find("td:eq(6)").text()) || 0;

                    totalDebit += rowDebit;
                    totalCredit += rowCredit;
                });

                if (totalDebit > totalCredit) {
                    total = totalDebit;
                    netIncomeDebit = totalDebit - totalCredit;
                } else {
                    total = totalCredit;
                    netIncomeCredit = totalCredit - totalDebit;
                }

                $('#net_amount_debit').val(netIncomeDebit);
                $('#net_amount_credit').val(netIncomeCredit);
                $('#total_1').val(total);
                $('#total_2').val(total);
                $('#total_income').val(totalDebit);
                $('#total_expense').val(totalCredit);

                $('#net_amount_debit_label').val(netIncomeDebit.toLocaleString());
                $('#net_amount_credit_label').val(netIncomeCredit.toLocaleString());
                $('#total_1_label').val(total.toLocaleString());
                $('#total_2_label').val(total.toLocaleString());
                $('#total_income_label').val(totalDebit.toLocaleString());
                $('#total_expense_label').val(totalCredit.toLocaleString());
            }

            $('#in_date').on('change', function() {
                const in_date = formatDate($(this).val());

                $.ajax({
                    url: '{{ route('home-car-main-cbs.generate_ref_no') }}',
                    method: 'GET',
                    data: {
                        in_date: in_date
                    },
                    success: function(response) {
                        $('#ref_no').val(response.ref_no);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching ref_no: ', error);
                    }
                });
            });

            $("#addBtn").click(function() {
                var lineNo = $("#line_no").val();
                var coa = $("#coa_id").val();
                var coaCode = $('#coa_id :selected').data('code');
                var coaName = $('#coa_id :selected').data('name');
                var remark = $("#remark").val();
                var debit = $("#debit").val();
                var credit = $("#credit").val();

                if (!lineNo || !coa || !debit || !credit) {
                    alert("Please fill the relevant fields.");
                    return false;
                }

                let lineNoCol = "<input type='hidden' value='" + lineNo +
                    "' name='line_no[]'>" +
                    lineNo;
                let coaCodeCol = coaCode;
                let coaCol = "<input type='hidden' value='" + coa +
                    "' name='coa_id[]'>" + "<input type='hidden' value='" + coaName +
                    "' name='coa_name[]'>" +
                    coaName;
                let remarkCol = "<input type='hidden' value='" + remark +
                    "' name='remark[]'>" + remark;
                let debitCol = "<input type='hidden' value='" + debit + "' name='debit[]'>" +
                    debit;
                let creditCol = "<input type='hidden' value='" + credit +
                    "' name='credit[]'>" +
                    credit;

                let existingRow = $(".detail-table tbody tr").filter(function() {
                    return $(this).find('td:eq(1) input').val() == lineNo;
                });

                if (existingRow.length > 0) {
                    existingRow.find('td:eq(2)').html(coaCodeCol);
                    existingRow.find('td:eq(3)').html(coaCol);
                    existingRow.find('td:eq(4)').html(remarkCol);
                    existingRow.find('td:eq(5)').html(debitCol);
                    existingRow.find('td:eq(6)').html(creditCol);
                } else {
                    var newRow = $("<tr>").append(
                        $("<td>").append(
                            '<button type="button" class="deleteBtn">' +
                            '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">' +
                            '<path fill-rule="evenodd" d="M8.75 1A2.75 2.75 0 0 0 6 3.75v.443c-.795.077-1.584.176-2.365.298a.75.75 0 1 0 .23 1.482l.149-.022.841 10.518A2.75 2.75 0 0 0 7.596 19h4.807a2.75 2.75 0 0 0 2.742-2.53l.841-10.52.149.023a.75.75 0 0 0 .23-1.482A41.03 41.03 0 0 0 14 4.193V3.75A2.75 2.75 0 0 0 11.25 1h-2.5ZM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4ZM8.58 7.72a.75.75 0 0 0-1.5.06l.3 7.5a.75.75 0 1 0 1.5-.06l-.3-7.5Zm4.34.06a.75.75 0 1 0-1.5-.06l-.3 7.5a.75.75 0 1 0 1.5.06l.3-7.5Z" clip-rule="evenodd" /></svg>' +
                            '</button>'
                        ).addClass('px-3 py-2 border'),
                        $("<td>").append(lineNoCol).addClass('px-3 py-2 text-right border'),
                        $("<td>").append(coaCodeCol).addClass('px-3 py-2 text-right border'),
                        $("<td>").append(coaCol).addClass('px-3 py-2 border'),
                        $("<td>").append(remarkCol).addClass('px-3 py-2 border'),
                        $("<td>").append(debitCol).addClass('px-3 py-2 text-right border'),
                        $("<td>").append(creditCol).addClass('px-3 py-2 text-right border'),
                    ).addClass('bg-slate-50 text-gray-800 text-sm border-b border-gray-200');

                    $(".detail-table").append(newRow);
                }

                calTotal();

                let count = 0;
                $(".detail-table tbody tr").each(function(index, row) {
                    count += 1;
                });

                $('#line_no').val(count + 1);
                $("#remark").val("");
                $("#coa_id").val("").trigger('change');
                $("#debit, #credit").val("0");

                focusTarget('#debit');
                selectTarget('#debit');
            });

            $(".detail-table tbody").on("click", "tr", function() {
                if ($(event.target).closest(".deleteBtn").length) {
                    return;
                }

                let lineNo = $(this).find("td:eq(1) input").val();
                let coa = $(this).find("td:eq(3) input").val();
                let remark = $(this).find("td:eq(4) input").val();
                let debit = $(this).find("td:eq(5) input").val();
                let credit = $(this).find("td:eq(6) input").val();

                $('#line_no').val(lineNo);
                $("#coa_id").val(coa).trigger('change');
                $("#debit").val(debit);
                $("#credit").val(credit);
                $("#remark").val(remark);

                focusTarget('#debit');
                selectTarget('#debit');
            });

            $(".detail-table").on('click', 'button.deleteBtn', function(event) {
                event.stopPropagation();

                if (confirm("Are you sure you want to delete this row?")) {
                    $(this).closest('tr').remove();

                    var count = 0;
                    $(".detail-table tbody tr").each(function(index, row) {
                        var lineNoCol = "<input type='hidden' value='" + (index + 1) +
                            "' name='line_no[]'>" +
                            (index + 1);

                        $(row).find('td:eq(1)').html(lineNoCol);
                        count += 1;
                    });

                    $('#line_no').val(count + 1);

                    calTotal();
                }
            });

            $('#coa_id').on('keydown', function(event) {
                if (event.key === "Enter") {
                    focusTarget("#remark");
                    selectTarget("#remark");
                }
            });

            $('#remark').on('keydown', function(event) {
                if (event.key === "Enter") {
                    focusTarget("#debit");
                    selectTarget("#debit");
                }
            });

            $('#debit').on('keydown', function(event) {
                if (event.key === "Enter") {
                    focusTarget("#credit");
                    selectTarget("#credit");
                }
            });

            $('#credit').on('keydown', function(event) {
                if (event.key === "Enter") {
                    $('#addBtn').click();
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
