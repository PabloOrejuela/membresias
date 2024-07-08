<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\StrictRules\CreditCardRules;
use CodeIgniter\Validation\StrictRules\FileRules;
use CodeIgniter\Validation\StrictRules\FormatRules;
use CodeIgniter\Validation\StrictRules\Rules;

class Validation extends BaseConfig
{
    // --------------------------------------------------------------------
    // Setup
    // --------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var list<string>
     */
    public array $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public array $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    // --------------------------------------------------------------------
    // Rules
    // --------------------------------------------------------------------
    public $newMember = [
        'nombre'  => 'required|min_length[5]',
        'email'   => 'required|valid_email|is_unique[miembros.email]',
        'num_documento'  => 'required|is_unique[miembros.num_documento]',
        'telefono'   => 'required',
        'fecha_nacimiento'   => 'required|valid_date',
    ];

    public $newMember_errors = [
        'nombre' => [
            'required' => 'El campo {field} es obligatorio',
            'min_length' => 'El campo {field} debe tener almenos 5 caracteres',
        ],
        'num_documento' => [
            'required' => 'El campo CEDULA es obligatorio',
            'is_unique' => 'Esta CEDULA ya está siendo usada por otra persona',
        ],
        'email' => [
            'required' => 'El campo {field} es obligatorio',
            'valid_email' => 'Debe ingresar un {field} válido',
            'is_unique' => 'Este {field} ya está siendo usado por otra persona',
        ],
        'telefono' => [
            'required' => 'El campo {field} es obligatorio'
        ],
        'fecha_nacimiento' => [
            'required' => 'El campo Fecha de nacimiento es obligatorio',
            'valid_date' => 'El campo Fecha de nacimiento debe tener un formato de fecha correcto',
        ],
    ];

    public $newUser = [
        'nombre'  => 'required|min_length[5]',
        'email'   => 'required|valid_email|is_unique[usuarios.email]',
        'cedula'  => 'required|is_unique[usuarios.cedula]',
        'telefono'   => 'required',
        'idroles'   => 'required|greater_than[0]',

    ];

    public $newUser_errors = [
        'nombre' => [
            'required' => 'El campo {field} es obligatorio',
            'min_length' => 'El campo {field} debe tener almenos 5 caracteres',
        ],
        'cedula' => [
            'required' => 'El campo {field} es obligatorio',
            'is_unique' => 'Esta {field} ya está siendo usada por otra persona',
        ],
        'email' => [
            'required' => 'El campo {field} es obligatorio',
            'valid_email' => 'Debe ingresar un {field} válido',
            'is_unique' => 'Este {field} ya está siendo usado por otra persona',
        ],
        'telefono' => [
            'required' => 'El campo {field} es obligatorio'
        ],
        'idroles' => [
            'required' => 'El campo {field} es obligatorio',
            'greater_than' => 'El campo {field} es obligatorio'
        ],
    ];

    public $updateUser = [
        'nombre'  => 'required|min_length[5]',
        'email'   => 'required|valid_email',
        'cedula'  => 'required',
        'user'  => 'required|min_length[3]',
        'telefono'   => 'required',
        'idroles'   => 'required|greater_than[0]',

    ];

    public $login = [
        'user'  => 'required',
        'password'   => 'required',
    ];

    public $login_errors = [
        'user' => [
            'required' => 'El campo "Usuario" es obligatorio',
        ],
        'password' => [
            'required' => 'El campo "Contraseña" es obligatorio',
        ]
    ];

    public $asistenciaInstructor = [
        'num_documento'  => 'required',
        'nombre'  => 'greater_than[0]'
    ];

    public $asistenciaInstructor_errors = [
        'num_documento' => [
            'required' => 'El campo "Cédula" es obligatorio',
        ],
        'nombre' => [
            'greater_than' => 'El campo "Instructor" es obligatorio',
        ]
    ];

    public $asigna_membresia = [
        'idpaquete'     => 'required|greater_than[0]',
        'idmiembros'     => 'required',
    ];

    public $asigna_membresia_errors = [
        'idpaquete' => [
            'required' => 'El campo "Paquete" es obligatorio',
            'greater_than' => 'El campo "Paquete" es obligatorio',
        ],
        'idmiembros' => [
            'required' => 'El campo "Miembro" es obligatorio',
        ]
    ];

    public $transfiere_membresia = [
        'idmiembros'     => 'required|greater_than[0]',
        'idmembresias'     => 'required',
    ];

    public $transfiere_membresia_errors = [
        'idmiembros' => [
            'required' => 'Debe elegir un miembro para transferir la membresía',
            'greater_than' => 'Debe elegir un miembro para transferir la membresía',
        ],
        'idmembresias' => [
            'required' => 'Hubo un error comuniquese con el administrador del sistema',
        ]
    ];

    public $ReporteAsistenciaInstructores = [
        'fecha_desde'     => 'required|valid_date',
        'fecha_hasta'     => 'required|valid_date',
        'idusuarios'     => 'required|integer',
    ];

    public $ReporteAsistenciaInstructores_errors = [
        'fecha_desde' => [
            'required' => 'Debe elegir una fecha inicial para el reporte',
            'valid_date' => 'La fecha "Desde" no tiene un formato correcto',
        ],
        'fecha_hasta' => [
            'required' => 'Debe elegir una fecha final para el reporte',
            'valid_date' => 'La fecha "Hasta" no tiene un formato correcto',
        ],
        'idusuarios' => [
            'required' => 'Es obligatorio elegir un instructor para generar el reporte',
            'integer' => 'Hay un error al elegir un usuario, contacte al administrador del sistema',
        ],
    ];

    public $edit_miembro = [
        'nombre'     => 'required|min_length[5]',
        'email'        => 'required|valid_email',
        'num_documento'        => 'required',
        'telefono'        => 'required',
        'fecha_nacimiento' => 'required|valid_date'
    ];

    public $edit_miembro_errors = [
        'nombre' => [
            'required' => 'El campo NOMBRE es requerido',
            'min_length' => 'El campo NOMBRE debe tener al menos 5 caracteres',
        ],
        'email' => [
            'required' => 'El campo EMAIL es requerido',
            'valid_email' => 'El campo EMAIL no tiene un formato correcto',
        ],
        'num_documento' => [
            'required' => 'El campo CEDULA es requerido',
        ],
        'telefono' => [
            'required' => 'Es obligatorio elegir un instructor para generar el reporte',
        ],
        'fecha_nacimiento' => [
            'required' => 'El camopo FECHA DE NACIMIENTO es requerido',
            'valid_date' => 'La FECHA DE NACIMIENTO no tiene un formato correcto',
        ],
    ];
}
