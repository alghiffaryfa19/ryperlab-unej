<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\SubEvent;
use Storage;

class SubEventController extends Controller
{
    public function index($id)
    {
        $event = Event::find($id);
        if(request()->ajax())
        {
            return datatables()->of(SubEvent::where('event_id',$event->id))
            ->editColumn('edit', function ($data) use ($event) {
                $mystring = '<a href="'.route("subevent.edit", [$event->id,$data->id]).'" class="bg-indigo-500 text-white p-2 rounded mr-2 font-bold">Edit</a><a href="'.route("hapus.subevent", [$event->id,$data->id]).'" onclick="return confirm(`Apakah anda ingin menghapus ?`)" class="bg-red-500 text-white p-2 rounded mr-2 font-bold">Hapus</a>';
                return $mystring;
            })
            ->rawColumns(['edit'])
            ->make(true);
        }
        return view('admin.subevent.index', compact('event'));
    }

    public function store(Request $request, $id)
    {
        $this->validate($request, [
            'nama_sub_event' => 'required',
        ]);

        $event = Event::find($id);
        $event->sub_event()->create([
            'nama_sub_event' => $request->nama_sub_event,
        ]);

        return redirect()->route('subevent', $id);
    }

    public function edit($id,$subevent)
    {
        $subevent = SubEvent::with('event:id,nama_event')->find($subevent);
        return view('admin.subevent.edit', compact('subevent'));        
    }

    public function update(Request $request, $id,$subevent)
    {
        $this->validate($request, [
            'nama_sub_event' => 'required',
        ]);
        $subevent = SubEvent::find($subevent);
        $subevent->update([
            'nama_sub_event' => $request->nama_sub_event,
        ]);

        return redirect()->route('subevent', $id);
      }
 
    public function destroy($id,$subevent)
    {
        $subevent = SubEvent::find($subevent);
        if (!$subevent) {
            return redirect()->back();
        }
       
        $subevent->delete();
        return redirect()->route('subevent', $id);
    }
}
