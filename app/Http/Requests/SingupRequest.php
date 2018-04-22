<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SingupRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            "initials" => "required",
            "firstname" => "required",
            "lastname" => "required",
            "dateofbirth" => "required|date_format:Y-m-d",
            "sex" => "required|in:m,v",
            "living_place" => "required",
            "living_street" => "required",
            "living_nr" => "required|numeric",
            "living_postcode" => "required",
            "mobile" => "required",
            "emergency_phone" => "required",
            "email" => "required",
            "education" => "required|in:".implode(",",Config("education.studies")),
            "education_type" => "required|in:".implode(",",array_keys(Config("education.types"))),
            "shirt_size" => "required|in:".implode(",",array_keys(Config("shirtsize.size"))),
            "conditions" => "required"
        ];
    }

    public function messages()
    {
        return [
            'initials.required' => 'Voorletters is verplicht!',
            'firstname.required' => 'Voornaam is verplicht!',
            'lastname.required' => 'Achternaam is verplicht!',
            'dateofbirth.required' => 'Geboorte datum is verplicht!',
            'dateofbirth.date_format' => 'Geboorte datum moet een format hebben van yyy-mm-dd!',
            'sex.required' => 'Geslacht verplicht!',
            'sex.in' => 'Selecteer man of vrouw!',
            'living_place.required' => 'Woonplaats is verplicht!',
            'living_street.required' => 'Straat is verplicht!',
            'living_nr.required' => 'Huisnummer is verplicht!',
            'living_nr.numeric' => 'Huisnummer moet een nummer zijn!',
            'living_postcode.required' => 'Postcode is verplicht!',
            'mobile.required' => 'Telfoon mobiel is verplicht!',
            'emergency_phone.required' => 'Telefoon nood is verplicht!',
            'email.required' => 'Email is verplicht!',
            'education.required' => 'Opleiding is verplicht!',
            'education.in' => 'Geen juiste opleiding!',
            'education_type.required' => 'Voltijd/Deeltijd is verplicht!',
            'education_type.required' => 'Selecteer voltijd of deeltijd!',
            'shirt_size.required' => 'Shirt maat is verplicht!',
            'shirt_size.in' => 'Geen juiste maat!',
            'conditions.required' => 'Ga akkoord met de voorwarden!',
        ];
    }
}
