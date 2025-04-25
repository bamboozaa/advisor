<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class TestCacheController extends Controller
{
    public function clearCache()
    {
        Cache::forget('test_key');
        return response()->json(['message' => 'Cache cleared']);
    }

    public function checkCache()
    {
        if (Cache::has('test_key')) {
            return response()->json(['message' => 'Cache exists', 'value' => Cache::get('test_key')]);
        } else {
            return response()->json(['message' => 'Cache does not exist']);
        }
    }

    public function setCache()
    {
        Cache::put('test_key', 'test_value', 60); // Cache for 60 minutes
        return response()->json(['message' => 'Cache set']);
    }
    public function getCache()
    {
        $value = Cache::get('test_key');
        return response()->json(['message' => 'Cache retrieved', 'value' => $value]);
    }
    public function testCache()
    {
        $value = Cache::remember('test_key', 60, function () {
            return 'test_value';
        });
        return response()->json(['message' => 'Cache tested', 'value' => $value]);
    }





}
