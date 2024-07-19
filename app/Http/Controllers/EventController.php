<?php

namespace App\Http\Controllers;

use App\Http\Requests\Event\StoreRequest;
use App\Http\Requests\Event\UpdateRequest;
use App\Http\Resources\EventResource;
use App\Models\Event;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EventController extends Controller
{
    public function index()
    {
        $events = EventResource::collection(Event::query()
            ->when(request()->input('search'), function ($query, $search) {
                $query->where('title', 'like', "%{$search}%");
            })
            ->orderBy('id', 'desc')
            ->paginate(request()->input('perPage', 9))
            ->withQueryString());
        $filters = [
            'search' => request()->input('search'),
        ];
        return Inertia::render('AdminPanel/Events/Index', compact('events', 'filters'));
    }

    public function create()
    {
        return Inertia::render('AdminPanel/Events/Create');
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $data['content'] = json_encode($data['content']);
        Event::create($data);
        return redirect()->route('admin.event.index');
    }

    public function edit(Event $event)
    {
        $event = new EventResource($event);
        return Inertia::render('AdminPanel/Events/Edit', compact('event'));
    }

    public function update(Event $event, UpdateRequest $request)
    {
        $data = $request->validated();
        $data['content'] = json_encode($data['content']);
        $event->update($data);
        return redirect()->route('admin.event.index');
    }


    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('admin.event.index');
    }
}
