<!-- Qrcode Id Field -->
<div class="col-sm-12">
    {!! Form::label('qrcode_id', 'Product name:  ') !!}
    <p> <a href="{{ route('qrcodes.show', [$transaction->qrcode->id]) }}">
        {{ $transaction->qrcode->product_name }}</p>
        </a>

</div>
<!-- User Id Field -->
<div class="col-sm-12">
    {!! Form::label('user_id', 'Buyer name:') !!}
    <p><a href="{{ route('users.show', [$transaction->user->id])}}">{{ $transaction->user->name}} | {{$transaction->user->email}}</a> </p>
</div>
<!-- Qrcode Owner Id Field -->
<div class="col-sm-12">
    {!! Form::label('qrcode_owner_id', 'Qrcode Owner name:') !!}
    <p><a href="{{route('users.show', [$transaction->qrcodeOwner->id])}}">{{ $transaction->qrcodeOwner->name }}</a></p>
</div>

<!-- Payment Method Field -->
<div class="col-sm-12">
    {!! Form::label('payment_method', 'Payment Method:') !!}
    <p>{{ $transaction->payment_method }}</p>
</div>



<!-- Message Field -->
<div class="col-sm-12">
    {!! Form::label('message', 'Message:') !!}
    <p>{{ $transaction->message }}</p>
</div>

<!-- Amount Field -->
<div class="col-sm-12">
    {!! Form::label('amount', 'Amount:') !!}
    <p>{{ $transaction->amount }}</p>
</div>

<!-- Status Field -->
<div class="col-sm-12">
    {!! Form::label('status', 'Status:') !!}
    <p>{{ $transaction->status }}</p>
</div>

<!-- Status Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created at:') !!}
    <p>{{ $transaction->created_at }}</p>
</div>

