<?php

namespace App\Http\Requests;

use Bluecloud\ResponseBuilder\Requests\BaseFormRequest;

class CloneRoleRequest extends BaseFormRequest
{

    public function rules(): array
    {
        return [
            'name' => 'required|string'
        ];
    }
}
