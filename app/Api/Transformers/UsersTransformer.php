<?php
/**
 * Created by PhpStorm.
 * User: zaxk
 * Date: 2016/8/20
 * Time: 17:14
 */

namespace App\Api\Transformers;

use App\User;
use League\Fractal\TransformerAbstract;

class UsersTransformer extends TransformerAbstract 
{
    public function transform(User $user)
    {
        return [
            'User_id' => $user['id'],
            'User_name' => $user['name'],
            'User_phone' => $user['phone'],
            'User_student_id' => $user['student_id'],
            'User_confirmed' => (boolean)$user['confirmed'],
        ];
    }
}