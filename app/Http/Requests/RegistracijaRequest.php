<?php

namespace App\Http\Requests;

use App\Rules\GoogleRecaptchaRule;
use Illuminate\Foundation\Http\FormRequest;

class RegistracijaRequest extends FormRequest
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
        $this->redirect = route('registracija') . '#myTabContent';

        return [
            'ime' => 'required',
            'prezime' => 'required',
            'email' => 'required|email|unique:korisnik,email',
            'telefon' => 'required',
            'naselje_id' => 'required|min:1',
            'ulica_id' => 'required|min:1',
            'broj' => 'required',
            'password' => 'required|confirmed|min:7',
            'g-recaptcha-response' => ['required', new GoogleRecaptchaRule]
        ];
    }

    public function messages()
    {
        return [
            'ime.required' => 'Polje IME je obavezno.',
            'prezime.required' => 'Polje PREZIME je obavezno.',
            'email.required' => 'Polje EMAIL je obavezno.',
            'email.email' => 'Polje EMAIL nije u ispravnom formatu.',
            'email.unique' => 'Korisnički nalog sa zadatim EMAIL-om već postoji.',
            'telefon.required' => 'Polje telefon je obavezno.',
            'naselje_id.required' => 'Polje NASELJE je obavezno.',
            'naselje_id.min' => 'Izaberite NASELJE.',
            'ulica_id.required' => 'Polje ULICA je obavezno.',
            'ulica_id.min' => 'Izaberite ULICU.',
            'broj.required' => 'Polje BROJ je obavezno.',
            'password.required' => 'Lozinka je obavenzna.',
            'password.min' => 'Lozinka mora imati minimum 7 karaktera.',
            'password.confirmed' => 'Lozinke se ne poklapaju.',
            'g-recaptcha-response.required' => 'Polje "Nisam robot" je obavezno.'
        ];
    }
}
