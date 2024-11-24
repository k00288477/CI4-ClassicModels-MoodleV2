<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\CreditCardRules;
use CodeIgniter\Validation\FileRules;
use CodeIgniter\Validation\FormatRules;
use CodeIgniter\Validation\Rules;

class Validation extends BaseConfig
{
    // --------------------------------------------------------------------
    // Setup
    // --------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var string[]
     */
    public $ruleSets = [
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
    public $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    // --------------------------------------------------------------------
    // Rules
    // --------------------------------------------------------------------

    // Validation rules
    public $user_validation_rules =
    [
        'companyName' => [
            'label' => 'companyName',
            'rules' => 'required',
            'errors' => ['required' => 'You MUST enter a {field}']
        ],
        'contactLastName' => [
            'label' => 'contactLastName',
            'rules' => 'required',
            'errors' => ['required' => 'You MUST supply a {field}.']
        ],
        'contactFirstName' => [
            'label' => 'contactFirstName',
            'rules' => 'required',
            'errors' => ['required' => 'You MUST supply an {field}.']
        ],
        'phone' => [
            'label' => 'phone',
            'rules' => 'required',
            'errors' => ['required' => 'You MUST supply a {field}.']
        ],
        'addressLine1' => [
            'label' => 'addressLine1',
            'rules' => 'required',
            'errors' => ['required' => 'You MUST supply a {field}.']
        ],
        'addressLine2' => [
            'label' => 'addressLine2',
            'rules' => 'required',
            'errors' => ['required' => 'You MUST supply a {field}.']
        ],
        'city' => [
            'label' => 'city',
            'rules' => 'required',
            'errors' => ['required' => 'You MUST supply an {field}.']
        ],
        'state' => [
            'label' => 'state',
            'rules' => 'required',
            'errors' => ['required' => 'You MUST supply a {field}']
        ],
        'postalCode' => [
            'label' => 'postalCode',
            'rules' => 'required',
            'errors' => ['required' => 'You MUST supply a {field}']
        ],
        'country' => [
            'label' => 'country',
            'rules' => 'required',
            'errors' => ['required' => 'You MUST supply a {field}']
        ],
        'email' => [
            'label' => 'email',
            'rules' => 'required',
            'errors' => ['required' => 'You MUST supply a {field}']
        ],
        'password' => [
            'label' => 'password',
            'rules' => 'required',
            'errors' => ['required' => 'You MUST supply a {field}']
        ]
    ];

}
