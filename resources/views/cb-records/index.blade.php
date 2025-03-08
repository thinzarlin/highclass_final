@extends('layouts.app')

@section('content')
    <div class="pb-5 text-xl text-gray-700">
        <div>
            <p class="text-3xl font-semibold">Cashbook</p>
        </div>

        <div class="flex justify-between gap-4 mt-4">
            <div>
                <form method="GET" action="{{ route('cb-records.index') }}">
                    <div class="flex justify-start gap-4">
                        <div class="mb-2">
                            <label class="block mb-2 text-sm font-bold text-gray-700" for="date">
                                Date
                            </label>
                        </div>
                        <div class="mb-2">
                            <input
                                class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                id="search_date" type="text" placeholder="Date" name="date"
                                value="{{ $date ?? '' }}" autocomplete="off" required>
                        </div>
                        <div class="mb-2">
                            <button
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                                type="submit">
                                Search
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div>
                {{-- <a href="{{ route('cb-records.create') }}" type="button"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-3 me-2 mb-2 focus:outline-none ">Create</a> --}}
                {{-- <a href="{{ route('home-car-main-cbs.index') }}" type="button"
                    class="text-white bg-teal-600 hover:bg-teal-700 focus:ring-4 focus:ring-teal-200 font-medium rounded-lg text-sm px-3 py-3 me-2 mb-2 dark:bg-teal-500 dark:hover:bg-teal-600 focus:outline-none dark:focus:ring-teal-700">Cashbook</a> --}}
                {{-- <a href="{{ route('invoice-receipts.index') }}" type="button"
                    class="text-white bg-sky-600 hover:bg-sky-700 focus:ring-4 focus:ring-sky-200 font-medium rounded-lg text-sm px-3 py-2.5 me-2 mb-2 dark:bg-sky-500 dark:hover:bg-sky-600 focus:outline-none dark:focus:ring-sky-700">Receive</a> --}}
                {{-- <button type="button" id="openBtn"
                    class="text-white bg-green-500 hover:bg-green-700 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-3 py-2.5 me-2 mb-2 dark:bg-green-500 dark:hover:bg-green-600 focus:outline-none dark:focus:ring-green-700">Report</button> --}}
            </div>
        </div>

        {{-- <div id="overlay"></div>
        <div id="popupDiv">
            <div>
                <form method="POST" action="{{ route('cb-records.excelExport') }}">
                    @csrf
                    <div class="grid grid-cols-3 gap-4">
                        <div class="mb-2">
                            <label class="block mb-2 text-sm font-bold text-gray-700" for="report_type">
                                Report
                            </label>
                            <select
                                class="block w-full px-3 py-2 text-sm text-gray-900 bg-white border border-gray-300 rounded-lg shadow focus:ring-blue-500 focus:border-blue-500"
                                id="report_type" name="report_type" required>

                                <optgroup label="Invoices">
                                    <option value="by_date">By Date</option>
                                    <option value="by_group">By Group</option>
                                    <option value="by_site">By Site</option>
                                    <option value="summary_by_employee">Summary By Employee</option>
                                    <option value="summary_by_date">Summary By Date</option>
                                </optgroup>
                                <optgroup label="ကြွေးကျန် (By Employee)">
                                    <option value="credit_by_date">By Date</option>
                                    <option value="credit_by_group">By Group</option>
                                    <option value="credit_by_site">By Site</option>
                                </optgroup>
                                <optgroup label="ကြွေးကျန် (By Date)">
                                    <option value="credit_summary">By Date</option>
                                </optgroup>
                            </select>
                        </div>
                        <div class="mb-2">
                            <label class="block mb-2 text-sm font-bold text-gray-700" for="report_start_date">
                                Start Date
                            </label>
                            <input
                                class="w-full px-3 py-2 leading-tight text-gray-700 border border-red-500 rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                id="report_start_date" type="text" placeholder="Start Date" name="report_start_date"
                                value="{{ $start_date ?? '' }}" autocomplete="off" required>
                        </div>

                        <div class="mb-2">
                            <label class="block mb-2 text-sm font-bold text-gray-700" for="report_end_date">
                                End Date
                            </label>
                            <input
                                class="w-full px-3 py-2 leading-tight text-gray-700 border border-red-500 rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                id="report_end_date" type="text" placeholder="End Date" name="report_end_date"
                                value="{{ $end_date ?? '' }}" autocomplete="off" required>
                        </div>

                        <div class="mb-2" id="groups">
                            <label class="block mb-2 text-sm font-bold text-gray-700" for="group_id">
                                Group
                            </label>

                            <select
                                class="shadow w-full py-2 px-2.5 bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                                id="group_id" name="group_id" required>

                                @foreach ($groups as $key => $group)
                                    <option value="{{ $group->id }}">{{ $group->name }}</option>
                                @endforeach

                            </select>
                        </div>

                        <div class="mb-2" id="sites">
                            <label class="block mb-2 text-sm font-bold text-gray-700" for="site_id">
                                Site
                            </label>

                            <select
                                class="shadow w-full py-2 px-2.5 bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                                id="site_id" name="site_id" required>

                                @foreach ($sites as $key => $site)
                                    <option value="{{ $site->id }}">{{ $site->no }}</option>
                                @endforeach

                            </select>
                        </div>

                        <div class="flex mt-4">
                            <div>
                                <button type="submit"
                                    class="text-white bg-green-500 hover:bg-green-600 font-medium rounded-lg text-sm px-3 py-2.5 me-2 mt-1">Report</button>
                            </div>
                            <div>
                                <button id="closeBtn" type="button"
                                    class="text-white bg-gray-800 hover:bg-gray-900 font-medium rounded-lg text-sm px-3 py-2.5 me-2 mt-1">Cancel</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div> --}}

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-3">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-3">
                <strong class="font-bold">Error!</strong>
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @enderror

        <section class="bg-slate-50 px-4 py-2 border rounded-lg shadow my-2 text-gray-800">
            <div class="flex items-center justify-between" id="formToggleSection">
                <p class="text-xl font-semibold">{{ $cb ? 'Update' : 'Create' }} Record</p>
                <button type="button" class="px-4 py-2 focus:outline-none">
                    <svg class="w-6 h-6 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" fill="none" viewBox="0 0 24 24" id="formShowBtn">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 9-7 7-7-7" />
                    </svg>
                    <svg class="w-6 h-6 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" fill="none" viewBox="0 0 24 24" id="formHideBtn">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m5 15 7-7 7 7" />
                    </svg>
                </button>
            </div>

            <div id="formSection">
                <form method="POST"
                    action="{{ $cb ? route('cb-records.update', $cb->id) : route('cb-records.store') }}"
                    enctype="multipart/form-data">
                    @csrf
                    @if ($cb)
                        @method('PUT')
                    @endif

                    <div class="grid grid-cols-8 gap-4">
                        <div class="hidden mb-2">
                            <label class="block mb-2 text-sm font-bold text-gray-700" for="line_no">
                                Line No
                            </label>
                            <input
                                class="text-right w-full shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                                id="line_no" name="line_no" type="number" min="0"
                                value="{{ old('line_no', $line_no) }}">
                        </div>

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
                            <label class="block mb-2 text-sm font-bold text-gray-700" for="date">
                                Date
                            </label>
                            <input
                                class="w-full shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                                type="text" placeholder="Date" id="date" name="date"
                                value="{{ old('date', $date) }}" autocomplete="off" required>
                            @error('date')
                                <div class="p-1 text-base text-red-600">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-span-2 mb-2">
                            <label class="block mb-2 text-sm font-bold text-gray-700" for="coa_id">
                                Account
                            </label>

                            <select
                                class="select2 shadow w-290 py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                id="coa_id" name="coa_id" required>

                                <option value="" disabled selected hidden>Choose Account</option>
                                @foreach ($coas as $key => $coa)
                                    <option value="{{ $coa->id }}" data-type="{{ $coa->accountType->name }}"
                                        {{ old('coa_id', $cb?->coa_id) == $coa->id ? 'selected' : '' }}>
                                        {{ $coa->code . ' ' . $coa->name }}
                                    </option>
                                @endforeach

                            </select>
                            @error('coa_id')
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
                                id="remark" name="remark" value="{{ old('remark', $cb?->remark) }}"
                                type="text" placeholder="Remark">
                        </div>

                        <div class="mb-2">
                            <label class="block mb-2 text-sm font-bold text-gray-700" for="debit">
                                Debit
                            </label>
                            <input
                                class="text-right w-full shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                                id="debit" name="debit" type="number" placeholder="Debit" min="0"
                                value="{{ old('debit', $cb?->debit ?? 0) }}" required autofocus>
                            @error('debit')
                                <div class="p-1 text-base text-red-600">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-2">
                            <label class="block mb-2 text-sm font-bold text-gray-700" for="credit">
                                Credit
                            </label>
                            <input
                                class="text-right w-full shadow py-1 px-2.5 leading-[2] bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                                id="credit" name="credit" type="number" placeholder="Credit" min="0"
                                value="{{ old('credit', $cb?->credit ?? 0) }}" required>
                            @error('credit')
                                <div class="p-1 text-base text-red-600">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-2 flex gap-4">
                            <button
                                class="px-4 py-2.5 text-sm font-bold text-white bg-blue-500 rounded-lg hover:bg-blue-700 focus:outline-none focus:shadow-outline"
                                type="submit">
                                {{ $cb ? 'Update' : 'Create' }}
                            </button>
                            <a class="px-4 py-2.5 text-sm font-bold text-white bg-blue-500 rounded-lg hover:bg-blue-700 focus:outline-none focus:shadow-outline"
                                href="{{ route('cb-records.index') }}">
                                Cancel
                            </a>
                        </div>

                    </div>
                </form>
            </div>
        </section>

        <div class="p-5 text-base bg-white border border-gray-200 rounded-lg shadow width-auto">

            <table class="table table-bordered table-striped table-hover datatable cb-records-table w-100">
                <thead>
                    <tr>
                        <th>Sr No</th>
                        <th>Ref No</th>
                        <th>Account Code</th>
                        <th>Description</th>
                        <th>Remark</th>
                        <th>Debit</th>
                        <th>Credit</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    @if (!$cbs->isEmpty())
                        @foreach ($cbs as $key => $cb)
                            <tr data-entry-id="{{ $cb->id }}">
                                <td>{{ $cb->line_no }}</td>
                                <td>{{ $cb->ref_no }}</td>
                                <td>{{ $cb->coa->code }}</td>
                                <td>{{ $cb->coa->name }}</td>
                                <td>{{ $cb->remark }}</td>
                                <td>{{ number_format($cb->debit) }}</td>
                                <td>{{ number_format($cb->credit) }}</td>

                                <td class="flex">
                                    <a class="p-2 action_icon"
                                        href=" {{ route('cb-records.index', ['id' => $cb->id]) }}">

                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                            fill="currentColor" class="w-5 h-5">
                                            <path
                                                d="m5.433 13.917 1.262-3.155A4 4 0 0 1 7.58 9.42l6.92-6.918a2.121 2.121 0 0 1 3 3l-6.92 6.918c-.383.383-.84.685-1.343.886l-3.154 1.262a.5.5 0 0 1-.65-.65Z" />
                                            <path
                                                d="M3.5 5.75c0-.69.56-1.25 1.25-1.25H10A.75.75 0 0 0 10 3H4.75A2.75 2.75 0 0 0 2 5.75v9.5A2.75 2.75 0 0 0 4.75 18h9.5A2.75 2.75 0 0 0 17 15.25V10a.75.75 0 0 0-1.5 0v5.25c0 .69-.56 1.25-1.25 1.25h-9.5c-.69 0-1.25-.56-1.25-1.25v-9.5Z" />
                                        </svg>

                                    </a>

                                    <form id="delete-{{ $cb->id }}" class="inline-block"
                                        action="{{ route('cb-records.destroy', $cb->id) }}" method="POST">
                                        @method('DELETE')
                                        @csrf

                                        <button class="p-2 action_icon" type="button"
                                            onclick="if (confirm('Are you sure you want to delete this?')) document.getElementById('delete-{{ $cb->id }}').submit();">

                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                fill="currentColor" class="w-5 h-5">
                                                <path fill-rule="evenodd"
                                                    d="M8.75 1A2.75 2.75 0 0 0 6 3.75v.443c-.795.077-1.584.176-2.365.298a.75.75 0 1 0 .23 1.482l.149-.022.841 10.518A2.75 2.75 0 0 0 7.596 19h4.807a2.75 2.75 0 0 0 2.742-2.53l.841-10.52.149.023a.75.75 0 0 0 .23-1.482A41.03 41.03 0 0 0 14 4.193V3.75A2.75 2.75 0 0 0 11.25 1h-2.5ZM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4ZM8.58 7.72a.75.75 0 0 0-1.5.06l.3 7.5a.75.75 0 1 0 1.5-.06l-.3-7.5Zm4.34.06a.75.75 0 1 0-1.5-.06l-.3 7.5a.75.75 0 1 0 1.5.06l.3-7.5Z"
                                                    clip-rule="evenodd" />
                                            </svg>

                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
</div>
@endSection

@section('scripts')
<script>
    new DataTable('.cb-records-table', {
        paging: false,
        info: false,
    });
    $('.select2').select2();

    const cbExist = {{ $cb ? '1' : '0' }};

    $('#formSection').hide();
    $('#formHideBtn').hide();

    $(document).ready(function() {
        var picker1 = new Pikaday({
            field: document.getElementById('search_date'),
            format: 'DD-MM-YYYY',
        });

        var picker2 = new Pikaday({
            field: document.getElementById('date'),
            format: 'DD-MM-YYYY',
        });

        @if (isset($date))
            picker1.setDate(moment('{{ $date }}').toDate());
            picker2.setDate(moment('{{ $date }}').toDate());
        @endif

        function formToggle() {
            $('#formSection').slideToggle(300);
            $('#formHideBtn').toggle();
            $('#formShowBtn').toggle();
        }

        $('#formToggleSection').click(function() {
            formToggle();
        });

        $('#remark').on('keydown', function(event) {
            if (event.key === "Enter") {
                var coaType = $('#coa_id :selected').data('type');

                if (coaType == 'Expense') {
                    focusTarget("#credit");
                    selectTarget("#credit");
                } else {
                    focusTarget("#debit");
                    selectTarget("#debit");
                }
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

        function formatDate(date) {
            const arr = date.split('-');
            if (arr.length == 0) {
                return '';
            }
            return `${arr[2]}-${arr[1]}-${arr[0]}`;
        }

        $('#date').on('change', function() {
            const date = formatDate($(this).val());
            let oldDate = '';
            let refNo = '';
            
            if (cbExist == '1') {
                oldDate = formatDate('{{ $cb?->date }}');
                refNo = '{{ $cb?->ref_no }}';
            }

            $.ajax({
                url: '{{ route('cb-records.date_related_info') }}',
                method: 'GET',
                data: {
                    date: date,
                    old_date: oldDate,
                    old_ref_no: refNo,
                },
                success: function(response) {
                    $('#ref_no').val(response.ref_no);
                    $('#line_no').val(response.line_no);
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

        // // Show popup when clicking the open button
        // $("#openBtn").click(function() {
        //     $("#overlay, #popupDiv").fadeIn();
        // });

        // // Close popup when clicking the close button
        // $("#closeBtn").click(function() {
        //     $("#overlay, #popupDiv").fadeOut();
        // });

        // $("#groups").hide();
        // $("#sites").hide();

        // $("#report_type").change(function() {
        //     var type = $(this).val();

        //     switch (type) {
        //         case "by_group":
        //         case "credit_by_group":
        //             $("#groups").show();
        //             $("#groups select").attr("required", true);

        //             $("#sites").hide();
        //             $("#sites select").removeAttr("required");
        //             break;

        //         case "by_site":
        //         case "credit_by_site":
        //             $("#sites").show();
        //             $("#sites select").attr("required", true);

        //             $("#groups").hide();
        //             $("#groups select").removeAttr("required");
        //             break;

        //         default:
        //             $("#sites").hide();
        //             $("#sites select").removeAttr("required");

        //             $("#groups").hide();
        //             $("#groups select").removeAttr("required");
        //     }
        // });
    })
</script>
@endsection
