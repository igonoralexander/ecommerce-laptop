<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ManageAdmin extends Component
{
    use WithPagination;

    public $first_name, $last_name, $email, $password, $role, $user_id;
    public $action = 'index'; // Default action is 'index'
    public $title, $breadcrumbs = [];


    protected $rules = [
        'first_name' => 'required|string',
        'last_name' => 'required|string',
        'email' => 'required|string|email|unique:users,email',
        'password' => 'required|string|min:8|',

    ];

    public function resetForm()
    {
        $this->user_id = null;
        $this->first_name = '';
        $this->last_name = '';
        $this->email = '';
        $this->password = '';
    }


    public function index()
    {
        $this->action = 'index';
    }

    public function mount()
    {
        $this->setPageData('Manage Adminstrators', [
            ['url' => null, 'label' => 'Adminstrators'],
        ]);
    }

    public function setPageData($title, $breadcrumbs)
    {
        $this->title = $title;
        $this->breadcrumbs = $breadcrumbs;
    }

    public function create()
    {
        $this->resetForm();
        $this->setPageData('Add New Admin', [
            ['url' => route('admin.manage-admin'), 'label' => 'All Administrator'],
            ['url' => null, 'label' => 'Add New Admin'],
        ]);
        $this->action = 'create';
    }

    public function save()
    {
        $this->validate();

        User::create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role' => 'admin'
        ]);

        session()->flash('message', 'Administrator created successfully.');
        $this->action = 'index';
    }

    public function update()
    {
        $this->validate([
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'email' => 'required|string|email|unique:users,email,' . $this->user_id,
       ]);

        $user = User::find($this->user_id);
        $user->update([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
        ]);

        session()->flash('message', 'Administra updated successfully.');
        $this->action = 'index';
        // return redirect()->route('admin.users.index');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->user_id = $user->id;
        $this->first_name = $user->first_name;
        $this->last_name = $user->last_name;
        $this->email = $user->email;

        $this->setPageData('Edit User', [
            ['url' => route('admin.manage-admin'), 'label' => 'Users'],
            ['url' => null, 'label' => 'Edit User'],
        ]);

        $this->action = 'edit';
    }

    public function view($id)
    {
        $user = User::findOrFail($id);
        $this->user_id = $user->id;
        $this->first_name = $user->first_name;
        $this->last_name = $user->last_name;
        $this->email = $user->email;
        $this->action = 'view';
    }


    public function delete($id)
    {
        User::findOrFail($id)->delete();
        session()->flash('message', 'Administrator deleted successfully.');
    }

    
    public function render()
    {
        return view('livewire.admin.manage-admin', [
            'users' => User::where('role', 'admin')->paginate(10),
        ]);
    }
}