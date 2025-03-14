<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [
            'id'            => $this->id,
            'first_name'    => $this->first_name,
            'last_name'     => $this->last_name,
            'email'         => $this->email,
            'projects'      => ProjectResource::collection($this->whenLoaded('projects')),
            'timesheets'    => TimesheetResource::collection($this->whenLoaded('timesheets')),
            'created_at'    => $this->created_at,
            'updated_at'    => $this->updated_at,
        ];

        //get token
        if($request->path() == 'api/login'  || $request->path() == 'api/register'){
            $data['token']  = $this->createToken('passportToken')->accessToken;
        }

        return $data;
    }
}
