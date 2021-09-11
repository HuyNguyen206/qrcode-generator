<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $user->name }}</p>
</div>

<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('User role', 'Role:') !!}
    <p>
        @foreach( $user->roles as $role)
            {{$role->name.(!$loop->last ? ', ' : '')}}
        @endforeach
    </p>
</div>

<!-- Email Field -->
<div class="col-sm-12">
    {!! Form::label('email', 'Email:') !!}
    <p>{{ $user->email }}</p>
</div>

<!-- Status Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created at:') !!}
    <p>{{ $user->created_at }}</p>
</div>

