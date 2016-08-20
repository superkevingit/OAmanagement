<?php
/**
 * Created by PhpStorm.
 * User: zaxk
 * Date: 2016/8/20
 * Time: 15:52
 */

namespace App\Api\Transformers;


use App\OrganizationTag;
use League\Fractal\TransformerAbstract;

class OrganizationTagsTransformer extends TransformerAbstract 
{
    public function transform(OrganizationTag $organizationTag)
    {
       return [
           'OrgTag_id' => $organizationTag['id'],
           'OrgTag_name' => $organizationTag['name'],
           'OrgTag_created_at' => $organizationTag['created_at'],
       ];
    }
}