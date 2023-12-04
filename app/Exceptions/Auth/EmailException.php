<?php

namespace App\Exceptions\Auth;

use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmailException extends Exception
{
    /**
     * Render the exception as an HTTP response.
     */
    public function render(Request $request): RedirectResponse
    {
        return back(302)->withErrors(["email" => $this->getMessage()]);
    }
}
