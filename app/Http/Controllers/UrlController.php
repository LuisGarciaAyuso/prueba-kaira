<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShortUrl;
use App\Repositories\UrlRepository;
use App\Services\ShortUrlService;
use Exception;
use Illuminate\Http\Response;
use RuntimeException;

class UrlController extends Controller
{
    /**
     * @var ShortUrlService
     */
    protected $shortUrlService;

    /**
     * @var UrlRepository
     */
    protected $urlRepository;

    /**
     * @param ShortUrlService $shortUrlService
     * @param UrlRepository $urlRepository
     */
    public function __construct(ShortUrlService $shortUrlService, UrlRepository $urlRepository)
    {
        $this->shortUrlService = $shortUrlService;
        $this->urlRepository   = $urlRepository;
    }

    /**
     * @param ShortUrl $request
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function short(ShortUrl $request)
    {
        $url      = $request->get('url');
        $data     = ['url' => $url];
        $shortUrl = $this->shortUrlService->create($data);
        if ($shortUrl && array_key_exists('url', $shortUrl)) {
            $this->urlRepository->create([
                'url'               => $url,
                'short_url'         => $shortUrl['url'],
                'shortening_method' => $this->shortUrlService::NAME ?? null
            ]);
        }

        return response()->json($shortUrl);
    }
}
