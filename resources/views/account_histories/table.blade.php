@php
    $tableName = 'accountHistory';
@endphp
@include('component.data-table')
<div class="table-responsive">
    <table class="table" id="{{$tableName}}">
        <thead>
        <tr>
            <th>Account Id</th>
        <th>User</th>
        <th>Message</th>
            <th>Created at</th>
        </tr>
        </thead>
        <tbody>
        @foreach($accountHistories as $accountHistory)
            <tr>
                <td>{{ $accountHistory->account_id }}</td>
            <td>{{ $accountHistory->user->email }}</td>
            <td>{{ $accountHistory->message }}</td>
                <td>{{ $accountHistory->created_at }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
