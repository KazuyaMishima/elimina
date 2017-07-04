<?php

namespace App\GraphQL\Mutation;

use App\User;
use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL;

class CreateUserMutation extends Mutation
{
    protected $attributes = [
        'name' => 'CreateUser',
        'description' => 'User mutation'
    ];

    public function type()
    {
        return GraphQL::type('User');
    }

    public function args()
    {
        return [
            'name'=>[
                'type'=>Type::nonNull(Type::string())
            ],
            'email'=>[
                'type'=>Type::nonNull(Type::string()),
                'rules'=>['email','unique:users']
            ],
            'password'=>[
                'type'=>Type::nonNull(Type::string()),
                'rules'=>['min:4']
            ]
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        $user = new User();
        $user->fill($args);
        $user->password = bcrypt($args['password']);
        $user->save();
        return $user;

    }
}
