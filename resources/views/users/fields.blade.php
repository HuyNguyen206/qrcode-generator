<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('Role', 'Roles:') !!}
    <select  class="form-control"  multiple name="roles[]">
        <option value="0" disabled>--Select role--</option>
        @foreach($roles as $role)
            <option value="{{$role->id}}" {{$user->roles->contains('id',$role->id) ? 'selected' : ''}}>{{$role->name}}</option>
        @endforeach
    </select>

</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, ['class' => 'form-control','maxlength' => 255,'readonly' => true]) !!}
</div>


@push('page_scripts')
    <script type="text/javascript">
        $('#email_verified_at').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush
