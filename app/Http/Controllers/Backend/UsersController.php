<?php
namespace blogCms\Http\Controllers\Backend;

use Illuminate\Http\Request;

use blogCms\Http\Requests;

use blogCms\User;

class UsersController extends Controller
{
    protected $user;

    function __construct(User $user) 
    {
        $this->user = $user;

        parent::__construct();
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {        
        $users = $this->user->paginate(10);

        return view('backend.users.index', compact('users'));        
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $user) 
    {
        return view('backend.users.form', compact('user'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\User\StoreUserRequest $request) 
    {
        $this->user->create($request->only('name', 'email', 'password'));

        return redirect()->route('backend.users.index')->withStatus('User has been created');
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) 
    {
        $user = $this->user->findOrFail($id);

        return view('backend.users.form', compact('user'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\User\UpdateUserRequest $request, $id) 
    {
        $user = $this->user->findOrFail($id)->fill($request->only('name', 'email', 'password'))->save();

        return redirect()->route('backend.users.edit', $id)-> withStatus('User has been updated');
    }

    public function confirm(Requests\User\DeleteUserRequest $request, $id)
    {
        $user = $this->user->findOrFail($id);

        return view('backend.users.confirm', compact('user'));
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Requests\User\DeleteUserRequest $request, $id) 
    {       
        $this->user->findOrFail($id)->delete();

        return redirect()->route('backend.users.index')->withStatus('User has been deleted');
        
    }
}
