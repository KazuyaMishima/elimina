<?php

namespace App\GraphQL\Query;

use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL;
use App\User;

class UserQuery extends Query
{
    protected $attributes = [
        'name' => 'User',
        'description' => 'user  query'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('User'));

    }

    public function args()
    {
        return [
            'id' => ['type' => (Type::int())]

        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        if(isset($args['id']))
        {
            return User::find($args['id']);
        }
        else if(isset($args['email']))
        {
            return User::where('email', $args['email'])->get();
        }
        else
        {
            return User::all();

        }
    }
}
