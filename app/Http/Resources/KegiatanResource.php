<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class KegiatanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return parent::toArray(
            [
                'judul'     => $this->judul,
                'tempat'    => $this->tempat,
                'waktu'     => $this->waktu->format('d-m-Y H:i')
            ]
        );
    }
}
