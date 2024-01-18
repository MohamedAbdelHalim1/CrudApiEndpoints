<?php

namespace Tests\Unit;
use Tests\TestCase;
use Illuminate\Foundation\Testing\Concerns\InteractsWithExceptionHandling;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Category;
use App\Models\Product;

class ProductTest extends TestCase
{
    public $product;
    use RefreshDatabase;
    //use InteractsWithExceptionHandling;
    // protected $productController;
    // protected $product;
    // public function setUp():void{
    //     parent::setUP();
    //     $this->productController = $this->app->make('App\Http\Controllers\ProductController');
    //     $this->product=[
    //         'name'=>'product1',
    //         'description'=>'desc1',
    //         'price'=>500,
    //         'stock'=>5,
    //         'category'=>1
    //     ];
    // }




    public function test_product_creation_in_database()
    {
        $category = Category::factory()->make();
        $category->save();
        $formData = [
            'name' => 'Product1',
            'description' => 'desc1',
            'price' => 500,
            'stock' => 4,
            'category_id' => $category->id,
        ];
        //$this->withoutExceptionHandling();
        $this->json('POST',route('products.store'),$formData)
        ->assertStatus(201)
        ->assertJson([
            'success'=>true,
            'message'=>'Product added successfully',
            'data'=>$formData]);
    }

    public function test_product_updating_in_database()
    {
        $product = Product::factory()->make();
        $product->save();
        
        $formData = [
            'id'=>$product->id,
            'category_id' => $product->category_id,
            'name' => $product->name,
            'description' => $product->description,
            'price' => $product->price,
            'stock' => 4,
            'created_at' => $product->created_at->toDateTimeString(),
            'updated_at' => $product->updated_at->toDateTimeString(),
        ];
        //$this->withoutExceptionHandling();
        $this->json('PUT',route('products.update',$product->id),$formData)
        ->assertStatus(200)
        ->assertJson([
            "success"=>true,
            "message"=> "Product Updated successfully",
            "data"=>$formData]);
    }

    public function test_product_updating_validation_error_in_database()
    {
        $product = Product::factory()->make();
        $product->save();
        
        $formData = [
            'id'=>$product->id,
            'category_id' => $product->category_id,
            'description' => $product->description,
            'price' => $product->price,
            'stock' => 4,
            'created_at' => $product->created_at->toDateTimeString(),
            'updated_at' => $product->updated_at->toDateTimeString(),
        ];
        //$this->withoutExceptionHandling();
        $this->json('PUT',route('products.update',$product->id),$formData)
        ->assertStatus(400)
        ->assertJson([
            'success'=>false,
            'message'=>"There exist one or more errors",
            'data'=>["name"=>["The name field is required."]],
        ]);
    }

    public function test_products_index_not_found_in_database()
    {
        $this->json('GET',route('products.index'))
        ->assertStatus(404);
    }

    public function test_products_store_validation_error_in_database()
    {
        $category = Category::factory()->make();

        $formData = [
            'description' => 'desc1',
            'price' => 500,
            'stock' => 4,
            'category' => $category->id,
        ];
        //$this->withoutExceptionHandling();
        $this->json('POST',route('products.store',$formData))
        ->assertStatus(400)
        ->assertJson([
            'success'=>false,
            'message'=>"There exist one or more errors",
            'data'=>["name"=>["The name field is required."]],
        ]);
    }
    public function test_product_read_in_database()
    {
        
        $product = Product::factory()->make();
        $product->save();

        $formData = [
            'product' => [
            'id'=>$product->id,
            'category_id' => $product->category_id,
            'name' => $product->name,
            'description' => $product->description,
            'price' => $product->price,
            'stock' => $product->stock,
            'created_at' => $product->created_at->toDateTimeString(),
            'updated_at' => $product->updated_at->toDateTimeString(),
            ], 
            'category' => $product->category->name
        ];
        
        //$this->withoutExceptionHandling();
        $this->json('GET',route('products.show',$product->id))
        ->assertStatus(200)
        ->assertJson([
            "success"=>true,
            "message"=> "",
            "data"=>$formData]);
    }

    public function test_product_delete_in_database()
    {
        
        $product = Product::factory()->make();
        $product->save();

        
        //$this->withoutExceptionHandling();
        $this->json('DELETE',route('products.destroy',$product->id))
        ->assertStatus(200)
        ->assertJson([
            'success'=>true,
            'message'=>"Product Deleted successfully",
            'data'=>null]);
    }

}
