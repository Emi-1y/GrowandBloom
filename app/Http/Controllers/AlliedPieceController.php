<?php

// Author: Emily Cardona Castañeda

namespace App\Http\Controllers;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class AlliedPieceController extends Controller
{
    private const API_URL = 'http://34.10.104.133/public/api/pieces';

    public function index(): View
    {
        $viewData = [];
        $viewData['title'] = __('allied.title');

        try {
            $response = Http::timeout(5)->get(self::API_URL);
            $viewData['pieces'] = $response->successful() ? $response->json() : [];
            $viewData['error'] = $response->successful() ? null : __('allied.error_fetch');
        } catch (ConnectionException) {
            $viewData['pieces'] = [];
            $viewData['error'] = __('allied.error_connection');
        }

        return view('allied-piece.index')->with('viewData', $viewData);
    }
}
