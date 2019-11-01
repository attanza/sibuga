<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContact;
use App\Http\Requests\UpdateContact;
use App\Traits\DbTrait;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    use DbTrait;

    protected $searchable = ['company_id', 'name', 'phone', 'email'];

    public function index()
    {
        return view('contact.index');
    }

    public function list(Request $request)
    {
        return $this->getPaginated($request, 'Contact', $this->searchable);
    }

    public function create()
    {
        return view('contact.create')->with(['fields' => $this->getFields()]);
    }

    public function store(StoreContact $request)
    {
        $data = $this->dbStore($request, 'Contact');
        if ($request->ajax()) {
            return $data;
        }
        return redirect()->route('contacts.index');
    }

    public function show($id)
    {
        $data = $this->dbGetById($id, 'Contact');
        return view('contact.show')->with([
            'data' => $data,
            'fields' => $this->getFields()
        ]);
    }

    public function update(UpdateContact $request, $id)
    {
        $data = $this->dbUpdate($request, $id, 'Contact');
        if ($request->ajax()) {
            return $data;
        }
        return redirect()->route('contacts.index');
    }

    public function destroy($id)
    {
        $this->dbDelete($id, 'Contact');
        return ['message' => 'Contact deleted'];
    }

    protected function getFields()
    {
        $companies = $this->getComboData('Company', [], 'combo_all', 'name');
        $genders = [
            ['id' => 'Male', 'name' => 'Male'],
            ['id' => 'Female', 'name' => 'Female'],
        ];
        return [
            ['key' => 'company_id', 'caption' => 'Company', 'htmlElement' => 'select', 'selectValue' => $companies],
            ['key' => 'name', 'caption' => 'Name', 'htmlElement' => 'text', 'type' => 'text'],
            ['key' => 'phone', 'caption' => 'Phone', 'htmlElement' => 'text', 'type' => 'text'],
            ['key' => 'email', 'caption' => 'Email', 'htmlElement' => 'text', 'type' => 'text'],
            ['key' => 'gender', 'caption' => 'Gender', 'htmlElement' => 'select', 'selectValue' => $genders],
            ['key' => 'description', 'caption' => 'Description', 'htmlElement' => 'textarea'],
        ];
    }
}
