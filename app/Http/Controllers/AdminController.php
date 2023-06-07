<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function adminDashboard()
    {
        return $this->renderView('admin.index', [

        ]);
    }

    protected function renderView($view, array $withParams = [])
    {
        $params = [
            'page' => 'Administrator',
            'resource' => 'Administrator',
            'translationFromKey' => 'lang.models.admin.fillable',
            'crud' => [
                'create' => 'javascript:void(0)',
            ],
            'breadcrumbs' => array(
                [
                    'name' => 'Administrator',
                    'route' => 'javascript:void(0)',
                    'active' => true,
                ],
            ),
        ];
        return parent::renderView($view, array_merge($withParams, $params));
    }
}
