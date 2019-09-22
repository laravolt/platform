<?php

namespace Laravolt\Platform\Http\Controllers;

class StoreMedia
{
    public function __invoke()
    {
        try {
            $files = request('file');
            $json = [];
            $i = 1;

            foreach ($files as $file) {
                $media = auth()->user()->addMedia($file)->toMediaCollection();
                $json["file-$i"] = [
                    'url' => $media->getUrl(),
                    'id' => $media->getKey(),
                ];
                $i++;
            }

            return response()->json($json);
        } catch (\Exception $e) {
            return response()->json(
                [
                    'error' => $e->getMessage(),
                ]
            );
        }
    }
}
