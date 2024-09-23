<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\ProductCreateRequest;

class ProductController extends Controller
{
    public function store(ProductCreateRequest $request)
    {
        $data = $request->all();

        $product = Product::create([
            'nome' => $data['nome'],
            'preco' => $data['preco'],
            'quantidade' => $data['quantidade'],
        ]);

        return [
            'status' => 200,
            'menssagem' => 'Produto cadastrado com sucesso!!',
            'product' => $product
        ];
    }

    public function index()
    {
        $product = Product::select('id', 'nome', 'preco', 'quantidade')->paginate('2');

        return [
            'status' => 200,
            'menssagem' => 'Produtos encontrados!!',
            'product' => $product
        ];
    }

    public function show(string $id)
    {
        $product = Product::find($id);

        if(!$product){
            return [
                'status' => 404,
                'message' => 'Produto não encontrado!',
                'product' => $product
            ];
        }

        return [
            'status' => 200,
            'message' => 'Produto encontrado!!',
            'product' => $product
        ];
    }

    public function update(string $id)
    {
        $data = $request->all();

        $product = Product::find($id);

        if(!$product){
            return [
                'status' => 404,
                'message' => 'Produto não encontrado!',
                'product' => $product
            ];
        }
        $product->update($data);

        return [
            'status' => 200,
            'message' => 'Produto atualizado!!',
            'product' => $product
        ];
    }

    public function destroy(string $id)
    {
        $product = Product::find($id);

        if(!$product){
            return [
                'status' => 404,
                'message' => 'Produto não encontrado!',
                'product' => $product
            ];
        }

        $product->delete($id);

        return [
            'status' => 200,
            'message' => 'Produto deletado!!'
        ];

    }
}
