<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('sitemap:build')->everyFifteenMinutes()->dailyAt('03:10');
