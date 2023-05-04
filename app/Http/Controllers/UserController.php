<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function userDashboard()
    {
        return $this->renderView('user.userDashboard', [

        ]);
    }

    protected function renderView($view, array $withParams = [])
    {
        $params = [
            'page' => 'User Dashboard',
            'resource' => 'User Dashboard',
            'translationFromKey' => 'lang.models.user.fillable',
            'crud' => [
                'create' => 'javascript:void(0)',
            ],
            'breadcrumbs' => array(
                [
                    'name' => 'User Dashboard',
                    'route' => 'javascript:void(0)',
                    'active' => true,
                ],
            ),
        ];
        return parent::renderView($view, array_merge($withParams, $params));
    }
}
