<?php

class User
{
    public $name;
    public $email;
    public $dateofbirth;

    public function __construct($data)
    {
        $this->name = $data['name'];
        $this->email = $data['email'];
        $this->dateofbirth = $data['dateofbirth'];
    }
}

class UserRequest
{
    protected static $rules = [
        'name' => 'string',
        'email' => 'string',
        'dateofbirth' => 'string'
    ];

    public static function validate($data){
        foreach (static::$rules as $property => $type){
            if (gettype($data[$property]) != $type){
                throw new \Exception("User property {$property} must be of type {$type}" );
            }
        }
    }
}

class Json{
    public static function from ($data){
        return json_encode($data);
    }
}

class Age{
    public static function now($data){
        $dateofbirth = new DateTime($data['dateofbirth']);
        $today = new Datetime(date('d.m.y'));
        return [
            'year' => $today->diff($dateofbirth)->y,
            'month' => $today->diff($dateofbirth)->m,
            'day' => $today->diff($dateofbirth)->d,
        ];
    }
}

$data = [
    'name' => 'abyan_haidar_luthfi', 
    'email' => 'abyanhl@gmail.com',
    'dateofbirth' => '22.09.2000'
];

UserRequest::validate($data);
$user = new User($data);
print_r(Json::from($user));
echo '<br>';
print_r(Age::now($data));
?>
