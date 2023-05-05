<?php

namespace App\Usecase\Dictionary;

use App\Interface\Dictionary\WordSearchInterface;
use Exception;
use Illuminate\Support\Facades\Log;

class WordSearchUsecase
{
    public function __construct(
        private WordSearchInterface $wordSearchRepository,
    ) {}

    public function handle(string $word)
    {
        try {
            $result = $this->wordSearchRepository->request($word);
            return $result;
        } catch (Exception $e) {
            Log::debug($e);
        }
    }
}
