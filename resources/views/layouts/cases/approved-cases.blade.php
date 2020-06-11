<table class="table table-separate table-head-custom table-checkable" id="kt_datatable">
    <thead>
        <tr>
            <th class="text-center">Ref No</th>
            <th>Subject</th>
            <th class="text-center">Transaction Type</th>
            <th>Parties</th>
            <th>Category</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach(\App\Models\Cases::where('status', 4)->get() as $case)
        <tr>
            <td class="text-center">
                <b>{{ $case->getRefNO() }}</b>
            </td>
            <td>{{ ucwords($case->subject) }}</td>
            <td class="text-center">
                <span class="label label-lg font-weight-bold label-light-secondary text-dark label-inline"><b>{{ $case->transaction_type }}</b></span>
            </td>
            <td>
                {!! $case->generateCasePartiesBadge() !!}
            </td>
            <td>
                <b>{{ $case->getCaseCategory('strtoupper') }}</b>
            </td>
            <td>
                <a href="{{ route('cases.review', ['id' => $case->id]) }}" class="btn btn-sm btn-icon text-hover-primary" title="View Case">
                    <i class="la la-info-circle"></i>&nbsp;&nbsp;Review
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>