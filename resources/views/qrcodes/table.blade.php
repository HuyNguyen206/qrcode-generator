<div class="table-responsive">
    <table class="table" id="qrcodes-table">
        <thead>
        <tr>
            <th>Product Name</th>
            <th>Website</th>
            <th>Amount</th>
            <th>Status</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($qrcodes as $qrcode)
            <tr>
                <td>
                    <a class="text-white" href="{{ route('qrcodes.show', [$qrcode->id]) }}">{{ $qrcode->product_name }}</a>
                </td>
                <td>{{ $qrcode->website }}</td>
                <td>{{ $qrcode->amount }}</td>
                <td>{{$qrcode->status ? 'Active' : 'InActive'}}</td>
                <td width="120">
                    {!! Form::open(['route' => ['qrcodes.destroy', $qrcode->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('qrcodes.show', [$qrcode->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('qrcodes.edit', [$qrcode->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-edit"></i>
                        </a>
                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
