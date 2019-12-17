<?php

namespace App\Http\Controllers\API\Product;

use App\Http\Resources\ProductResource;
use App\Models\Product\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:api')->except(['index', 'show']);
    }


    public function index()
    {
        //
        return ProductResource::collection(Product::latest()->paginate(25));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = self::required($request);
        if ($validation->fails()) {
            return response()->json(['success'=> false, 'errors'=> $validation->messages()], 422);
        } else {
            $product = new Product();
            $product = self::fields($product, $request);
            return new ProductResource($product);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {

        $validation = self::required($request);
        if ($validation->fails()) {
            return response()->json(['success'=> false, 'error'=> $validation->messages()], 422);
        } else {
            $product = self::fields($product, $request);
            return new ProductResource($product);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Product $product)
    {
            $product->delete();
            return response()->json(null, 204);

    }

    //Filling Model
    public function fields($object, Request $request) {
        $data                       = $request->all();
        $object->title              = $data['title'];
        $object->price              = $data['price'];
        $object->price_new          = $data['price_new'];
        $object->lp_product_id      = $data['lp_product_id'];

        $object->title_upsale              = $data['title_upsale'];
        $object->price_upsale              = $data['price_upsale'];
        $object->price_upsale_new          = $data['price_upsale_new'];
        $object->lp_product_id_upsale      = $data['lp_product_id_upsale'];

        if (!empty($data['slug'])) {
            $object->slug           = $data['slug'];
        }

        if (!empty($data['landing_page'])) {
            $object->landing_page       = $data['landing_page'];
        }

        if (!empty($data['active'])) {
            $object->active             = $data['active'];
        }

        $object->save();

        if (!empty($data['image_landing'])) {

            $regex = '/^[^\/]+\/([\w]+)/';
            preg_match($regex, $data['image_landing'], $extension);
            $name = time() . '.' . $extension[1];

            if (!empty($object->image_landing)) {
                Storage::delete($object->image_landing);
            }

            $path = storage_path('app/public/img/products/'.$object->id.'/landing_image');
            $path_relative = 'public/img/products/'.$object->id.'/landing_image/';
            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }
            Image::make($data['image_landing'])->save($path.'/'.$name);
            $object->image_landing      = $path_relative.$name;
        }

        if (!empty($data['image_upsale'])) {

            $regex = '/^[^\/]+\/([\w]+)/';
            preg_match($regex, $data['image_upsale'], $extension);
            $name = time() . '.' . $extension[1];

            if (!empty($object->image_upsale)) {
                Storage::delete($object->image_upsale);
            }

            $path = storage_path('app/public/img/products/'.$object->id.'/image_upsale');
            $path_relative = 'public/img/products/'.$object->id.'/image_upsale/';
            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }
            Image::make($data['image_upsale'])->save($path.'/'.$name);
            $object->image_upsale      = $path_relative.$name;
        }

        $object->save();
        return $object;
    }

    //Validate Form
    public function required(Request $request) {
        $rules = array(
            'title'                    => 'required|string|min:3|max:255',
            'price'                    => "required|string|min:1|max:12",
            'price_new'                => "required|string|min:1|max:12",
            'lp_product_id'            => "required|integer|min:0",
            'image'                    => "sometimes|nullable",
            'images'                   => "sometimes|nullable",
            'image_landing'            => "sometimes|nullable",
            'slug'                     => "sometimes|nullable|string|min:1|max:255",
            'active'                   => "sometimes|nullable",
            'landing_page'             => "sometimes|nullable",

            'title_upsale'            => 'required|string|min:3|max:255',
            'image_upsale'            => "sometimes|nullable",
            'price_upsale'            => "required|string|min:1|max:12",
            'price_upsale_new'        => "required|string|min:1|max:12",
            'lp_product_id_upsale'    => "sometimes|nullable|integer|min:0",
        );
        return  $validator = Validator::make($request->all(), $rules);
    }
}
