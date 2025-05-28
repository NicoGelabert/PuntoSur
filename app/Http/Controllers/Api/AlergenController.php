<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Alergen;
use App\Http\Requests\StoreAlergenRequest;
use App\Http\Requests\UpdateAlergenRequest;
use App\Http\Resources\AlergenResource;
use App\Http\Resources\AlergenTreeResource;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class AlergenController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page');
        $search = $request->get('search', '');
        
        $sortField = $request->get('sort_field', 'created_at');
        $sortDirection = $request->get('sort_direction', 'desc');
        
        $alergens = Alergen::query()
        ->orderBy($sortField, $sortDirection)
        ->latest()
        ->paginate($perPage);;
        
        return AlergenResource::collection($alergens);
    }

    public function getAsTree()
    {
        return Alergen::getActiveAsTree(AlergenTreeResource::class);
    }

    public function store(StoreAlergenRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = $request->user()->id;
        $data['updated_by'] = $request->user()->id;

        /** @var \Illuminate\Http\UploadedFile $image */
        $image = $data['image'] ?? null;
        // Check if image was given and save on local file system
        if ($image) {
            $relativePath = $this->saveImage($image);
            $data['image'] = URL::to(Storage::url($relativePath));
            $data['image_mime'] = $image->getClientMimeType();
            $data['image_size'] = $image->getSize();
        }

        $alergen = Alergen::create($data);

        return new AlergenResource($alergen);
    }

    public function update(UpdateAlergenRequest $request, Alergen $alergen)
    {
        $data = $request->validated();
        $data['updated_by'] = $request->user()->id;

        /** @var \Illuminate\Http\UploadedFile $image */
        $image = $data['image'] ?? null;
        // Check if image was given and save on local file system
        if ($image) {
            $relativePath = $this->saveImage($image);
            $data['image'] = URL::to(Storage::url($relativePath));
            $data['image_mime'] = $image->getClientMimeType();
            $data['image_size'] = $image->getSize();


            // If there is an old image, delete it
            if ($alergen->image) {
                Storage::deleteDirectory('/public/' . dirname($alergen->image));
            }
        }

        $alergen->update($data);

        return new AlergenResource($alergen);
    }

    public function destroy(Alergen $alergen)
    {
        $alergen->delete();

        return response()->noContent();
    }

    private function saveImage(UploadedFile $image)
    {
        $path = 'images/' . Str::random();
        if (!Storage::exists($path)) {
            Storage::makeDirectory($path, 0755, true);
        }
        if (!Storage::putFileAS('public/' . $path, $image, $image->getClientOriginalName())) {
            throw new \Exception("Unable to save file \"{$image->getClientOriginalName()}\"");
        }


        return $path . '/' . $image->getClientOriginalName();
    }
}
