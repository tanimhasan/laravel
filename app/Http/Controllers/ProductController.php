<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Category;
use App\Product;
use Illuminate\Http\Request;
use Image;
use DB;

class ProductController extends Controller
{
    public function index(){
        $categories = Category::where('publication_status',1)->get();
        $brands = Brand::where('publication_status',1)->get();
        return view('admin.product.add-product',[
            'categories' => $categories,
            'brands' => $brands
        ]);
    }
    protected function productInfoValidate($request){
        $this->validate($request, [
            'product_name' => 'required'
        ]);
    }
    protected function productImageUpload($request){
        $productImage = $request->file('product_image');
        $fileType = $productImage->getClientOriginalExtension();
        $imageName = $request->product_name.'.'.$fileType;
        $directory = 'product-images/';
        $imgUrl = $directory.$imageName;
        Image::make($productImage)->resize(300,400)->save($imgUrl);
        return $imgUrl;
    }
    protected function saveProductBasicInfo($request, $imgUrl){
        $product = new Product();
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->product_name = $request->product_name;
        $product->product_price = $request->product_price;
        $product->product_quantity = $request->product_quantity;
        $product->short_description = $request->short_description;
        $product->long_description = $request->long_description;
        $product->product_image = $imgUrl;
        $product->publication_status = $request->publication_status;
        $product->save();
    }
    public function saveProduct(Request $request){
        $this->productInfoValidate($request);
        $imgUrl = $this->productImageUpload($request);
        $this->saveProductBasicInfo($request, $imgUrl);

        return redirect('/product/add')->with('message', 'Product Info Save Successfully.');
    }
    public function manageProduct(){
        $products = DB::table('products')
                            ->join('categories', 'products.category_id', '=', 'categories.id')
                            ->join('brands', 'products.brand_id', '=', 'brands.id')
                            ->select('products.*', 'categories.category_name', 'brands.brand_name')
                            ->get();
        /*return $products;*/

        return view('admin.product.manage-product', ['products'=>$products]);
    }
    public function editProduct($id){
        $product = Product::find($id);
        $categories = Category::where('publication_status',1)->get();
        $brands = Brand::where('publication_status',1)->get();

        return view('admin.product.edit-product', [
            'product'=>$product,
            'categories' => $categories,
            'brands' => $brands
        ]);
    }
    public function productBasicInfoUpdate($product, $request, $imgUrl=null){
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->product_name = $request->product_name;
        $product->product_price = $request->product_price;
        $product->product_quantity = $request->product_quantity;
        $product->short_description = $request->short_description;
        $product->long_description = $request->long_description;
        if ($imgUrl){
            $product->product_image = $imgUrl;
        }
        $product->publication_status = $request->publication_status;
        $product->save();
    }
    public function updateProduct(Request $request){
        $productImage = $request->file('product_image');
        $product = Product::find($request->product_id);

        if ($productImage){
            unlink($product->product_image);
            $imgUrl = $this->productImageUpload($request);
            $imgUrl = $this->productBasicInfoUpdate($product, $request, $imgUrl);
        }else{
            $imgUrl = $this->productBasicInfoUpdate($product, $request);
        }
        return redirect('/product/manage')->with('message', 'Product Info Update Successfully.');
    }

}
