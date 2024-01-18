<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\Concerns\InteractsWithExceptionHandling;
use App\Models\Category;
class ProductTest extends TestCase
{
    use RefreshDatabase;
    // //use InteractsWithExceptionHandling;
    // /**
    //  * A basic feature test example.
    //  */
    // public function test_product_creation_in_database()
    // {
    //     $category = Category::factory()->make();
    //     //dd($category);
    //     $formData = [
    //         'name' => 'Product1',
    //         'description' => 'desc1',
    //         'price' => 500,
    //         'stock' => 4,
    //         'category' => $category->id+1,
    //     ];
    //     //$this->withoutExceptionHandling();
    //     $this->json('POST',route('products.store'),$formData)
    //     ->assertStatus(201)
    //     ->assertJson(['data'=>$formData]);
    // }

    // public function test_products_index_not_found_in_database()
    // {
    //     // $category = Category::factory()->make();

    //     // $formData = [
    //     //     'name' => 'Product1',
    //     //     'description' => 'desc1',
    //     //     'price' => 500,
    //     //     'stock' => 4,
    //     //     'category' => $category->id,
    //     // ];
    //     //$this->withoutExceptionHandling();
    //     $this->json('GET',route('products.index'))
    //     ->assertStatus(404);
    // }
    // public function test_products_store_validation_error_in_database()
    // {
    //     $category = Category::factory()->make();

    //     $formData = [
    //         'description' => 'desc1',
    //         'price' => 500,
    //         'stock' => 4,
    //         'category' => $category->id,
    //     ];
    //     //$this->withoutExceptionHandling();
    //     $this->json('POST',route('products.store',$formData))
    //     ->assertStatus(400)
    //     ->assertJson([
    //         'success'=>false,
    //         'message'=>"There exist one or more errors",
    //         'data'=>["name"=>["The name field is required."]],
    //     ]);
    // }
}
