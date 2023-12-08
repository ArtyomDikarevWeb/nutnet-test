<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\Album\StoreAlbumAction;
use App\Actions\Album\UpdateAlbumAction;
use App\Http\Requests\CreateAlbumRequest;
use App\Http\Requests\UpdateAlbumRequest;
use App\Models\Album;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class AlbumController extends Controller
{
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
        /*
         * Вообще правильным решением было бы не передавать апи ключ, потому что это секретная вещь, а сделать
         * в контроллере ещё несколько нужных нам медотов (searchAlbum(), getAlbumInfo()) и работать с ними асинхронно
         * через контроллер, используя сервис LastFMService, но я об этом поздно подумал, когда заканчивал проект,
         * а переделывать займёт время, поэтому решил остановиться на этом, определённо неудачном решении в прод разработке.
         */
        return view('album.create', ['last_fm_api_key' => env('LAST_FM_API_KEY')]);
    }

    public function store(CreateAlbumRequest $request, StoreAlbumAction $action): JsonResponse
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

    public function update(Album $album, UpdateAlbumRequest $request, UpdateAlbumAction $action): View
    {
        $editedAlbum = $action($album, $request->dto());

        return view('album.edit', ['album' => $editedAlbum]);
    }
}
