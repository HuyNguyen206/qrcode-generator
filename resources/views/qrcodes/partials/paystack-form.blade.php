<form method="POST" action="{{ route('pay') }}" accept-charset="UTF-8" class="form-horizontal mt-2" role="form">
    @csrf
    <div class="row" style="margin-bottom:40px;">
        <div class="col-md-8 col-md-offset-2">
            <input type="hidden" name="email" value="nguyenlehuyuit@gmail.com"> {{-- required --}}
{{--            <input type="hidden" name="orderID" value="{{$qrcode->id}}">--}}
            <input type="hidden" name="qrcodeId" value="{{$qrcode->id}}">
            <input type="hidden" name="amount" value="{{ $qrcode->amount * 100 }}"> {{-- required in kobo --}}
            <input type="hidden" name="quantity" value="1">
            <input type="hidden" name="currency" value="NGN">
{{--                <input type="hidden" name="metadata" value="{{ json_encode($array = ['user_id' => $user->id]) }}" >--}}{{-- For other necessary things you want to add to your payload. it is optional though --}}
            @guest
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="text" class="form-control" name="email" required>
                </div>
            @endguest
            <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}"> {{-- required --}}

            {{--                        <input type="hidden" name="split_code" value="SPL_EgunGUnBeCareful"> --}}{{-- to support transaction split. more details https://paystack.com/docs/payments/multi-split-payments/#using-transaction-splits-with-payments --}}
            {{--                        <input type="hidden" name="split" value="{{ json_encode($split) }}"> --}}{{-- to support dynamic transaction split. More details https://paystack.com/docs/payments/multi-split-payments/#dynamic-splits --}}
            <p>
                <button class="btn btn-success btn-lg btn-block" type="submit" value="Pay Now!">
                    <i class="fa fa-plus-circle fa-lg"></i> Pay Now!
                </button>
            </p>
        </div>
    </div>
</form>
