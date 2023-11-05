<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Event;
use App\Models\EventType;
use App\Models\timeplace;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Password;
use App\Rules\EventIdCorrectValidator;
use App\Rules\FinishTimeAfterStartTimeValidator;
 

class LoginRegisterController extends Controller
{
    const DATE_FORMAT = "Y-m-d" ;
    const DISPLAY_DATE_FORMAT = "d.m.Y";
    const DATE_ZERO = '2023-10-30';
    /**
     * Instantiate a new LoginRegisterController instance.
     */
    public function __construct()
    {
      
        $this->middleware('auth')->only(['logout', 'event_get', 'event_post', 'event_delete']);
    }

    /**
     * Display a registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function register()
    {
    if(Auth::check())
        {
            return view('auth.register');
        }
        
        return redirect()->route('login')
            ->withErrors([
            'email' => 'Please login to access admin functionalities.',
        ])->onlyInput('email');

    }

    /**
     * Store a new user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:250',
            'email' => 'required|email|max:250|unique:users',
            'password' => ['required', Password::min(12)->mixedCase()->numbers()->symbols()->uncompromised()],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $credentials = $request->only('email', 'password');
        Auth::attempt($credentials);
        $request->session()->regenerate();
        return redirect()->route('timeline')
        ->withSuccess('You have successfully registered & logged in!');
    }

    /**
     * Display a login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        return view('auth.login');
    }

    /**
     * Display a login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function event_get()
    {
        $events = DB::select('select * from event_types');
 
        return view('auth.add', ['types' => $events]);
    }

    public function event_destroy($id)  
    { 
        if(Auth::check())
        {

            if(Event::find($id)->user->id == Auth::user()->id )
            {
                Event::find($id)->delete();

                return redirect()->route('timeline')->with('success', 'Resource deleted successfully');
            }
        }
        return redirect()->route('timeline')->with('error', 'Could not delete resource');
    } 

    public function event_modify($id)  
    { 
        if(Auth::check())
        {

            if(Event::find($id)->user->id == Auth::user()->id )
            {
        $eventTypes = DB::select('select * from event_types');
        $event = Event::find($id);
        return view('auth.modify', ['types' => $eventTypes, 'event' => $event]);
            }
        }
        return redirect()->route('timeline')->with('error', 'Could not modify resource');
    }

    public function event_patch($id, Request $request)  
    { 
       
        if(Auth::check())
        {
           
            if(Event::find($id)->user->id == Auth::user()->id )
            {
                
            $request->validate([
                'name' => 'required|string|max:64',
                'esd' => 'required|date',
                'type' => ['required','integer' , new EventIdCorrectValidator],
                'eed' => ['required','date','after:now', new FinishTimeAfterStartTimeValidator($request->esd)] ,
                'description' => 'required|string', 
            ]);
       
        $userId = Auth::id();
        
        $event = Event::where("id", $id)->update([
            "name" => $request->name,
            "description" => $request->description,
            "start_date" => $request->esd,
            "end_date" => $request->eed,
            "user_id" => $userId ,
            "type_id" => $request->type,
        ]);


        

        if($event)
        {
            return redirect()->route('timeline')
            ->withSuccess('Event has been modified!');
        }
        }
        }
        
        return redirect()->route('timeline')->with('error', 'Could not modify resource');
    } 


    /**
     * add a new event.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function event_post(Request $request)
    {

        if(Auth::check())
        {
            $request->validate([
                'name' => 'required|string|max:64',
                'esd' => 'required|date',
                'type' => ['required','integer' , new EventIdCorrectValidator],
                'eed' => ['required','date','after:now', new FinishTimeAfterStartTimeValidator($request->esd)] ,
                'description' => 'required|string',
            ]);
        $name = $request->name;
        $description = $request->description;
        $start_date = $request->esd;
        $end_date = $request->eed;
        $type_id = $request->type;
        $userId = Auth::id();
        $event = new Event();
        $event->name = $name;
        $event->description = $description;
        $event->start_date = $start_date;
        $event->end_date = $end_date;
        $event->user_id = $userId;

        $type = EventType::find($type_id);
        $event->type()->associate($type);
        $event->save();

        

        if($event)
        {
            return redirect()->route('timeline')
            ->withSuccess('Event has been added!');
        }
        
       
        }
        return redirect()->route('event_add')
            ->withError('Event creation failed');
    }

  

     /**
     * Display a dashboard to authenticated users.
     *
     * @return \Illuminate\Http\Response
     */
    public function timeline(Request $request)
    {   
        $day_zero = Carbon::createFromFormat(self::DATE_FORMAT, self::DATE_ZERO)->startOfDay();
        $today = Carbon::today()->startOfDay();
        $pagination_span = 7;
        $page = $request->query('page',floor(($this->diffInDays($day_zero, $today))/$pagination_span));
        if($page<0)
        {
            $page=0;
        }

        $from = $this->copyCarbon($day_zero)->addDays($page * $pagination_span)->startOfDay();
        $to = $this->copyCarbon($day_zero)->addDays((($page+1) * $pagination_span))->startOfDay();
        $events = Event::query()

            ->where('start_date', '<' ,$to )
            ->where('end_date', '>' ,$from )
            ->get();
        foreach($events as $event)
        {
            $event->start_date = Carbon::createFromFormat(self::DATE_FORMAT, $event->start_date)->startOfDay();
            $event->end_date = Carbon::createFromFormat(self::DATE_FORMAT, $event->end_date)->addDays(1)->startOfDay();
        }


    $period = CarbonPeriod::create( $from, $pagination_span);


    $dates = [];
    foreach ($period as $key => $date) {
        $dates[] = $date->format(self::DISPLAY_DATE_FORMAT);
    }

        // [
        //     [***, .. ,**]
        //     [..,****,.]
        // ] 
        
        $timeline = $this->createTimeline($events,$from, $to ); 
        return view('auth.timeline', ['days' => $dates, 'timeline'=>$timeline, 'page'=>$page]);
    } 


   

    /**
     * Authenticate the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(Auth::attempt($credentials))
        {
            $request->session()->regenerate();
            return redirect()->route('timeline')
                ->withSuccess('You have successfully logged in!');
        }

        return back()->withErrors([
            'email' => 'Your provided credentials do not match in our records.',
        ])->onlyInput('email');

    } 
    

 
    /**
     * Log out the user from application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')
            ->withSuccess('You have logged out successfully!');
    }    



    private function diffInDays( $start_date,  $end_date): int
    {
        $tempDiff = $start_date->diffInDays($end_date);
        return $start_date->diffInDays($end_date);

        
    }

    private function doEventsColide(timeplace $timeplaceExisting,Event $newEvent ): bool
    {

        if ($timeplaceExisting->getEvent() == null) 
        {
            
            return false;
        }

       

        return $timeplaceExisting->getEvent()->end_date > $newEvent->start_date;
        
    }

/**
 * Returns an array of arrays of int.
 *
 * @return array[][]
 */
    private function createTimeline($events,Carbon $start_date, Carbon $end_date): array
    {
        $maxSpan =  $this->diffInDays($start_date, $end_date);
        $eventsSorted = unserialize(serialize($events));
        foreach ( $eventsSorted as $event)
        {
            if ($event->start_date < $start_date)
            {
                $event->start_date = $start_date;
            }
            if ($event->end_date > $end_date)
            {
                $event->end_date = $end_date;
            }
            $eventSpan = $this->diffInDays($event->start_date, $event->end_date);
        }
        $eventsSorted = $eventsSorted->sortBy('start_date');
        $result = [];

        foreach($eventsSorted as $event)
        {
            $timePlaceAdded = false;
            for ($i = 0; $i < sizeof($result); $i++) 
            {
                $row = $result[$i];
                $doEventsColideInRow = false;
                foreach($row as $existingEvent)
                {
                    if($this->doEventsColide($existingEvent,$event))
                    {
                        $doEventsColideInRow = true;
                        break;
                    }  
                }
                if(!$doEventsColideInRow)
                {
                    $lp = array_pop($row);
                    $tempRow = $row;
                    
                    $startDiff =  $this->diffInDays($lp->getStartDate(), $event->start_date);
                    if($startDiff > 0)
                    {
                    $emptyTimeplaceBefore = new timeplace();
                    $emptyTimeplaceBefore->setSpan($startDiff);
                    $emptyTimeplaceBefore->setEvent(null);
                    $emptyTimeplaceBefore->setStartDate($lp->getStartDate());
                    
                    $tempRow[] = $emptyTimeplaceBefore;
                    }

                    $eventSpan =  $this->diffInDays($event->start_date, $event->end_date);
                    $eventTimeplace = new timeplace();
                    $eventTimeplace->setSpan($eventSpan);
                    $eventTimeplace->setEvent($event);
                    $eventTimeplace->setStartDate($event->start_date);
                    
                    $tempRow[] = $eventTimeplace;

                    $endDiff =  $this->diffInDays($event->end_date, $end_date);
                    if($endDiff > 0)
                    {
                    $emptyTimeplaceAfter = new timeplace();
                    $emptyTimeplaceAfter->setSpan($endDiff);
                    $emptyTimeplaceAfter->setEvent(null);
                    $emptyTimeplaceAfter->setStartDate($event->end_date);
                    
                    $tempRow[] = $emptyTimeplaceAfter;
                    }
                    $timePlaceAdded = true;
                   $result[$i]=$tempRow;
                    break;
                }
            }
            if(!$timePlaceAdded)
            {
                $tempRow = [];
                $tempDaysBefore =  $this->diffInDays($start_date, $event->start_date);
                if($tempDaysBefore>0)
                {
                    $emptyTimeplaceBefore = new timeplace();
                    $emptyTimeplaceBefore->setSpan($tempDaysBefore);
                    $emptyTimeplaceBefore->setEvent(null);
                    $emptyTimeplaceBefore->setStartDate($start_date);
                    $tempRow[] = $emptyTimeplaceBefore;
                }
                $eventTimeplace = new timeplace();
                $eventDaysDiff = $this->diffInDays($event->start_date, $event->end_date);
                $eventTimeplace->setSpan($eventDaysDiff);
                $eventTimeplace->setEvent($event);
                $eventTimeplace->setStartDate( $event->start_date);
                $tempRow[] = $eventTimeplace;
                
                $tempDaysAfter =  $this->diffInDays($event->end_date, $end_date);
                if($tempDaysAfter>0)
                {
                    $emptyTimeplaceAfter = new timeplace();
                    $emptyTimeplaceAfter->setSpan($tempDaysAfter);
                    $emptyTimeplaceAfter->setEvent(null);
                    $emptyTimeplaceAfter->setStartDate($event->end_date);
                    $tempRow[] = $emptyTimeplaceAfter;
                }
                $result[] = $tempRow;
            }
            
        
        }
        
        return $result;
    }

    private function copyCarbon(Carbon $date): Carbon
    {
        return $date->copy();
    }



}
