<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
        // 🧠 Método para listar todos los productos
    public function index()
    {
        $products = Product::all();
        return response()->json($products);
    }

    public function store(Request $request)
    {
        // 1️⃣ Validar los datos que llegan del cliente (Postman)
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        // 2️⃣ Crear el producto con los datos validados
        $product = Product::create($validated);

        // 3️⃣ Responder con un mensaje y los datos del nuevo producto
        return response()->json([
            'message' => 'Producto creado correctamente.',
            'product' => $product
        ], 201);
    }

    public function update(Request $request, $id)
    {
        // 1️⃣ Buscar el producto por su ID
        $product = Product::find($id);

        // 2️⃣ Si no existe, devolver error
        if (!$product) {
            return response()->json(['message' => 'Producto no encontrado.'], 404);
        }

        // 3️⃣ Validar los datos recibidos
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        // 4️⃣ Actualizar los campos
        $product->update($validated);

        // 5️⃣ Devolver respuesta JSON
        return response()->json([
            'message' => 'Producto actualizado correctamente.',
            'product' => $product
        ]);
    }
    public function destroy($id)
    {
        // 1️⃣ Buscar el producto por su ID
        $product = Product::find($id);

        // 2️⃣ Si no existe, devolver error
        if (!$product) {
            return response()->json(['message' => 'Producto no encontrado.'], 404);
        }

        // 3️⃣ Eliminar el producto
        $product->delete();

        // 4️⃣ Devolver confirmación
        return response()->json(['message' => 'Producto eliminado correctamente.']);
    }

}



