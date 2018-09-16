<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\RoleRequest;
use App\Models\Role;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{

    public function index()
    {
        $roles = Role::orderByDesc('weight')->get();
        return view('backend.role.index', compact('roles'));
    }

    public function create()
    {
        return view('backend.role.create');
    }

    public function store(RoleRequest $request)
    {
        Role::create($request->filldata());
        flash('添加成功', 'success');
        return back();
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        return view('backend.role.edit', compact('role'));
    }

    public function update(RoleRequest $request, $id)
    {
        $role = Role::findOrFail($id);
        $role->fill($request->filldata())->save();
        flash('编辑成功', 'success');
        return back();
    }

    public function destroy($id)
    {
        flash('角色无删除成功，如果真的需要删除请直接从数据库删除，但是请确保数据完整性！');
        return back();
    }

}
