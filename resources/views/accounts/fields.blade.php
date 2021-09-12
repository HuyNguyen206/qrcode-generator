
@if (auth()->user()->isAdmin())
    <!-- Balance Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('balance', 'Balance:') !!}
        {!! Form::number('balance', null, ['class' => 'form-control']) !!}
    </div>

    <!-- Total Credit Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('total_credit', 'Total Credit:') !!}
        {!! Form::number('total_credit', null, ['class' => 'form-control']) !!}
    </div>

    <!-- Total Debit Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('total_debit', 'Total Debit:') !!}
        {!! Form::number('total_debit', null, ['class' => 'form-control']) !!}
    </div>


    <!-- Paid Field -->
    <div class="form-group col-sm-6">
        <div class="form-check">
            {!! Form::hidden('paid', 0, ['class' => 'form-check-input']) !!}
            {!! Form::checkbox('paid', '1', null, ['class' => 'form-check-input']) !!}
            {!! Form::label('paid', 'Paid', ['class' => 'form-check-label']) !!}
        </div>
    </div>
@endif

<!-- Withdrawal Method Field -->
<div class="form-group col-sm-6">
    {!! Form::label('withdrawal_method', 'Withdrawal Method:') !!}
    {!! Form::text('withdrawal_method', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Payment Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('payment_email', 'Payment Email:') !!}
    {!! Form::text('payment_email', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Bank Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('bank_name', 'Bank Name:') !!}
    {!! Form::text('bank_name', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Bank Branch Field -->
<div class="form-group col-sm-6">
    {!! Form::label('bank_branch', 'Bank Branch:') !!}
    {!! Form::text('bank_branch', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Bank Account Field -->
<div class="form-group col-sm-6">
    {!! Form::label('bank_account', 'Bank Account:') !!}
    {!! Form::text('bank_account', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>


<!-- Country Field -->
<div class="form-group col-sm-6">
    {!! Form::label('country', 'Country:') !!}
    {!! Form::text('country', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>


<!-- Other Details Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('other_details', 'Other Details:') !!}
    {!! Form::textarea('other_details', null, ['class' => 'form-control']) !!}
</div>
