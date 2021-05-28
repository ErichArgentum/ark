<?php

use App\Mail\NewAvailableTimes;
use Illuminate\Support\Facades\Route;
use PHPUnit\TextUI\XmlConfiguration\CodeCoverage\Report\Crap4j;
use Goutte\Client;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

Route::get('contact', 'ContactFormController@create');

Route::get('/', function () {
    $client = new Client();
    $crawler = $client->request('GET', 'https://eteenindus.mnt.ee/public/vabadSoidueksamiajad.xhtml');
    $dates = $crawler->filterXPath('//*[@id="eksami_ajad:kategooriaBEksamiAjad_data"]/tr')->each(function ($node) {
        if($node->children()->text() === 'Kuressaare') {
            return $node->children()->each(function ($node) {
                if ($node->text() !== 'Kuressaare' && $node->text() !== '') {
             
                    return Carbon::parse($node->text());
                }
            });
        };
    });
    $times = collect($dates)->flatten()->filter(function($date){
        if ($date !== null) {
            if ($date->isBefore(Carbon::now()->addDays(30))) {
                return $date;
            }
            
        }
    });
    if ($times->isNotEmpty()) {
    Mail::to('erich.hobe@mail.com')->send(new NewAvailableTimes($times));
    }
});
