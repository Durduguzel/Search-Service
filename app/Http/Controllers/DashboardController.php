<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\DataSource;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->query('title');
        $type = $request->query('type');
        $perPage = 10;

        $query = Content::query();

        // Başlığa göre filtreleme
        if ($keyword) {
            $query->where('title', 'like', "%{$keyword}%");
        }

        // İçerik tipine göre filtreleme
        if ($type && in_array($type, ['video', 'text', 'article'])) {
            $query->where('type', $type);
        }

        $contents = $query->paginate($perPage);

        return view('dashboard.index', compact('contents'));
    }

    public function providers(Request $request)
    {
        $keyword = $request->query('name');
        $perPage = 10;
        $query = DataSource::query();

        // Name'e göre filtreleme
        if ($keyword) {
            $query->where('name', 'like', "%{$keyword}%");
        }

        $providers = $query->paginate($perPage);

        return view('dashboard.providers', compact('providers'));
    }
}
