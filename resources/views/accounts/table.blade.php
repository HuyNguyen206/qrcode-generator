<div class="table-responsive">
    <table class="table" id="accounts-table">
        <thead>
        <tr>
            <th>User</th>
        <th>Balance</th>
        <th>Total Credit</th>
        <th>Total Debit</th>
        <th>Country</th>
            <th>Status</th>
        <th>Action</th>
        </thead>
        <tbody>
        @foreach($accounts as $account)
            <tr>
                <td>{{ $account->user->email }}</td>
            <td>${{ number_format($account->balance) }}</td>
            <td>${{ number_format($account->total_credit) }}</td>
            <td>${{ number_format($account->total_debit) }}</td>
            <td>{{ $account->country }}</td>
                <td>{{$account->applied_for_payout ? 'Pending' : ($account->paid ? 'Paid' : null)}}</td>
                <td width="120">
                    {!! Form::open(['route' => ['accounts.destroy', $account->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('accounts.show', [$account->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('accounts.edit', [$account->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-edit"></i>
                        </a>
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
