<div class="col-md-12">
    <div class="row">
        <div class="col-md-8">
            <!-- Product Name Field -->
            <div class="col-sm-12">
                {!! Form::label('product_name', 'Product Name:') !!}
                <p>{{ $qrcode->product_name }}</p>
            </div>

            <!-- Product Url Field -->
            <div class="col-sm-12">
                {!! Form::label('product_url', 'Product Url:') !!}
                <p>{{ $qrcode->product_url }}</p>
            </div>

            <!-- Amount Field -->
            <div class="col-sm-12">
                {!! Form::label('amount', 'Amount:') !!}
                <p>{{ $qrcode->amount }}</p>
            </div>
        </div>
        <div class="col-md-4">
            <img src="{{Storage::url($qrcode->qrcode_path)}}" style="width: 200px" alt="">
           @include('qrcodes.partials.paystack-form')
        </div>
    </div>
    @auth
    <hr>
    @php
        $user = auth()->user()
    @endphp
    @if($user->isAdmin() || $user->isModerator())
    <div class="row">
        <!-- User Id Field -->
        <div class="col-sm-12">
            {!! Form::label('user_id', 'User Id:') !!}
            <p>{{ $qrcode->user->name }}</p>
        </div>

        <!-- Website Field -->
        <div class="col-sm-12">
            {!! Form::label('website', 'Website:') !!}
            <p><a href="{{$qrcode->website}}">{{ $qrcode->website }}</a></p>
        </div>


        <!-- Callback Url Field -->
        <div class="col-sm-12">
            {!! Form::label('callback_url', 'Callback Url:') !!}
            <p><a href="{{ $qrcode->callback_url }}">{{ $qrcode->callback_url }}</a></p>
        </div>

        <!-- Qrcode Path Field -->
        <div class="col-sm-12">
            {!! Form::label('qrcode_path', 'Qrcode Path:') !!}
            <p>{{ $qrcode->qrcode_path }}</p>
        </div>



        <!-- Company Name Field -->
        <div class="col-sm-12">
            {!! Form::label('company_name', 'Company Name:') !!}
            <p>{{ $qrcode->company_name }}</p>
        </div>
    </div>
        @endif
    @endauth
</div>



