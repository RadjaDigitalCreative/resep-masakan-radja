<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'forbidden_names'      => 'user,nastaveni,email,heslo',

    'accepted'             => ':attribute musí být přijato (zaškrtnuto).',
    'active_url'           => 'Hodnota v :attribute není URL adresa.',
    'after'                => ':attribute musí být datum až po :date.',
    'after_or_equal'       => ':attribute musí být datum nejdříve :date.',
    'alpha'                => 'Pole :attribute může obsahovat pouze písmena.',
    'alpha_dash'           => 'Pole :attribute může obsahovat pouze písmena, čísla a pomlčky.',
    'alpha_num'            => 'Pole :attribute může obsahovat pouze písmena a čísla.',
    'array'                => 'Hodnota v :attribute musí být pole.',
    'before'               => ':attribute musí být datum před :date.',
    'before_or_equal'      => ':attribute musí být datum nejpozději :date.',
    'between'              => [
        'numeric' => 'Hodnota :attribute musí být mezi :min a :max.',
        'file'    => 'Soubor :attribute musí mít mezi :min a :max kB.',
        'string'  => ':attribute musí mít mezi :min a :max znaky.',
        'array'   => ':attribute musí mít minimálně :min a maximálně :max položek.',
    ],
    'boolean'              => 'Pole :attribute musí být true nebo false.',
    'confirmed'            => 'Kontrola pole :attribute nesedí.',
    'date'                 => 'Pole :attribute musí být ve formátu data.',
    'date_format'          => 'Pole :attribute musí být ve formátu :format.',
    'different'            => 'Pole :attribute se musí lišit od :other.',
    'digits'               => 'Pole :attribute musí mít :digits čísel.',
    'digits_between'       => 'Pole :attribute musí mít hodnotu mezi :min a :max.',
    'dimensions'           => ':attribute nemá přijatelné rozměry.',
    'distinct'             => 'Pole :attribute má duplicitní hodnotu.',
    'email'                => 'Pole :attribute musí mít opravdovou adresu.',
    'exists'               => 'Zvolený atribut :attribute není validní.',
    'file'                 => ':attribute musí být soubor.',
    'filled'               => 'Pole :attribute musí mít nějakou hodnotu.',
    'image'                => ':attribute musí být obrázek.',
    'in'                   => 'Zvolený atribut :attribute není validní.',
    'in_array'             => 'Hodnota v :attribute není v :other.',
    'integer'              => 'Hodnota v :attribute musí být celé číslo.',
    'ip'                   => 'Hodnota v :attribute musí být validní IP adresa.',
    'json'                 => 'Hodnota v :attribute musí být validní JSON.',
    'max'                  => [
        'numeric' => 'Hodnota :attribute nemůže být větší než :max.',
        'file'    => 'Soubor :attribute nemůže být větší než :max kB.',
        'string'  => ':attribute nemůže mít více než :max znaků.',
        'array'   => ':attribute nemůže mít více než :max položek.',
    ],
    'mimes'                => 'Soubor :attribute musí být typu: :values.',
    'mimetypes'            => 'Soubor :attribute musí být typu: :values.',
    'min'                  => [
        'numeric' => 'Hodnota :attribute musí být alespoň :min.',
        'file'    => 'Soubor :attribute musí mít alespoň :min kB.',
        'string'  => ':attribute musí mít alespoň :min znaků.',
        'array'   => ':attribute musí mít alespoň :min položek.',
    ],
    'not_in'               => 'Zvolený :attribute není validní.',
    'numeric'              => 'Hodnota v :attribute musí být číslo.',
    'present'              => ':attribute musí být přítomen.',
    'regex'                => 'Formát hodnoty v :attribute není přijatelný.',
    'required'             => 'Je nutné vyplnit hodnotu :attribute.',
    'required_if'          => ':attribute je nutné vyplnit pokud :other je :value.',
    'required_unless'      => ':attribute není nutné vyplnit pokud :other je z :values.',
    'required_with'        => ':attribute je nutné vyplnit pokud existuje :values.',
    'required_with_all'    => ':attribute je nutné vyplnit pokud jsou přítomné :values.',
    'required_without'     => ':attribute je nutné vyplnit pokud neexistuje :values.',
    'required_without_all' => ':attribute je nutné vyplnit pokud žádný z :values není přítomen.',
    'same'                 => 'Pole :attribute a :other musí být stejné.',
    'size'                 => [
        'numeric' => 'Hodnota v :attribute musí mít velikost :size.',
        'file'    => 'Soubor :attribute musí mít :size kB.',
        'string'  => ':attribute musí mít :size znaků.',
        'array'   => ':attribute musí mít :size položek.',
    ],
    'string'               => 'Hodnota v :attribute musí být text.',
    'timezone'             => 'Hodnota v :attribute musí být časové pásmo.',
    'unique'               => ':attribute už existuje, musí být unikátní.',
    'uploaded'             => ':attribute se nepovedlo nahrát.',
    'url'                  => 'Formát v :attribute není validní.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'email' => [
            'required'   => 'Zadejte e-mailovou adresu.',
            'email'      => 'E-mailová adresa je ve špatném formátu.',
            'unique'     => 'Tuto e-mailovou adresu už tu někdo používá.',
            'confirmed'  => 'Kontrolní adresa se neshoduje s tou první.',
        ],
        'name' => [
            'required' => 'Jméno je nutné vyplnit.',
            'min' => 'Jméno musí mít alespoň :min znaky.',
            'max' => 'Jméno nesmí mít více než :max znaků.',
        ],

    ],

    'image_size' => 'Obrázek musí být :width široký a :height vysoký.',
    'between'            => ':size1 až :size2 pixelů',
    'lessthan'           => 'méně než :size pixelů',
    'lessthanorequal'    => 'méně než nebo rovno :size pixelů',
    'greaterthan'        => 'více než :size pixelů',
    'greaterthanorequal' => 'více než nebo rovno :size pixelů',
    'equal'              => ':size pixelů',
    'anysize'            => 'kakkoliv',
    'image_aspect' => 'Poměr stran musí být :aspect.',


    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
