<!-- Account Id Field -->
<div class="col-sm-12">
    {!! Form::label('account_id', 'Account Id:') !!}
    <p>{{ $accountHistory->account_id }}</p>
</div>

<!-- User Id Field -->
<div class="col-sm-12">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{{ $accountHistory->user_id }}</p>
</div>

<!-- Message Field -->
<div class="col-sm-12">
    {!! Form::label('message', 'Message:') !!}
    <p>{{ $accountHistory->message }}</p>
</div>

