<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Choose an appropriate redirect depending on the button used
     * to submit the form.
     *
     * @param $request
     * @param $resource
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function redirectResponse($request, $resource)
    {
        if ($request->get('action') == 'save') {
            return redirect(route($this->editRoute, [$this->resourceName => $resource->id]));
        }

        return redirect(route($this->indexRoute));
    }
}
