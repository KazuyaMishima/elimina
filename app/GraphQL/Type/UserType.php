<?php

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as BaseType;
use GraphQL;

class UserType extends BaseType
{
    protected $attributes = [
        'name' => 'User',
        'description' => 'A type'
    ];

    public function fields()
    {
        return [
            'id'=>[
                'type'=>Type::nonNull(Type::int())
            ],
            'name'=>[
                'type'=>Type::nonNull(Type::string())
            ],
            'email'=>[
                'type'=>Type::nonNull(Type::string())
            ],
            'create_at'=>[
                'type'=>Type::string()
            ],
            'update_at'=>[
                'type'=>Type::string()
            ],
            
        ];
    }
    protected function resolveEmailField($root, $args)
    {
        return strtolower($root->email);
    }
}
