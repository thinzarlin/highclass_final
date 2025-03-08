@extends('layouts.app')

@section('content')
    <div class="pb-5 text-xl text-gray-700">
        <div>
            <p class="text-3xl font-semibold">Cars</p>
        </div>

        <div class="flex justify-end gap-4 mt-4">
            <a href="{{ route('cars.create') }}" type="button"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-3 me-2 mb-2 focus:outline-none ">Create</a>
            {{-- <a href="{{ route('home-car-main-cbs.index') }}" type="button"
                    class="text-white bg-teal-600 hover:bg-teal-700 focus:ring-4 focus:ring-teal-200 font-medium rounded-lg text-sm px-3 py-3 me-2 mb-2 dark:bg-teal-500 dark:hover:bg-teal-600 focus:outline-none dark:focus:ring-teal-700">Cashbook</a> --}}
            {{-- <a href="{{ route('invoice-receipts.index') }}" type="button"
                    class="text-white bg-sky-600 hover:bg-sky-700 focus:ring-4 focus:ring-sky-200 font-medium rounded-lg text-sm px-3 py-2.5 me-2 mb-2 dark:bg-sky-500 dark:hover:bg-sky-600 focus:outline-none dark:focus:ring-sky-700">Receive</a> --}}
            {{-- <button type="button" id="openBtn"
                    class="text-white bg-green-500 hover:bg-green-700 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-3 py-2.5 me-2 mb-2 dark:bg-green-500 dark:hover:bg-green-600 focus:outline-none dark:focus:ring-green-700">Report</button> --}}
        </div>

        {{-- <div id="overlay"></div>
        <div id="popupDiv">
            <div>
                <form method="POST" action="{{ route('cars.excelExport') }}">
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

        <div class="p-5 text-base bg-white border border-gray-200 rounded-lg shadow width-auto">

            <table class="table table-bordered table-striped table-hover datatable cars-table w-100">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Car No</th>
                        <th>Owner</th>
                        <th>Type</th>
                        <th>Current</th>
                        <th>အိမ်ကား</th>
                        <th>ရောင်းပြီး</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    @if (!$cars->isEmpty())
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($cars as $key => $car)
                            <tr data-entry-id="{{ $car->id }}">
                                <td>{{ $no }}</td>
                                <td>{{ $car->car_no }}</td>
                                <td>{{ $car->owner }}</td>
                                <td>{{ $car->type }}</td>
                                <td>{{ $car->current ? '✔' : '✖' }}</td>
                                <td>{{ $car->home_car ? '✔' : '✖' }}</td>
                                <td>{{ $car->sold ? '✔' : '✖' }}</td>

                                <td class="flex">
                                    <a class="p-2 action_icon" href=" {{ route('cars.edit', $car) }}">

                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                            class="w-5 h-5">
                                            <path
                                                d="m5.433 13.917 1.262-3.155A4 4 0 0 1 7.58 9.42l6.92-6.918a2.121 2.121 0 0 1 3 3l-6.92 6.918c-.383.383-.84.685-1.343.886l-3.154 1.262a.5.5 0 0 1-.65-.65Z" />
                                            <path
                                                d="M3.5 5.75c0-.69.56-1.25 1.25-1.25H10A.75.75 0 0 0 10 3H4.75A2.75 2.75 0 0 0 2 5.75v9.5A2.75 2.75 0 0 0 4.75 18h9.5A2.75 2.75 0 0 0 17 15.25V10a.75.75 0 0 0-1.5 0v5.25c0 .69-.56 1.25-1.25 1.25h-9.5c-.69 0-1.25-.56-1.25-1.25v-9.5Z" />
                                        </svg>

                                    </a>

                                    <form id="delete-{{ $car->id }}" class="inline-block"
                                        action="{{ route('cars.destroy', $car->id) }}" method="POST">
                                        @method('DELETE')
                                        @csrf

                                        <button class="p-2 action_icon" type="button"
                                            onclick="if (confirm('Are you sure you want to delete this?')) document.getElementById('delete-{{ $car->id }}').submit();">

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
                            @php
                                $no++;
                            @endphp
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
</div>
@endSection

@section('scripts')
<script>
    new DataTable('.cars-table');

    $(document).ready(function() {
        // Show popup when clicking the open button
        $("#openBtn").click(function() {
            $("#overlay, #popupDiv").fadeIn();
        });

        // Close popup when clicking the close button
        $("#closeBtn").click(function() {
            $("#overlay, #popupDiv").fadeOut();
        });

        $("#groups").hide();
        $("#sites").hide();

        $("#report_type").change(function() {
            var type = $(this).val();

            switch (type) {
                case "by_group":
                case "credit_by_group":
                    $("#groups").show();
                    $("#groups select").attr("required", true);

                    $("#sites").hide();
                    $("#sites select").removeAttr("required");
                    break;

                case "by_site":
                case "credit_by_site":
                    $("#sites").show();
                    $("#sites select").attr("required", true);

                    $("#groups").hide();
                    $("#groups select").removeAttr("required");
                    break;

                default:
                    $("#sites").hide();
                    $("#sites select").removeAttr("required");

                    $("#groups").hide();
                    $("#groups select").removeAttr("required");
            }
        });
    })
</script>
@endsection
