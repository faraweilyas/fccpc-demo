<table class="table table-separate table-head-custom table-checkable" id="kt_datatable">
    <thead>
        <tr>
            <th class="text-center">Ref No</th>
            <th>Subject</th>
            <th class="text-center">Transaction Type</th>
            <th>Parties</th>
            <th class="text-center">Category</th>
        </tr>
    </thead>
    <tbody>
        @foreach(\App\Models\Cases::all() as $case)
        <tr>
            <td class="text-center">
                <b>{{ $case->getRefNO() }}</b>
            </td>
            <td>{{ ucwords($case->subject) }}</td>
            <td class="text-center">
                <span class="label label-lg font-weight-bold label-light-secondary text-dark label-inline">{{ $case->getType() }}</span>
            </td>
            <td>
                {!! $case->generateCasePartiesBadge() !!}
            </td>
            <td class="text-center">
                <b>{{ $case->getCategory('strtoupper') }}</b>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
