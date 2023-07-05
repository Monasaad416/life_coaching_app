<?php

namespace App\Http\Controllers\Front;
use Illuminate\Http\Request;
use Google\Client as GoogleClient;

use App\Http\Controllers\Controller;
use Spatie\GoogleCalendar\GoogleCalendar;
use Spatie\GoogleCalendar\GoogleCalendarFactory;

class CalendarController extends Controller
{
    public function getCalendarEvents()
{
    // $client = new GoogleClient();
    // $client->setApplicationName('My Calendar App');
    // $client->setScopes([GoogleCalendar::CALENDAR_READONLY]);
    // $client->setAuthConfig('client_secret.json');
    // $client->setAccessType('offline');
    // $client->setPrompt('select_account consent');

    // $apiKey = trim(config('services.google.calendar_api_key'));
    // $client->setDeveloperKey($apiKey);


    // $service = new GoogleCalendar($client);

    // //$calendarId = 'primary';
    // $calendarId = trim(config('services.google.calendar_id'));
    // $optParams = [
    //     'maxResults' => 10,
    //     'orderBy' => 'startTime',
    //     'singleEvents' => true,
    //     'timeMin' => date('c'),
    // ];
    
    
    // $url = "https://www.googleapis.com/calendar/v3/calendars/$calendarId/events?".http_build_query($optParams)."&key=$apiKey";
    // //return dd($url);
    // //return dd($service->events);
    // $results = $service->events->listEvents($calendarId, $optParams);
    //     //$jsonResponse = $results->toSimpleObject(); //Convert the response to a JSON object
    // //dd($jsonResponse); //Dump the JSON object

    // $events = $results->getItems();


    // return view('front.google_meetings.index', compact('events'));


    $calendarId = config('google.calendar_id');
    function getAccessToken() {
    $client = new GoogleClient();
    

$client = new GoogleClient();
$clientSecretPath = base_path('app/google-calendar/client_secret.json');
$client->setAuthConfig($clientSecretPath);
$client->setAccessType('offline');

$scopes = ['https://www.googleapis.com/auth/calendar'];
$client->setScopes($scopes);

$authUrl = $client->createAuthUrl();
header('Location: ' . filter_var($authUrl, FILTER_SANITIZE_URL));
exit;
    $client->setAccessType('offline');
    $client->setPrompt('consent');

    $scopes = ['https://www.googleapis.com/auth/calendar'];
    $client->setScopes($scopes);

    // Set up the authorization flow
    $authUrl = $client->createAuthUrl();
    // Redirect the user to the authorization URL
    header('Location: ' . filter_var($authUrl, FILTER_SANITIZE_URL));
    exit;

    // Once the user authorizes the app, they will be redirected back to your app
    // with a code that can be exchanged for an access token
    $code = $_GET['code'];
    $accessToken = $client->fetchAccessTokenWithAuthCode($code);

    return $accessToken['access_token'];
}
$accessToken = getAccessToken(); // Replace with your access token




$calendar = GoogleCalendarFactory::create($accessToken, $calendarId);
    $events = $calendar->getEvents();
    return dd($events);
}




//Note: This method retrieves the next 10 upcoming events from the user's [primary calendar](poe://www.poe.com/_api/key_phrase?phrase=primary%20calendar&prompt=Tell%20me%20more%20about%20primary%20calendar.).



public function googleCalendarCallback() {
    return dd("callback");
}
}
