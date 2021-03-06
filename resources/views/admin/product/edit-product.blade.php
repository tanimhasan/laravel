@extends('admin.master')

@section('body')
    <style>
        .lab label{margin-top: 5px;}
    </style>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="text-center text-success">Edit Product Form</h4>
                </div>
                <div class="panel-body">
                    <h3 class="text-center text-success">{{ Session::get('message') }}</h3>
                    <form action="{{ route('update-product') }}" method="POST" class="form-horizontal" enctype="multipart/form-data" name="editProductForm">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="control-label col-md-3">Category Name</label>
                            <div class="col-md-9">
                                <select class="form-control" name="category_id">
                                    <option>-------Category Name--------</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Brand Name</label>
                            <div class="col-md-9">
                                <select class="form-control" name="brand_id">
                                    <option>-------Brand Name--------</option>
                                    @foreach($brands as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Product Name</label>
                            <div class="col-md-9">
                                <input type="text" value="{{ $product->product_name }}" class="form-control" name="product_name">
                                <input type="hidden" value="{{ $product->id }}" class="form-control" name="product_id">
                                <span class="text-danger">{{ $errors->has('product_name') ? $errors->first('product_name') : ' ' }}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Product Price</label>
                            <div class="col-md-9">
                                <input type="number" value="{{ $product->product_price }}" class="form-control" name="product_price">
                                <span class="text-danger">{{ $errors->has('product_price') ? $errors->first('product_price') : ' ' }}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Product Quantity</label>
                            <div class="col-md-9">
                                <input type="number" value="{{ $product->product_quantity }}" class="form-control" name="product_quantity">
                                <span class="text-danger">{{ $errors->has('product_quantity') ? $errors->first('product_quantity') : ' ' }}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Short Description</label>
                            <div class="col-md-9">
                                <textarea class="form-control" name="short_description">{{ $product->short_description }}</textarea>
                                <span class="text-danger">{{ $errors->has('short_description') ? $errors->first('short_description') : ' ' }}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Long Description</label>
                            <div class="col-md-9">
                                <textarea class="form-control" name="long_description">{{ $product->long_description }}</textarea>
                                <span class="text-danger">{{ $errors->has('long_description') ? $errors->first('long_description') : ' ' }}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Product Image</label>
                            <div class="col-md-9">
                                <input type="file" value="{{ $product->product_image }}" name="product_image" accept="image/*">
                                <br>
                                <img src="{{ asset($product->product_image) }}" alt="" width="80" height="80">
                                <span class="text-danger">{{ $errors->has('product_image') ? $errors->first('product_image') : ' ' }}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4"> Publication Status</label>
                            <div class="col-md-8 lab">
                                <label><input type="radio" checked name="publication_status" {{ $product->publication_status == 1 ? 'checked' : ''}} value="1"/> Published</label>
                                <label><input type="radio" name="publication_status" {{ $product->publication_status == 0 ? 'checked' : ''}} value="0"/> Unpublished</label>
                                <span class="text-danger">{{ $errors->has('publication_status') ? $errors->first('publication_status') : ' ' }}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <input type="submit" name="btn" class="btn btn-success btn-block" value="Update Product Info">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.forms['editProductForm'].elements['category_id'].value = '{{ $product->category_id }}';
        document.forms['editProductForm'].elements['brand_id'].value = '{{ $product->brand_id }}';
    </script>
@endsection