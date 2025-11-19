<?php 

//array of routes - a mapping between routes and controller name and method!
$apis = [
    'users'         => ['controller' => 'UserController', 
                            'methods' => ['signIn'=>'signInUser', 'signUp'=>'addUser', 'getUser'=>'getUser',
                                            'getUsers'=>'getUsers', 'update'=>'updateUser', 'delete'=>'deleteUser']],

    'habits'        => ['controller' => 'HabitController', 
                            'methods' => ['get'=>'getCars', 'add'=>'addCar', 'update'=>'updateCar', 'delete'=>'deleteCar']],

    'entries'       => ['controller' => 'EntryController', 
                            'methods' => ['get'=>'getCars', 'add'=>'addCar', 'update'=>'updateCar', 'delete'=>'deleteCar']],

    'entry_values'  => ['controller' => 'EntryValueController', 
                            'methods' => ['get'=>'getCars', 'add'=>'addCar', 'update'=>'updateCar', 'delete'=>'deleteCar']],                            
];

?>