<?php
/**
 * Created by PhpStorm.
 * User: zaxk
 * Date: 2016/8/20
 * Time: 11:44.
 */
namespace App\Api\Controllers;

use App\Api\Transformers\OrganizationTagsTransformer;
use App\OrganizationTag;

class OrganizationTagsController extends BaseController
{
    public function index()
    {
        $org_tag = OrganizationTag::all();

        return $this->collection($org_tag, new OrganizationTagsTransformer());
    }

    public function show($id)
    {
        $org_tag = OrganizationTag::find($id);
        if (!$org_tag) {
            return $this->response->errorNotFound('无此标签');
        }

        return $this->item($org_tag, new OrganizationTagsTransformer());
    }
}
