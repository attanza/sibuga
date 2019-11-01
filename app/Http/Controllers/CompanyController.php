<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompany;
use App\Http\Requests\UpdateCompany;
use App\Traits\DbTrait;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    use DbTrait;

    protected $searchable = ['name', 'email', 'phone'];

    public function index()
    {
        return view('company.index');
    }

    public function list(Request $request)
    {
        return $this->getPaginated($request, 'Company', $this->searchable);
    }

    public function create()
    {
        return view('company.create')->with(['fields' => $this->getFields()]);
    }

    public function store(StoreCompany $request)
    {
        $this->dbStore($request, 'Company');
        return redirect()->route('companies.index');
    }

    public function show($id)
    {
        $data = $this->dbGetById($id, 'Company');
        return view('company.show')->with([
            'data' => $data,
            'fields' => $this->getFields()
        ]);
    }

    public function update(UpdateCompany $request, $id)
    {
        $this->dbUpdate($request, $id, 'Company');
        return redirect()->route('companies.index');
    }

    public function destroy($id)
    {
        $this->dbDelete($id, 'Company');
        return ['message' => 'Data deleted'];
    }

    protected function getFields()
    {
        $selectValue = collect([
            ['id' => 'Vendor', 'name' => 'Vendor'],
            ['id' => 'Customer', 'name' => 'Customer'],
        ]);
        return [
            [
                'key' => 'name',
                'caption' => 'Name',
                'htmlElement' => 'text',
                'type' => 'text',
            ],
            [
                'key' => 'phone',
                'caption' => 'Phone',
                'htmlElement' => 'text',
                'type' => 'text'

            ],
            [
                'key' => 'email',
                'caption' => 'Email',
                'htmlElement' => 'text',
                'type' => 'email'
            ],
            [
                'key' => 'category',
                'caption' => 'Category',
                'htmlElement' => 'select',
                'selectValue' => $selectValue
            ],
            [
                'key' => 'npwp',
                'caption' => 'NPWP',
                'htmlElement' => 'text',
                'type' => 'text'
            ],
            [
                'key' => 'business_type',
                'caption' => 'Business Type',
                'htmlElement' => 'text',
                'type' => 'text'
            ],
            [
                'key' => 'website',
                'caption' => 'Website',
                'htmlElement' => 'text',
                'type' => 'text'
            ],
            [
                'key' => 'address',
                'caption' => 'Address',
                'htmlElement' => 'textarea'
            ],
            [
                'key' => 'description',
                'caption' => 'Description',
                'htmlElement' => 'textarea'
            ]
        ];
    }
}
