<?php

namespace App\Http\Controllers\Dictionary;

use App\Http\Controllers\Controller;
use App\Usecase\Dictionary\WordSearchUsecase;
use Illuminate\Http\Request;

class WordSearchController extends Controller
{
    public function __construct(
        private WordSearchUsecase $wordSearchUsecase,
    ) {}


    public function __invoke(Request $request)
    {
        $this->wordSearchUsecase->handle($request->query('word'));
        return response()->json([
            'word' => 'sample',
            'means' => [
                'サンプル',
                '見本',
                'サンプルデータ',
            ]
         ]);
    }
}
