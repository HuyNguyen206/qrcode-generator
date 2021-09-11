<div class="table-responsive">
    <table class="table" id="transactions-table">
        <thead>
        <tr>
            <th>Buyer</th>
        <th>Qrcode Id</th>
        <th>Payment Method</th>
        <th>Qrcode Owner Id</th>
        <th>Amount</th>
        <th>Status</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($transactions as $transaction)
            <tr>
                <td>{{ $transaction->user->name }}</td>
            <td>{{ $transaction->qrcode->product_name }}</td>
                <td>{{ $transaction->payment_method }}</td>
                <td>{{ $transaction->qrcodeOwner->name }}</td>
            <td>{{ $transaction->amount }}</td>
            <td>{{ $transaction->status }}</td>
                <td width="120">
                    <div class='btn-group'>
                        <a href="{{ route('transactions.show', [$transaction->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
