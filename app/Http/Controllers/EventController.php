<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Storage;

class EventController extends Controller
{
    public function index()
    {
        if(request()->ajax())
        {
            return datatables()->of(Event::query())
            ->editColumn('edit', function ($data) {
                $mystring = '<a href="'.route("subevent", $data->id).'" class="bg-indigo-500 text-white p-2 rounded mr-2 font-bold">Sub Event</a><a href="'.route("event.edit", $data->id).'" class="bg-indigo-500 text-white p-2 rounded mr-2 font-bold">Edit</a><a href="'.route("hapus.event", $data->id).'" onclick="return confirm(`Apakah anda ingin menghapus ?`)" class="bg-red-500 text-white p-2 rounded mr-2 font-bold">Hapus</a>';
                return $mystring;
            })
            ->rawColumns(['edit'])
            ->make(true);
        }
        return view('admin.event.index');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_event' => 'required',
            'nomor_surat' => 'required',
            'template' => 'required',
        ]);

        Event::create([
            'nama_event' => $request->nama_event,
            'nomor_surat' => $request->nomor_surat,
            'template' => $request->file('template')->store('template'),
        ]);

        return redirect()->route('event.index');
    }

    public function edit($id)
    {
        $event = Event::find($id);
        return view('admin.event.edit', compact('event'));        
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama_event' => 'required',
            'nomor_surat' => 'required',
            'template' => 'required',
        ]);
        $event = Event::find($id);
        if (empty($request->file('template'))) {
            $event->update([
                'nama_event' => $request->nama_event,
                'nomor_surat' => $request->nomor_surat,
            ]);
        } else {
            Storage::delete($event->template);
            $event->update([
                'nama_event' => $request->nama_event,
                'nomor_surat' => $request->nomor_surat,
                'template' => $request->file('template')->store('template'), 
            ]);
        }

        return redirect()->route('event.index');
      }
 
    public function destroy($id)
    {
        $event = Event::find($id);
        if (!$event) {
            return redirect()->back();
        }
        Storage::delete($event->template);
        $event->delete();
        return redirect()->route('event.index');
    }
}
