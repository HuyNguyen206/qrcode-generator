@extends('layouts.app')

@section('content')
    @php
        $user = auth()->user()
    @endphp
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Account Details</h1>

                    @if($account->applied_for_payout)
                        <small class="text-muted">
                            Request payout pending
                        </small>
                    @endif

                </div>
                <div class="col-sm-6">
                    <div class="btn btn-group float-right">
                        @if($user->isOwnerOfAccount($account) && !$account->applied_for_payout)
                            {!! Form::open(['route' => ['accounts.applyPayout', $account->id], 'method' => 'post']) !!}
                            {!! Form::button('Apply for payout', ['type' => 'submit', 'class' => 'btn btn-primary btn-sm']) !!}
                            {!! Form::close() !!}
                        @endif
                        @if(($user->isAdmin() || $user->isModerator()) && !$account->paid)
                            {!! Form::open(['route' => ['accounts.markAsPaid', $account->id], 'method' => 'post']) !!}
                            {!! Form::button('Mark as paid', ['type' => 'submit', 'class' => 'btn btn-success btn-sm']) !!}
                            {!! Form::close() !!}
                        @endif
                        <a class="btn btn-secondary btn-sm"
                           href="{{ route('accounts.index') }}">
                            Back
                        </a>

                    </div>

                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    @include('accounts.show_fields')
                </div>
                <div class="row">
                    <h3>
                        Account histories
                    </h3>
                    @include('account_histories.table')
                </div>
            </div>
        </div>
    </div>
@endsection
