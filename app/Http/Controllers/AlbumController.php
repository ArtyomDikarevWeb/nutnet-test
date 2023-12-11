<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\Album\StoreAlbumAction;
use App\Actions\Album\UpdateAlbumAction;
use App\Http\Requests\AlbumRequest;
use App\Models\Album;
use App\Services\Interfaces\MusicLibraryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AlbumController extends Controller
{
    public function __construct(readonly public MusicLibraryInterface $service)
    {}

    public function index(): View
    {
        $albums = Album::query()->paginate(5);

        return view('album.index', ['albums' => $albums]); //Вместо массива можно использовать функцию compact()
    }

    public function show(Album $album): View
    {
        return view('album.show', ['album' => $album]);
    }

    public function create(): View
    {
        return view('album.create');
    }

    public function store(AlbumRequest $request, StoreAlbumAction $action): JsonResponse
    {
        $result = $action($request->dto());

        return $result
            ? response()->json(['data' => [
                'message' => 'success',
                'redirect_to' => route('albums.index')]
            ], 200)
            : response()->json(['errors' => ['message' => 'Something went wrong try again']]);
    }

    public function edit(Album $album): View
    {
        return view('album.edit', ['album' => $album]);
    }

    public function update(Album $album, AlbumRequest $request, UpdateAlbumAction $action): JsonResponse
    {
        $editedAlbum = $action($album, $request->dto(), Auth::user());

        return $editedAlbum
            ? response()->json(['data' => [
                'message' => 'success',
                'redirect_to' => route('albums.show', $editedAlbum)]
            ], 200)
            : response()->json(['errors' => ['message' => 'Something went wrong try again']]);
    }

    public function searchAlbum(): JsonResponse
    {
        $album = $this->service->searchAlbum(request()->query('title'));

        return response()->json(['data' => ['album' => $album]], 200);
    }

    public function getAlbumInfo(): JsonResponse
    {
        $albumInfo = $this->service->getAlbumInfo(request()->query('title'), request()->query('artist'));

        return response()->json(['data' => ['albumInfo' => $albumInfo]], 200);
    }
}
