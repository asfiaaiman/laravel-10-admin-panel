<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AgentController extends Controller
{
    public function agentDashboard()
    {
        return $this->renderView('agent.agentDashboard', [

        ]);
    }

    protected function renderView($view, array $withParams = [])
    {
        $params = [
            'page' => 'Agent Dashboard',
            'resource' => 'Agent Dashboard',
            'translationFromKey' => 'lang.models.agent.fillable',
            'crud' => [
                'create' => 'javascript:void(0)',
            ],
            'breadcrumbs' => array(
                [
                    'name' => 'Agent Dashboard',
                    'route' => 'javascript:void(0)',
                    'active' => true,
                ],
            ),
        ];
        return parent::renderView($view, array_merge($withParams, $params));
    }
}
