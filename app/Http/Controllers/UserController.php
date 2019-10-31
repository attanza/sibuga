<?php
namespace App\Http\Controllers;

use App\Http\Requests\StoreUser;
use App\Http\Requests\UpdateUser;
use App\Traits\DbTrait;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use DbTrait;

    protected $searchable = ['name','email'];

    public function index()
    {
        return view('user.index');
    }

    public function list(Request $request)
    {
        return $this->getPaginated($request, 'User', $this->searchable);
    }

    public function create()
    {
        return view('user.create')->with(['fields' => $this->getFields()]);
    }

    public function store(StoreUser $request)
    {
        $this->dbStore($request, 'User');
        return redirect()->route('users.index');
    }

    public function show($id)
    {
        $data = $this->dbGetById($id, 'User');
        return view('user.show')->with([
            'data' => $data,
            'fields' => $this->getFields()
        ]);
    }

    public function update(UpdateUser $request, $id)
    {
        $this->dbUpdate($request, $id, 'User');
        return redirect()->route('users.index');
    }

    public function destroy($id)
    {
        $this->dbDelete($id, 'User');
        return ['message' => 'User deleted'];
    }

    protected function getFields()
    {
        return [
            [ 'key' => 'name', 'caption' => 'Name', 'htmlElement' => 'text', 'type' => 'text' ],
[ 'key' => 'email', 'caption' => 'Email', 'htmlElement' => 'text', 'type' => 'text' ],
[ 'key' => 'password', 'caption' => 'Password', 'htmlElement' => 'text', 'type' => 'text' ],

        ];
    }
}
