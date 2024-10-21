<?php

namespace App\Http\Controllers;

use App\Services\Http\Assignment\NextService;
use Illuminate\Contracts\View\View;

class AssignmentController extends Controller
{
    public function next(int $companyId): View
    {
        $service = new NextService($companyId);

        return $service->execute();
    }
}
