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

    'accepted' => 'El :attribute debe estar aceptado.',
    'active_url' => 'El :attribute no es una URL valida.',
    'after' => 'El :attribute debe ser una fecha después de :date.',
    'after_or_equal' => 'El :attribute debe ser un dato despues o igual que :date.',
    'alpha' => 'El :attribute solo puede contener letras.',
    'alpha_dash' => 'El :attribute solo puede contener letras, numeros, guiones y sub-guiones.',
    'alpha_num' => 'El :attribute solo puede contener letras y numeros.',
    'array' => 'El :attribute debe ser una matriz.',
    'before' => 'El :attribute debe ser una fecha antes de :date.',
    'before_or_equal' => 'El :attribute debe ser una fecha antes o igual que :date.',
    'between' => [
        'numeric' => 'El :attribute debe estar entre :min y :max.',
        'file' => 'El :attribute debe estar entre :min y :max kilobytes.',
        'string' => 'El :attribute debe estar entre :min y :max caracteres.',
        'array' => 'El :attribute debe tener entre :min y :max elementos.',
    ],
    'boolean' => 'El campo del :attribute  debe ser verdadero o falso.',
    'confirmed' => 'El :attribute confirmacion no coinciden.',
    'date' => 'El :attribute no es una fecha valida.',
    'date_equals' => 'El :attribute debe ser una fecha igual que :date.',
    'date_format' => 'El :attribute no coincide con el formato :format.',
    'different' => 'El :attribute y :other deben ser diferentes.',
    'digits' => 'El :attribute debe ser :digits digitos.',
    'digits_between' => 'EL :attribute debe estar entre :min y :max digitos.',
    'dimensions' => 'El :attribute tiene dimensiones de imagen invalida.',
    'distinct' => 'El campo del :attribute tiene un valor duplicado.',
    'email' => 'El :attribute debe ser una direccion de correo valida.',
    'exists' => 'El :attribute seleccionado es invalido.',
    'file' => 'El :attribute debe ser un archivo.',
    'filled' => 'El campo del :attribute debe tener un valor.',
    'gt' => [
        'numeric' => 'El :attribute debe ser mayor que :value.',
        'file' => 'El :attribute debe ser mayor que :value kilobytes.',
        'string' => 'El :attribute debe ser mayor que :value caracteres.',
        'array' => 'El :attribute debe tener mas que :value elementos.',
    ],
    'gte' => [
        'numeric' => 'El :attribute debe ser mayor o igual que :value.',
        'file' => 'El :attribute debe ser mayor o igual que :value kilobytes.',
        'string' => 'El :attribute debe ser mayor o igual que :value caracteres.',
        'array' => 'El :attribute debe tener :value elementos o mas.',
    ],
    'image' => 'El :attribute debe ser una imagen.',
    'in' => 'El :attribute seleccionado es invalido.',
    'in_array' => 'El campo del :attribute  no existe en :other.',
    'integer' => 'El :attribute debe ser un entero.',
    'ip' => 'El :attribute debe ser un direcion IP valida.',
    'ipv4' => 'El :attribute debe ser una direccion IPv4 valida.',
    'ipv6' => 'El :attribute debe ser una direccion IPv6 valida.',
    'json' => 'El :attribute debe ser una cadena JSON valida.',
    'lt' => [
        'numeric' => 'El :attribute debe ser menor que :value.',
        'file' => 'El :attribute debe ser menor que :value kilobytes.',
        'string' => 'El :attribute debe ser menor que :value caracteres.',
        'array' => 'El :attribute debe tener mens que :value elementos.',
    ],
    'lte' => [
        'numeric' => 'El :attribute debe ser menor o igual que :value.',
        'file' => 'El :attribute debe ser menor o igual que :value kilobytes.',
        'string' => 'El :attribute debe ser menor o igual que :value caracteres.',
        'array' => 'El :attribute no debe tener mas que :value elementos.',
    ],
    'max' => [
        'numeric' => 'El :attribute no puede ser mayor que :max.',
        'file' => 'El :attribute no puede ser mayor que :max kilobytes.',
        'string' => 'El :attribute no puede ser mayor que :max caracteres.',
        'array' => 'El :attribute o puede tener mas que :max elementos.',
    ],
    'mimes' => 'El :attribute debe ser un archivo de tipo: :values.',
    'mimetypes' => 'El :attribute debe ser un archivo de tipo: :values.',
    'min' => [
        'numeric' => 'El :attribute debe ser por lo menos :min.',
        'file' => 'El :attribute debe ser por lo menos :min kilobytes.',
        'string' => 'El :attribute debe ser por lo menos :min caracteres.',
        'array' => 'El :attribute debe tener por lo menos :min elementos.',
    ],
    'not_in' => 'El :attribute seleccionado es invalido.',
    'not_regex' => 'El formato de :attribute es invalido.',
    'numeric' => 'El :attribute debe ser un numero.',
    'present' => 'El campo del :attribute debe estar presente.',
    'regex' => 'El formate de :attribute es invalido.',
    'required' => 'El campo del :attribute es  necesario.',
    'required_if' => 'El campo del :attribute  es necesario cuando :other es :value.',
    'required_unless' => 'El campo del :attribute es necesario a menos que  :other este en :values.',
    'required_with' => 'El campo del :attribute es necesario cuando :values esta presente.',
    'required_with_all' => 'El campo del  :attribute es necesario cuando :values estan presentes.',
    'required_without' => 'El campo del  :attribute es necesario cuando :values no esta presente.',
    'required_without_all' => 'El campo del :attribute es necesario cuando ninguno de los :values estan presentes.',
    'same' => 'El :attribute y :other deben ser iguales.',
    'size' => [
        'numeric' => 'El :attribute debe ser :size.',
        'file' => 'El :attribute debe ser :size kilobytes.',
        'string' => 'El :attribute debe ser :size caracteres.',
        'array' => 'El :attribute debe contener :size elementos.',
    ],
    'starts_with' => 'El :attribute debe iniciar con uno de los siguientes:  :values',
    'string' => 'El :attribute debe ser una cadena.',
    'timezone' => 'El :attribute debe ser una zona valida.',
    'unique' => 'El :attribute ya ha sido tomado.',
    'uploaded' => 'El :attribute no se pudo cargar.',
    'url' => 'El formate de :attribute es invalido.',
    'uuid' => 'El :attribute debe ser una UUID valida.',

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
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
