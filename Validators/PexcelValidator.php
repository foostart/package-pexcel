<?php namespace Foostart\Pexcel\Validators;

use Foostart\Category\Library\Validators\FooValidator;
use Event;
use \LaravelAcl\Library\Validators\AbstractValidator;
use Foostart\Pexcel\Models\Pexcel;

use Illuminate\Support\MessageBag as MessageBag;

class PexcelValidator extends FooValidator
{

    protected $obj_pexcel;

    public function __construct()
    {
        // add rules
        self::$rules = [
            'pexcel_name' => ["required"],
        ];

        // event listening
        Event::listen('validating', function($input)
        {
            self::$messages = [
                'pexcel_name.required' => trans('pexcel-admin.errors.required', ['attribute' => 'pexcel name']),
            ];
        });

        // set configs
        self::$configs = $this->loadConfigs();

        // model
        $this->obj_pexcel = new Pexcel();
    }

    /**
     *
     * @param ARRAY $input is form data
     * @return type
     */
    public function validate($input) {

        $flag = parent::validate($input);

        return $flag;
    }


    /**
     * Load configuration
     * @return ARRAY $configs list of configurations
     */
    public function loadConfigs(){
        $configs = [
            'min_lenght' => config('package-pexcel.name_min_length'),
            'max_lenght' => config('package-pexcel.name_max_length'),
        ];

        return $configs;
    }
}