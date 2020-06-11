<table class="table table-separate table-head-custom table-checkable" id="kt_datatable">
    <thead>
        <tr>
            <th class="text-center">Ref No</th>
            <th>Subject</th>
            <th class="text-center">Transaction Type</th>
            <th>Parties</th>
            <th class="text-center">Category</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach(\App\Models\Cases::where('status', 1)->get() as $case)
        <tr>
            <td class="text-center">
                <b>{{ $case->getRefNO() }}</b>
            </td>
            <td>{{ ucwords($case->subject) }}</td>
            <td class="text-center">
                <b>{{ $case->getTransactionType() }}</b>
            </td>
            <td>
                {!! $case->generateCasePartiesBadge() !!}
            </td>
            <td class="text-center">
                <b>{{ $case->getCaseCategory('strtoupper') }}</b>
            </td>
            <td>
                <a href="javascript:;" class="btn btn-sm btn-icon" title="Edit details" data-toggle="modal" data-target="#assignCaseModal{{ $case->id }}">
                    <i class="la la-edit"></i>Assign
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
