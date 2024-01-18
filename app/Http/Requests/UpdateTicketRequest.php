<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTicketRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "ticket[title]" => "required",
            "ticket[description]" => "required",
            "ticket[ticket_category_id]" => "required",
        ];
    }
}
