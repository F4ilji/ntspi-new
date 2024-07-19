<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClientEventFullResource;
use App\Http\Resources\ClientEventResource;
use App\Http\Resources\ClientNavigationResource;
use App\Models\Event;
use App\Models\MainSection;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ClientEventController extends Controller
{
    public function index(Request $request)
    {
        if ($request->input('date') === null) {
            $nearestEvent = Event::whereDate('event_date_start', '>=', now())
                ->orderBy('event_date_start', 'asc')
                ->first();

            $date = new Carbon($nearestEvent->event_date_start);
            $currentDate = [
                'fullDate' => $date->format('Y-m-j'),
                'day' => $date->format('j'),
                'month' => $date->getTranslatedMonthName('Do MMMM'),
            ];
        } else {
            $date = new Carbon($request->input('date'));
            $currentDate = [
                'fullDate' => $date->format('Y-m-j'),
                'day' => $date->format('j'),
                'month' => $date->getTranslatedMonthName('Do MMMM'),
            ];
        }
        $navigation = ClientNavigationResource::collection(MainSection::with('subSections.pages')->orderBy('sort', 'asc')->get());
        $eventDates = Event::select('event_date_start')
            ->distinct()
            ->where('event_date_start', '>=', date('Y-m-d'))
            ->orderBy('event_date_start')
            ->get()
            ->map(function ($event) {
                $date = new DateTime($event->event_date_start);
                $dayOfWeek = $this->getDayOfWeekRussian($date->format('l'));
                $formattedDate = $date->format('Y-m-j');
                return [
                    'day' => $date->format('j'),
                    'dayOfWeek' => $dayOfWeek,
                    'date' => $formattedDate
                ];
            })
            ->groupBy(function ($item) {
                $date = new DateTime($item['date']);
                return $date->format('m');
            })
            ->map(function ($group, $month) {
                $monthName = $this->getMonthNameRussian((int)$month);
                return [
                    'month' => $monthName,
                    'events' => $group->toArray()
                ];
            });

        $events = ClientEventResource::collection(Event::select('title', 'slug', 'event_date_start', 'address', 'is_online', 'category_id')->whereDate('event_date_start', '=', $currentDate)
            ->with('category')
            ->orderBy('event_time_start', 'asc')
            ->get());

        return Inertia::render('Client/Events/Index', compact('navigation', 'eventDates', 'events', 'currentDate'));
    }

    public function show(string $slug)
    {
        $navigation = ClientNavigationResource::collection(MainSection::with('subSections.pages')->orderBy('sort', 'asc')->get());
        $event = new ClientEventFullResource(Event::where('slug', '=', $slug)
            ->with('category')
            ->first());
        return Inertia::render('Client/Events/Show', compact('navigation', 'event'));
    }

    private function getDayOfWeekRussian(string $dayOfWeek): string
    {
        $russianDays = [
            'Monday' => 'пн',
            'Tuesday' => 'вт',
            'Wednesday' => 'ср',
            'Thursday' => 'чт',
            'Friday' => 'пт',
            'Saturday' => 'сб',
            'Sunday' => 'вс'
        ];

        return $russianDays[$dayOfWeek] ?? '';
    }

    private function getMonthNameRussian(int $month): string
    {
        $russianMonths = [
            1 => 'Январь',
            2 => 'Февраль',
            3 => 'Март',
            4 => 'Апрель',
            5 => 'Май',
            6 => 'Июнь',
            7 => 'Июль',
            8 => 'Август',
            9 => 'Сентябрь',
            10 => 'Октябрь',
            11 => 'Ноябрь',
            12 => 'Декабрь'
        ];

        return $russianMonths[$month] ?? '';
    }

}
