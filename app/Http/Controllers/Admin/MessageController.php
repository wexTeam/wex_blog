<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Message;
use App\Notifications\NewMessage;
use App\User;
use Auth;
use Datatables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Mail;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function __construct()
    {
        $this->middleware('auth:admin');

    }

    public function index()
    {

        return view('admin.messages.index', ['title' => 'Messages']);
    }

    public function getMessages(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'subject',
            4 => 'created_at',
            5 => 'action'
        );

        $totalData = Message::count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $messages = Message::offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = Message::count();
        } else {
            $search = $request->input('search.value');
            $messages = Message::where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('created_at', 'like', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = Message::where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->count();
        }


        $data = array();

        if ($messages) {
            foreach ($messages as $r) {
                $edit_url = route('messages.edit', $r->id);
                $nestedData['id'] = '
                                <td>
                                <div class="checkbox checkbox-success m-0">
                                        <input id="checkbox3" type="checkbox" name="messages[]" value="' . $r->id . '">
                                        <label for="checkbox3"></label>
                                    </div>
                                </td>
                            ';
                $nestedData['subject'] = $r->subject;
                $nestedData['created_at'] = date('d-m-Y', strtotime($r->created_at));
                $nestedData['action'] = '
                                <div>
                                <td>
                                    <a class="btn btn-info btn-circle" onclick="event.preventDefault();
                                    viewInfo(' . $r->id . ');" title="View Message" href="javascript:void(0)">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a title="Edit Message" class="btn btn-primary btn-circle"
                                       href="' . $edit_url . '">
                                       <i class="fa fa-edit"></i>
                                    </a>
                                    <a class="btn btn-danger btn-circle" onclick="event.preventDefault();del(' . $r->id . ');" title="Delete Message" href="javascript:void(0)">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                                </div> 
                            ';
                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        );

        echo json_encode($json_data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $users = User::pluck('name', 'id')->toArray();
        return view('admin.messages.create', ['users' => $users, 'title' => 'Add Message']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'subject' => 'required|max:255',
            'description' => 'required',

        ]);
        $input = $request->all();
        $message = new Message();
        $message->subject = $input['subject'];
        $message->description = $input['description'];
        $message->save();

        if (isset($request->users)) {
            $message->users()->sync($request->users);
        } else {
            $message->users()->sync(array());
        }

        foreach ($message->users as $user) {
            $user->notify(new NewMessage($user, $message));
        }
        Session::flash('success_message', 'Great! Message saved & sent successfully!');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $message = Message::findOrFail($id);
        return view('admin.messages.edit', ['title' => 'Update message detail', 'message' => $message]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $message = Message::findOrFail($id);
        $this->validate($request, [
            'subject' => 'required|max:255',
            'description' => 'required',

        ]);
        $input = $request->all();

        $message->subject = $input['subject'];
        $message->description = $input['description'];
        $message->save();

        Session::flash('success_message', 'Great! Message saved & sent successfully!');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $message = Message::findOrFail($id);
        $message->delete();
        Session::flash('success_message', 'Message successfully deleted!');
        return redirect()->route('messages.index');
    }

    public function deleteSelectedMessages(Request $request)
    {
        $input = $request->all();
        $this->validate($request, [
            'messages' => 'required',

        ]);
        foreach ($input['messages'] as $index => $id) {
            $message = Message::findOrFail($id);
            $message->delete();

        }
        Session::flash('success_message', 'Message successfully deleted!');
        return redirect()->back();

    }

    public function messageDetail(Request $request)
    {

        $message = Message::findOrFail($request->input('id'));


        return view('admin.messages.single', ['title' => 'Message Detail', 'message' => $message]);
    }


}
