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

    'accepted'             => 'El campo :attribute debe ser aceptado.',
    'active_url'           => 'El campo :attribute no es una URL válida.',
    'after'                => 'El campo :attribute debe ser una fecha posterior a :date.',
    'after_or_equal'       => 'El campo :attribute debe ser una fecha posterior o igual a :date.',
    'alpha'                => 'El campo :attribute sólo puede contener letras.',
    'alpha_dash'           => 'El campo :attribute sólo puede contener letras, números y guiones (a-z, 0-9, -_).',
    'alpha_num'            => 'El campo :attribute sólo puede contener letras y números.',
    'array'                => 'El campo :attribute debe ser un array.',
    'before'               => 'El campo :attribute debe ser una fecha anterior a :date.',
    'before_or_equal'      => 'El campo :attribute debe ser una fecha anterior o igual a :date.',
    'between'              => [
        'numeric' => 'El campo :attribute debe ser un valor entre :min y :max.',
        'file'    => 'El archivo :attribute debe pesar entre :min y :max kilobytes.',
        'string'  => 'El campo :attribute debe contener entre :min y :max caracteres.',
        'array'   => 'El campo :attribute debe contener entre :min y :max elementos.',
    ],
    'boolean'              => 'El campo :attribute debe ser verdadero o falso.',
    'confirmed'            => 'El campo confirmación de :attribute no coincide.',
    'date'                 => 'El campo :attribute no corresponde con una fecha válida.',
    'date_format'          => 'El campo :attribute no corresponde con el formato de fecha :format.',
    'different'            => 'Los campos :attribute y :other han de ser diferentes.',
    'digits'               => 'El campo :attribute debe ser un número de :digits dígitos.',
    'digits_between'       => 'El campo :attribute debe contener entre :min y :max dígitos.',
    'dimensions'           => 'El campo :attribute tiene dimensiones inválidas.',
    'distinct'             => 'El campo :attribute tiene un valor duplicado.',
    'email'                => 'El campo :attribute no corresponde con una dirección de e-mail válida.',
    'file'                 => 'El campo :attribute debe ser un archivo.',
    'filled'               => 'El campo :attribute es obligatorio.',
    'exists'               => 'El campo :attribute no existe.',
    'image'                => 'El campo :attribute debe ser una imagen.',
    'in'                   => 'El campo :attribute debe ser igual a alguno de estos valores :values.',
    'in_array'             => 'El campo :attribute no existe en :other.',
    'integer'              => 'El campo :attribute debe ser un número entero.',
    'ip'                   => 'El campo :attribute debe ser una dirección IP válida.',
    'ipv4'                 => 'El campo :attribute debe ser una dirección IPv4 válida.',
    'ipv6'                 => 'El campo :attribute debe ser una dirección IPv6 válida.',
    'json'                 => 'El campo :attribute debe ser una cadena de texto JSON válida.',
    'max'                  => [
        'numeric' => 'El campo :attribute debe ser :max como máximo.',
        'file'    => 'El archivo :attribute debe pesar :max kilobytes como máximo.',
        'string'  => 'El campo :attribute debe contener :max caracteres como máximo.',
        'array'   => 'El campo :attribute debe contener :max elementos como máximo.',
    ],
    'mimes'                => 'El campo :attribute debe ser un archivo de tipo :values.',
    'mimetypes'            => 'El campo :attribute debe ser un archivo de tipo :values.',
    'min'                  => [
        'numeric' => 'El campo :attribute debe tener al menos :min.',
        'file'    => 'El archivo :attribute debe pesar al menos :min kilobytes.',
        'string'  => 'El campo :attribute debe contener al menos :min caracteres.',
        'array'   => 'El campo :attribute no debe contener más de :min elementos.',
    ],
    'not_in'               => 'El campo :attribute seleccionado es inválido.',
    'numeric'              => 'El campo :attribute debe ser un número.',
    'present'              => 'El campo :attribute debe estar presente.',
    'regex'                => 'El formato del campo :attribute es inválido.',
    'required'             => 'El campo :attribute es obligatorio.',
    'required_if'          => 'El campo :attribute es obligatorio cuando el campo :other es :value.',
    'required_unless'      => 'El campo :attribute es requerido a menos que :other se encuentre en :values.',
    'required_with'        => 'El campo :attribute es obligatorio cuando :values está presente.',
    'required_with_all'    => 'El campo :attribute es obligatorio cuando :values está presente.',
    'required_without'     => 'El campo :attribute es obligatorio cuando :values no está presente.',
    'required_without_all' => 'El campo :attribute es obligatorio cuando ninguno de los campos :values está presente.',
    'same'                 => 'Los campos :attribute y :other deben coincidir.',
    'size'                 => [
        'numeric' => 'El campo :attribute debe ser :size.',
        'file'    => 'El archivo :attribute debe pesar :size kilobytes.',
        'string'  => 'El campo :attribute debe contener :size caracteres.',
        'array'   => 'El campo :attribute debe contener :size elementos.',
    ],
    'string'               => 'El campo :attribute debe contener sólo caracteres.',
    'timezone'             => 'El campo :attribute debe contener una zona válida.',
    'unique'               => 'El elemento :attribute ya está en uso.',
    'uploaded'             => 'El elemento :attribute falló al subir.',
    'url'                  => 'El formato de :attribute no corresponde con el de una URL válida.',

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
        'reward_name' => [
            'required'  => 'El campo Recompensa es obligatorio. ',
            'max'       => [
                'numeric' => 'El campo Recompensa debe ser :max como máximo.',
                'file'    => 'El archivo Recompensa debe pesar :max kilobytes como máximo.',
                'string'  => 'El campo Recompensa debe contener :max caracteres como máximo.',
                'array'   => 'El campo Recompensa debe contener :max elementos como máximo.',
            ],
            'unique'    => 'El elemento Recompensa ya está en uso.',
        ],
        'reward_ammount' => [
            'required'  => 'El campo Crédito es obligatorio. ',
            'integer'   => 'El campo Cantidad de Crédito debe ser un número entero.',     
        ],
        'vehicles_user_number_id' => [
            'required'  => 'El campo Empleado es obligatorio. ',
        ],
        'users_user_type_description' => [
            'required'  => 'El campo Tipo es obligatorio. ',
        ],
        'users_user_division_description' => [
            'required'  => 'El campo División es obligatorio. ',
        ],
        'users_user_position_description' => [
            'required'  => 'El campo Cargo es obligatorio. ',
        ],
        'users_user_rol_name' => [
            'required'  => 'El campo Rol es obligatorio. ',
        ],
        'parking_number' => [
            'required'  => 'El campo Cantidad de Parqueadero es obligatorio. ',
            'integer'   => 'El campo Cantidad de Parqueadero debe ser un número entero.',     
        ],
        'parking_name' => [
            'required'  => 'El campo Parqueadero es obligatorio. ',
            'max'       => [
                'numeric' => 'El campo Parqueadero debe ser :max como máximo.',
                'file'    => 'El archivo Parqueadero debe pesar :max kilobytes como máximo.',
                'string'  => 'El campo Parqueadero debe contener :max caracteres como máximo.',
                'array'   => 'El campo Parqueadero debe contener :max elementos como máximo.',
            ],
            'unique'    => 'El elemento Parqueadero ya está en uso.',
        ],
        'parking_description' => [
            'required'  => 'El campo descripción es obligatorio. ',
        ],
        'parking_dimension_name' => [
            'required'  => 'El campo Dimensión es obligatorio. ',
            'max'       => [
                'numeric' => 'El campo Dimensión debe ser :max como máximo.',
                'file'    => 'El archivo Dimensión debe pesar :max kilobytes como máximo.',
                'string'  => 'El campo Dimensión debe contener :max caracteres como máximo.',
                'array'   => 'El campo Dimensión debe contener :max elementos como máximo.',
            ],
            'unique'    => 'El elemento Dimensión ya está en uso.',
        ],
        'parking_dimension_size' => [
            'required'  => 'El campo Tamaño es obligatorio. ',
            'max'       => [
                'numeric' => 'El campo Tamaño debe ser :max como máximo.',
                'file'    => 'El archivo Tamaño debe pesar :max kilobytes como máximo.',
                'string'  => 'El campo Tamaño debe contener :max caracteres como máximo.',
                'array'   => 'El campo Tamaño debe contener :max elementos como máximo.',
            ],
        ],
        'parking_dimension_long' => [
            'required'  => 'El campo Largo es obligatorio. ',
            'numeric' => 'El campo Largo debe ser :max como máximo.',
        ],
        'parking_dimension_height' => [
            'required'  => 'El campo Alto es obligatorio. ',
            'numeric' => 'El campo Alto debe ser :max como máximo.',
        ],
        'parking_dimension_width' => [
            'required'  => 'El campo Ancho es obligatorio. ',
            'numeric' => 'El campo Ancho debe ser :max como máximo.',
        ],
        'parking_section_name' => [
            'required'  => 'El campo Sección es obligatorio. ',
            'max'       => [
                'numeric' => 'El campo Sección debe ser :max como máximo.',
                'file'    => 'El archivo Sección debe pesar :max kilobytes como máximo.',
                'string'  => 'El campo Sección debe contener :max caracteres como máximo.',
                'array'   => 'El campo Sección debe contener :max elementos como máximo.',
            ],
            'unique'    => 'El elemento Sección ya está en uso.',
        ],
        'parking_dimension_icon' => [
            'required'  => 'El campo para la foto es obligatorio. ',
            'image'     => 'El campo para la foto debe ser una imagen.',
            'mimes'     => 'El campo para la foto debe ser un archivo de tipo :values.',
        ],
        'vehicle_name' => [
            'required'  => 'El campo Apodo es obligatorio. ',
        ],
        'vehicle_status' => [
            'required'  => 'El campo Pico y Placa es obligatorio. ',
        ],
        'vehicle_code' => [
            'required'  => 'El campo Placa es obligatorio. ',
            'max'       => [
                'numeric' => 'El campo Placa debe ser :max como máximo.',
                'file'    => 'El archivo Placa debe pesar :max kilobytes como máximo.',
                'string'  => 'El campo Placa debe contener :max caracteres como máximo.',
                'array'   => 'El campo Placa debe contener :max elementos como máximo.',
            ],
            'unique'    => 'El elemento Placa ya está en uso.',
        ],
        'vehicle_year' => [
            'required'  => 'El campo Año es obligatorio. ',
            'digits'    => 'El campo Año debe ser un número de :digits dígitos.',
            'date_format' => 'El campo Año no corresponde con el formato de fecha :format.',
        ],
        'vehicle_image' => [
            'required'  => 'El campo para la foto es obligatorio. ',
            'image'     => 'El campo para la foto debe ser una imagen.',
            'mimes'     => 'El campo para la foto debe ser un archivo de tipo :values.',
        ],
        'vehicle_color_name' => [
            'required'  => 'El campo Clave es obligatorio. ',
        ],
        'repetir_clave' => [
            'required'  => 'El campo Repetir Clave es obligatorio. ',
            'same'   => 'Los campos Repetir Clave y Clave deben coincidir.',
        ],
        'vehicle_color_name' => [
            'required'  => 'El campo Color es obligatorio. ',
            'max'       => [
                'numeric' => 'El campo Color debe ser :max como máximo.',
                'file'    => 'El archivo Color debe pesar :max kilobytes como máximo.',
                'string'  => 'El campo Color debe contener :max caracteres como máximo.',
                'array'   => 'El campo Color debe contener :max elementos como máximo.',
            ],
            'unique'    => 'El elemento Color ya está en uso.',
        ],
        'user_number_id' => [
            'required'  => 'El campo Número ID es obligatorio. ',
            'max'       => [
                'numeric' => 'El campo Número ID debe ser :max como máximo.',
                'file'    => 'El archivo Número ID debe pesar :max kilobytes como máximo.',
                'string'  => 'El campo Número ID debe contener :max caracteres como máximo.',
                'array'   => 'El campo Número ID debe contener :max elementos como máximo.',
            ],
            'unique'    => 'El elemento Número ID ya está en uso.',
        ],
        'user_number_employee' => [
            'required'  => 'El campo Número de Empleado es obligatorio. ',
            'max'       => [
                'numeric' => 'El campo Número de Empleado debe ser :max como máximo.',
                'file'    => 'El archivo Número de Empleado debe pesar :max kilobytes como máximo.',
                'string'  => 'El campo Número de Empleado debe contener :max caracteres como máximo.',
                'array'   => 'El campo Número de Empleado debe contener :max elementos como máximo.',
            ],
            'unique'    => 'El elemento Número de Empleado ya está en uso.',
        ],
        'email' => [
            'required'  => 'El campo E-mail es obligatorio. ',
            'max'       => [
                'numeric' => 'El campo E-mail debe ser :max como máximo.',
                'file'    => 'El archivo E-mail debe pesar :max kilobytes como máximo.',
                'string'  => 'El campo E-mail debe contener :max caracteres como máximo.',
                'array'   => 'El campo E-mail debe contener :max elementos como máximo.',
            ],
            'unique'    => 'El elemento E-mail ya está en uso.',
            'email'     => 'El campo E-mail no corresponde con una dirección de e-mail válida.',

        ],
        'user_firstname' => [
            'required'  => 'El campo Nombres es obligatorio. ',
            'max'       => [
                'numeric' => 'El campo Nombres debe ser :max como máximo.',
                'file'    => 'El archivo Nombres debe pesar :max kilobytes como máximo.',
                'string'  => 'El campo Nombres debe contener :max caracteres como máximo.',
                'array'   => 'El campo Nombres debe contener :max elementos como máximo.',
            ],
        ],
        'user_lastname' => [
            'required'  => 'El campo Apellidos es obligatorio. ',
            'max'       => [
                'numeric' => 'El campo Apellidos debe ser :max como máximo.',
                'file'    => 'El archivo Apellidos debe pesar :max kilobytes como máximo.',
                'string'  => 'El campo Apellidos debe contener :max caracteres como máximo.',
                'array'   => 'El campo Apellidos debe contener :max elementos como máximo.',
            ],
        ],
        'user_type_description' => [
            'required'  => 'El campo Tipo es obligatorio. ',
        ],
        'user_division_description' => [
            'required'  => 'El campo División es obligatorio. ',
        ],
        'user_position_description' => [
            'required'  => 'El campo Cargo es obligatorio. ',
        ],
        'user_rol_name' => [
            'required'  => 'El campo Rol es obligatorio. ',
        ],
        'user_image' => [
            'required'  => 'El campo para la foto es obligatorio. ',
            'image'     => 'El campo para la foto debe ser una imagen.',
            'mimes'     => 'El campo para la foto debe ser un archivo de tipo :values.',
        ],
        'rol_name' => [
            'required'  => 'El campo nombre es obligatorio. ',
            'max'       => [
                'numeric' => 'El campo nombre debe ser :max como máximo.',
                'file'    => 'El archivo nombre debe pesar :max kilobytes como máximo.',
                'string'  => 'El campo nombre debe contener :max caracteres como máximo.',
                'array'   => 'El campo nombre debe contener :max elementos como máximo.',
            ],
            'unique'    => 'El elemento nombre ya está en uso.',
        ],
        'rol_description' => [
            'required'  => 'El campo descripción es obligatorio. ',
        ],
        'user_type_description' => [
            'required'  => 'El campo descripción es obligatorio. ',
            'max'       => [
                'numeric' => 'El campo descripción debe ser :max como máximo.',
                'file'    => 'El archivo descripción debe pesar :max kilobytes como máximo.',
                'string'  => 'El campo descripción debe contener :max caracteres como máximo.',
                'array'   => 'El campo descripción debe contener :max elementos como máximo.',
            ],
            'unique'    => 'El elemento descripción ya está en uso.',
        ],
        'user_position_description' => [
            'required'  => 'El campo descripción es obligatorio. ',
            'max'       => [
                'numeric' => 'El campo descripción debe ser :max como máximo.',
                'file'    => 'El archivo descripción debe pesar :max kilobytes como máximo.',
                'string'  => 'El campo descripción debe contener :max caracteres como máximo.',
                'array'   => 'El campo descripción debe contener :max elementos como máximo.',
            ],
            'unique'    => 'El elemento descripción ya está en uso.',
        ],
        'user_division_description' => [
            'required'  => 'El campo descripción es obligatorio. ',
            'max'       => [
                'numeric' => 'El campo descripción debe ser :max como máximo.',
                'file'    => 'El archivo descripción debe pesar :max kilobytes como máximo.',
                'string'  => 'El campo descripción debe contener :max caracteres como máximo.',
                'array'   => 'El campo descripción debe contener :max elementos como máximo.',
            ],
            'unique'    => 'El elemento descripción ya está en uso.',
        ],
        'vehicle_brand_name' => [
            'required'  => 'El campo marca es obligatorio. ',
            'max'       => [
                'numeric' => 'El campo marca debe ser :max como máximo.',
                'file'    => 'El archivo marca debe pesar :max kilobytes como máximo.',
                'string'  => 'El campo marca debe contener :max caracteres como máximo.',
                'array'   => 'El campo marca debe contener :max elementos como máximo.',
            ],
            'unique'    => 'El elemento marca ya está en uso.',
        ],
        'vehicle_brand_logo' => [
            'image'     => 'El campo logo debe ser una imagen.',
            'mimes'     => 'El campo logo debe ser un archivo de tipo :values.',
        ],
        'vehicle_brand_id' => [
            'required'  => 'El campo marca es obligatorio. ',
        ],
        'vehicle_model_name' => [
            'required'  => 'El campo modelo es obligatorio. ',
            'max'       => [
                'numeric' => 'El campo modelo debe ser :max como máximo.',
                'file'    => 'El archivo modelo debe pesar :max kilobytes como máximo.',
                'string'  => 'El campo modelo debe contener :max caracteres como máximo.',
                'array'   => 'El campo modelo debe contener :max elementos como máximo.',
            ],
            'unique'    => 'El elemento modelo ya está en uso.',
        ],
        'vehicle_type_name' => [
            'required'  => 'El campo tipo es obligatorio. ',
            'max'       => [
                'numeric' => 'El campo tipo debe ser :max como máximo.',
                'file'    => 'El archivo tipo debe pesar :max kilobytes como máximo.',
                'string'  => 'El campo tipo debe contener :max caracteres como máximo.',
                'array'   => 'El campo tipo debe contener :max elementos como máximo.',
            ],
            'unique'    => 'El elemento tipo ya está en uso.',
        ],
        'vehicle_type_icon' => [
            'image'     => 'El campo icono debe ser una imagen.',
            'mimes'     => 'El campo icono debe ser un archivo de tipo :values.',
        ],
    ],

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
