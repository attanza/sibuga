<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProduct;
use App\Http\Requests\UpdateProduct;
use App\Traits\DbTrait;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use DbTrait;

    protected $searchable = ['name', 'stock', 'company_id'];

    public function index()
    {
        return view('product.index');
    }

    public function list(Request $request)
    {
        return $this->getPaginated($request, 'Product', $this->searchable);
    }

    public function create()
    {
        return view('product.create')->with(['fields' => $this->getFields()]);
    }

    public function store(StoreProduct $request)
    {
        $this->dbStore($request, 'Product');
        return redirect()->route('products.index');
    }

    public function show($id)
    {
        $data = $this->dbGetById($id, 'Product');
        return view('product.show')->with([
            'data' => $data,
            'fields' => $this->getFields()
        ]);
    }

    public function update(UpdateProduct $request, $id)
    {
        $this->dbUpdate($request, $id, 'Product');
        return redirect()->route('products.index');
    }

    public function destroy($id)
    {
        $this->dbDelete($id, 'Product');
        return ['message' => 'Product deleted'];
    }

    protected function getFields()
    {
        $companies = $this->getComboData('Company', ['category' => 'Vendor'], 'combo_vendor', 'name');

        return [
            ['key' => 'code', 'caption' => 'Code', 'htmlElement' => 'text', 'type' => 'text'],
            ['key' => 'name', 'caption' => 'Name', 'htmlElement' => 'text', 'type' => 'text'],
            ['key' => 'stock', 'caption' => 'Stock', 'htmlElement' => 'text', 'type' => 'text'],
            ['key' => 'company_id', 'caption' => 'Vendor', 'htmlElement' => 'select', 'selectValue' => $companies],
            ['key' => 'description', 'caption' => 'Description', 'htmlElement' => 'text', 'type' => 'text'],
        ];
    }
}
