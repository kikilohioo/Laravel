<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChampionshipRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'max:255'],
            'description' => ['required', 'max:1000'],
            'id_user' => ['required'],
            'departament' => ['required'],
            'city' => ['required'],
            'direction' => ['required'],
            'cash' => ['required'],
            'transfer' => ['required'],
            'online' => ['required'],
            'abitab_redpagos' => ['required'],
            'beach' => ['required'],
            'max_teams' => ['required'],
            'datetime' => ['required'],
            'group_stage' => ['required'],
            'competition_format' => ['required'],
            'sets' => ['required', 'min:1'],
            'final_sets' => ['required'],
            'points' => ['required', 'min:1'],
            'final_points' => ['required'],
            'gold_cup' => ['required'],
            'silver_cup' => ['required'],
            'bronce_cup' => ['required'],
            'participation_reward' => ['required'],
            'gender' => ['required', 'in:MIX,MAS,FEM']
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function () {
            //logica que no es esfecificamente de las reglas, pero se requiere validar
        });
    }
}
