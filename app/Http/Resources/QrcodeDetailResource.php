<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class QrcodeDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'user_id' => $this->user_id,
            'website' => $this->website,
            'amount' => $this->amount,
            'company_name' => $this->company_name,
            'product_name' => $this->product_name,
            'created_at' => $this->created_at->format('Y-m-d h:i:s'),
            'link' => [
                'payment_page_link' => route('qrcodes.show', $this->id),
                'qrcode_link' => Storage::url($this->qrcode_path)
            ],
            'transaction' => $this->transactions
        ];
    }
}
