<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Facades\Datatables;
use App\Http\Requests\StoreMemberRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Http\Requests\UpdateMemberRequest;

use Illuminate\Http\Request;
use Illuminate\Support\HtmlString;

class MembersController extends Controller
{
   
    public function index(Request $request, Builder $htmlBuilder)
    {
        if ($request->ajax()) {
            $members = Role::where('name', 'member')->first()->users;
            return Datatables::of($members)

                ->addColumn('name', function ($member) {
                    return view('datatable._adminMemberName', [
                        'url' => route('members.show', $member->id),
                        'name' => $member->name
                    ]);
                })

                ->addColumn('action', function ($member) {
                    return view('datatable._action', [
                        'model' => $member,
                        'form_url' => route('members.destroy', $member->id),
                        'edit_url' => route('members.edit', $member->id),
                        'confirm_message' => 'Yakin mau menghapus ' . $member->name . '?'
                    ]);
                })->make(true);
        }
        $html = $htmlBuilder
            ->addColumn(['data' => 'name', 'name' => 'name', 'title' => 'Nama'])
            ->addColumn(['data' => 'email', 'name' => 'email', 'title' => 'Email'])
            ->addColumn(['data' => 'action', 'name' => 'action', 'title' => '', 'orderable' => false, 'searchable' => false]);

        return view('members.index', compact('html'));
    }

    public function create()
    {
        return view('members.create');
    }

    public function store(StoreMemberRequest $request)
    {
        $password = Str::random(6);
        $data = $request->all();
        $data['password'] = bcrypt($password);
        // bypass verifikasi
        $data['is_verified'] = 1;
        $member = User::create($data);
        // set role
        $memberRole = Role::where('name', 'member')->first();
        $member->addRole($memberRole);
        // kirim email
        Mail::send('auth.emails.invite', compact('member', 'password'), function ($m) use ($member) {
            $m->to($member->email, $member->name)->subject('Anda telah didaftarkan di Larapus!');
        });
        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Berhasil menyimpan member dengan email " .
                "<strong>" . $data['email'] . "</strong>" .
                " dan password <strong>" . $password . "</strong>."
        ]);
        return redirect()->route('members.index');
    }

    public function show(string $id)
    {
        $member = User::find($id);
        return view('members.show', compact('member'));
    }

    public function edit(string $id)
    {
        $member = User::find($id);
        return view('members.edit')->with(compact('member'));
    }

    public function update(UpdateMemberRequest $request, $id)
    {
        $member = User::find($id);
        $member->update($request->only('name', 'email'));
        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Berhasil menyimpan $member->name"
        ]);
        return redirect()->route('members.index');
    }

    public function destroy(string $id)
    {
        $member = User::find($id);

        if ($member->hasRole('member')) {
            $member->delete();
            Session::flash("flash_notification", [
                "level" => "success",
                "message" => "Member berhasil dihapus"
            ]);
        }
        return redirect()->route('members.index');
    }
}
