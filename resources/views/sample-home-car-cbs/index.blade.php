@extends('layouts.app')

@section('content')
    <div class="pb-5 text-xl text-gray-700">
        <div>
            <p class="text-3xl font-semibold">Sample Main Cashbook</p>
        </div>

        <div class="flex justify-end gap-4 mt-4 my-6">
            <div>
                <a href="{{ route('sample-home-car-cbs.create') }}" type="button"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-3 me-2 mb-2 focus:outline-none ">Create</a>
            </div>
        </div>

        <div
            class="p-5 text-base bg-white border border-gray-200 rounded-lg shadow width-auto">

            <table class="table table-bordered table-striped table-hover datatable sample-home-car-cbs-table w-100">
                <thead>
                    <tr>
                        <th class="w-32">No</th>
                        <th>ခရီးစဉ်</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    @if (!$cbs->isEmpty())
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($cbs as $key => $cb)
                            <tr data-entry-id="{{ $cb->id }}">
                                <td>{{ $no }}</td>
                                <td>{{ $cb->tour->mm_name }}</td>

                                <td class="flex">
                                    <a class="p-2 action_icon" href=" {{ route('sample-home-car-cbs.edit', $cb) }}">

                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                            class="w-5 h-5">
                                            <path
                                                d="m5.433 13.917 1.262-3.155A4 4 0 0 1 7.58 9.42l6.92-6.918a2.121 2.121 0 0 1 3 3l-6.92 6.918c-.383.383-.84.685-1.343.886l-3.154 1.262a.5.5 0 0 1-.65-.65Z" />
                                            <path
                                                d="M3.5 5.75c0-.69.56-1.25 1.25-1.25H10A.75.75 0 0 0 10 3H4.75A2.75 2.75 0 0 0 2 5.75v9.5A2.75 2.75 0 0 0 4.75 18h9.5A2.75 2.75 0 0 0 17 15.25V10a.75.75 0 0 0-1.5 0v5.25c0 .69-.56 1.25-1.25 1.25h-9.5c-.69 0-1.25-.56-1.25-1.25v-9.5Z" />
                                        </svg>

                                    </a>

                                    <form id="delete-{{ $cb->id }}" class="inline-block"
                                        action="{{ route('sample-home-car-cbs.destroy', $cb->id) }}" method="POST">
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
        new DataTable('.sample-home-car-cbs-table');
        $(document).ready(function() {
            var picker1 = new Pikaday({
                field: document.getElementById('start_date'),
                format: 'DD MMM YYYY',
                defaultDate: moment($('#date').val(), 'YYYY-MM-DD').toDate(),
                setDefaultDate: true
                // onSelect: function() {
                //     document.getElementById('start_date').value = moment(document.getElementById(
                //             'start_date')
                //         .value).format('DD MMM YYYY');
                // },
            });
            var picker2 = new Pikaday({
                field: document.getElementById('end_date'),
                format: 'DD MMM YYYY',
                defaultDate: moment($('#date').val(), 'YYYY-MM-DD').toDate(),
                setDefaultDate: true
                // onSelect: function() {
                //     document.getElementById('end_date').value = moment(document.getElementById(
                //             'end_date')
                //         .value).format('DD MMM YYYY');
                // },
            });
            var picker3 = new Pikaday({
                field: document.getElementById('report_start_date'),
                format: 'DD MMM YYYY',
                defaultDate: moment($('#date').val(), 'YYYY-MM-DD').toDate(),
                setDefaultDate: true
                // onSelect: function() {
                //     document.getElementById('report_start_date').value = moment(document.getElementById(
                //             'report_start_date')
                //         .value).format('DD MMM YYYY');
                // },
            });
            var picker4 = new Pikaday({
                field: document.getElementById('report_end_date'),
                format: 'DD MMM YYYY',
                defaultDate: moment($('#date').val(), 'YYYY-MM-DD').toDate(),
                setDefaultDate: true
                // onSelect: function() {
                //     document.getElementById('report_end_date').value = moment(document.getElementById(
                //             'report_end_date')
                //         .value).format('DD MMM YYYY');
                // },
            });

            @if (isset($start_date))
                picker1.setDate(moment('{{ $start_date }}').toDate());
                picker3.setDate(moment('{{ $start_date }}').toDate());
            @endif

            @if (isset($end_date))
                picker2.setDate(moment('{{ $end_date }}').toDate());
                picker4.setDate(moment('{{ $end_date }}').toDate());
            @endif

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
