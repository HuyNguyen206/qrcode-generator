@push('page_scripts')
    <script>
        $(document).ready(function () {
            $("#{{$tableName}}").DataTable();
        });
    </script>
@endpush

@push('page_css')
    <style>
        #{!! $tableName !!}_wrapper {
            padding: 20px !important;
        }
    </style>
@endpush
