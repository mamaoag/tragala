<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Charts;
class StatisticsController extends Controller
{
        function __construct() {
            $this->middleware(['admin','verify']);
        }

        public function users()
        {
                $chart = Charts::database(\App\User::all(),'line','highcharts')
                            ->monthFormat('F Y')
                            ->title('Unique Users')
                            ->responsive(false)
                            ->dimensions(1000,500)
                            ->elementLabel('Users')
                            ->groupByMonth();
                
                $title = 'User Statistics';
                return view('admin.chart',['chart' => $chart, 'title' => $title]);
        }

        public function posts()
        {
                $chart = Charts::database(\App\Post::all(),'line','highcharts')
                         ->dateFormat('F Y')
                        ->title('Post Frequency')
                        ->responsive(false)
                        ->dimensions(1000,500)
                        ->elementLabel('Posts by Users')
                        ->groupByMonth();

                $title = 'Post Statistics';
                return view('admin.chart',['chart' => $chart, 'title' => $title]); 
        }        
        
}
