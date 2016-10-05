# Charts

### Charts is a multi-library chart package to create interactive charts using laravel.

[![StyleCI](https://styleci.io/repos/69124179/shield?branch=master)](https://styleci.io/repos/69124179)
![StyleCI](https://img.shields.io/badge/Built_for-Laravel-green.svg?style=flat-square)
![StyleCI](https://img.shields.io/github/license/consoletvs/charts.svg?style=flat-square)

![Example Chart](https://i.gyazo.com/2ea6d7af4f467e882c38af88095cb062.png)

## Table Of Contents

-	[News](#news)
-	[Libraries & Types](#libraries--types)
-	[Installation](#installation)
	-	[Video Tutorial](#video-tutorial)
	-	[Download](#download)
	-	[Add service provider & alias](#add-service-provider--alias)
	-	[Publish the assets](#publish-the-assets)
-	[Default Settings](#default-settings)
-	[Usage](#usage)
-	[Chart Examples](#chart-examples)
	-	[Pie](#pie)
	-	[Donut / Doughnut](#donut--doughnut)
	-	[Line](#line)
	-	[Area](#area)
	-	[Bar](#bar)
	-	[Geo](#geo)
	-	[Gauge](#gauge)
	-	[Temperature](#temperature)
-	[Database Charts](#database-charts)
-	[Realtime Charts](#realtime-charts)
-	[Charts Functions](#charts-functions)
-	[Available Chart Settings](#available-chart-settings)
-	[Extend your way](#extend-your-way)

## News

**October 3, 2016**

Charts are now even more responsive, if you want a fixed height and a responsive width, simple set responsive to false, and then set width to 0 and height to the one you like!

**September 29, 2016**

You can now generate a new chart using the database data without building it manually. See *Database Charts* section for more information!

## Libraries & Types

Charts include the following libraries & types by default:

- ChartJS  ```chartjs```
	- Area Chart ```area```
	- Line Chart  ```line```
	- Bar Chart  ```bar```
	- Pie Chart ```pie```
	- Donut / Doughnut Chart ```donut```
- Highcharts  ```highcharts```
	- Area Chart ```area```
	- Line Chart  ```line```
	- Bar Chart  ```bar```
	- Pie Chart ```pie```
	- Donut / Doughnut Chart ```donut```
	- Geo Chart  ```geo```
- Google Charts ```google```
	- Area Chart ```area```
	- Line Chart  ```line```
	- Bar Chart  ```bar```
	- Pie Chart ```pie```
	- Donut / Doughnut Chart ```donut```
	- Geo Chart  ```geo```
	- Gauge Chart  ```gauge``` *Realtime Available*
- Google Material  ```material```
	- Line Chart  ```line```
	- Bar Chart  ```bar```
- Chartist  ```chartist```
	- Area Chart ```area```
	- Line Chart  ```line```
	- Bar Chart  ```bar```
	- Pie Chart ```pie```
	- Donut / Doughnut Chart ```donut```
- FusionCharts  ```fusioncharts```
	- Area Chart ```area```
	- Line Chart  ```line```
	- Bar Chart  ```bar```
	- Pie Chart ```pie```
	- Donut / Doughnut Chart ```donut```
- Morris JS  ```morris```
	- Area Chart ```area```
	- Line Chart  ```line```
	- Bar Chart  ```bar```
	- Donut / Doughnut Chart ```donut```
- Plottable JS  ```plottablejs```
	- Area Chart ```area```
	- Line Chart  ```line```
	- Bar Chart  ```bar```
	- Pie Chart ```pie```
	- Donut / Doughnut Chart ```donut```
- Minimalist  ```minimalist```
	- Area Chart ```area```
	- Line Chart  ```line```
	- Bar Chart  ```bar```
	- Pie Chart ```pie```
	- Donut / Doughnut Chart ```donut```
- Canvas Gauges ```canvas-gauges```
	- Gauge Chart ```gauge``` *Realtime Available*
	- Temperature Chart ```temp``` *Realtime Available*

## Installation

### Video Tutorial

[![Video Tutorial](https://img.youtube.com/vi/IEhZTcpbknA/0.jpg)](https://www.youtube.com/watch?v=IEhZTcpbknA)

To install charts use composer

### Download

```
composer require consoletvs/charts
```

### Add service provider & alias

Add the following service provider to the array in: ```config/app.php```

```
ConsoleTVs\Charts\ChartsServiceProvider::class,
```

Add the following alias to the array in: ```config/app.php```

```
'Charts' => ConsoleTVs\Charts\Charts::class,
```
### Publish the assets

```
php artisan vendor:publish --tag=charts_config
php artisan vendor:publish --tag=charts_assets --force
```

## Default Settings

The file in: ```config/charts.php``` contains an array of settings, you can find the default settings in there.

## Usage

Example Controller:

```
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Charts;

class TestController extends Controller
{
    public function index()
    {
		$chart = Charts::new('line', 'highcharts')
			->setTitle('My nice chart')
			->setLabels(['First', 'Second', 'Third'])
			->setValues([5,10,20])
			->setDimensions(1000,500)
			->setResponsive(false);
		return view('test', ['chart' => $chart]);
    }
}
```

Example View:

```
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>My Charts</title>

		{!! Charts::assets() !!}

    </head>
    <body>
        <center>
			{!! $chart->render() !!}
		</center>
    </body>
</html>

```

## Chart Examples

### Pie

Note: ```highcharts``` can't change the color of this chart. Well it can but it's complicated, so I leave it here.

```
Charts::new('pie', 'highcharts')
	->setTitle('My nice chart')
	->setLabels(['First', 'Second', 'Third'])
	->setValues([5,10,20])
	->setDimensions(1000,500)
	->setResponsive(false);
```

![Example Pie](https://i.gyazo.com/b61a0a5786a8f70daf61398d256366b8.png)

### Donut / Doughnut

Note: ```highcharts``` and ```chartist``` can't change the color of this chart. Well they can but it's complicated, so I leave it here.

```
Charts::new('donut', 'highcharts')
	->setTitle('My nice chart')
	->setLabels(['First', 'Second', 'Third'])
	->setValues([5,10,20])
	->setDimensions(1000,500)
	->setResponsive(false);
```

![Example Donut](https://i.gyazo.com/fecef4a102cb348d0f7f3681120a600f.png)


### Line

```
Charts::new('line', 'highcharts')
	->setTitle('My nice chart')
	->setElementLabel('My nice label')
	->setLabels(['First', 'Second', 'Third'])
	->setValues([5,10,20])
	->setDimensions(1000,500)
	->setResponsive(false);
```

![Example Line](https://i.gyazo.com/121736e3b8aa7f22ad17a7c0ceecac02.png)

### Area

```
Charts::new('area', 'highcharts')
	->setTitle('My nice chart')
	->setElementLabel('My nice label')
	->setLabels(['First', 'Second', 'Third'])
	->setValues([5,10,20])
	->setDimensions(1000,500)
	->setResponsive(false);
```

![Example Area](https://i.gyazo.com/f6c500cf9bfc2e449d64ee19b7bb809c.png)


### Bar

Note: ```highcharts``` can't change the color of this chart. Well it can but it's complicated, so I leave it here.

```
Charts::new('bar', 'highcharts')
	->setTitle('My nice chart')
	->setElementLabel('My nice label')
	->setLabels(['First', 'Second', 'Third'])
	->setValues([5,10,20])
	->setDimensions(1000,500)
	->setResponsive(false);
```

![Example Bar](https://i.gyazo.com/94ada1aac091ef3cbc84433a3425a9aa.png)

### Geo

Note: The labels must have the country codes, not the name.

Note 2: To add color to the chart, you'll need to provide an array of at least 2 colors. The first is the min and the second the max.

```
Charts::new('geo', 'highcharts')
	->setTitle('My nice chart')
	->setElementLabel('My nice label')
	->setLabels(['ES', 'FR', 'RU'])
	->setColors(['#C5CAE9', '#283593'])
	->setValues([5,10,20])
	->setDimensions(1000,500)
	->setResponsive(false);
```

![Example Geo](https://i.gyazo.com/f7a76582e80912864c6cfb23f688e43e.png)

### Gauge

Note: You either need 1 value or 3 following this standar: ```[actualValue, minValue, maxValue]```

```
Charts::new('gauge', 'canvas-gauges')
	->setTitle('My nice chart')
	->setElementLabel('My nice label')
	->setValues([65,0,100])
	->setResponsive(false)
	->setHeight(300)
	->setWidth(0);
```

![Example Gauge](https://i.gyazo.com/a9bc88c6550d39a15b5a686ea66df0ea.png)

### Temperature

Note: You either need 1 value or 3 following this standar: ```[actualValue, minValue, maxValue]```

```
Charts::new('temp', 'canvas-gauges')
	->setTitle('My nice chart')
	->setElementLabel('My nice label')
	->setValues([65,0,100])
	->setResponsive(false)
	->setHeight(300)
	->setWidth(0);
```

![Example Temperature](https://i.gyazo.com/1a8f264ffd9746da06d67c3624eaac81.png)

## Database Charts

You can also generate database charts with simple setup!

```
$chart = Charts::database(User::all(), 'bar', 'highcharts');
```

Example data:
![Example Data](https://i.gyazo.com/e41f0117845230edc5189cd7b5821933.png)

**Note:** You are required to use a specific group method before rendering the chart!

*Important:* To work with the *GroupByYear, GroupByMonth, GroupByDay, lastByYear, lastByMonth & lastByDay* you'll need the column ```created_at``` in the data rows.

The available methods are:

- setData(required mixed $data)

	Setup the data again.

	```
	$chart = Charts::database(User::all(), 'bar', 'highcharts')->setData(Role::all());
	```

- groupBy(required string $column)

	Groups the data based on a column.

	```
	$chart = Charts::database(User::all(), 'bar', 'highcharts')
		->setElementLabel("Total")
		->setDimensions(1000, 500)
		->setResponsive(false)
		->groupBy('game');
	```

	![Example GroupBy](https://i.gyazo.com/30183fa75f6bee6848898c4dbe487491.png)

- groupByYear(optional int $years)

	Groups the data based in years.

	*Default:* ```$years = 4```

	```
	$chart = Charts::database(User::all(), 'bar', 'highcharts')
		->setElementLabel("Total")
		->setDimensions(1000, 500)
		->setResponsive(false)
		->groupByYear();

	// to display a number of years behind, pass a int parameter. For example to display the last 10 years:
	$chart = Charts::database(User::all(), 'bar', 'highcharts')
		->setElementLabel("Total")
		->setDimensions(1000, 500)
		->setResponsive(false)
		->groupByYear(10);
	```

	![Example GroupByYear](https://i.gyazo.com/5d992b6ce858fee8ed455c61e3bec546.png)

- groupByMonth(optional string $year, optional boolean $fancy)

	Groups the data in months (if no year set, the current one will be used).

	*Default:* ```$year = 7, $fancy = false```

	```
	$chart = Charts::database(User::all(), 'bar', 'highcharts')
		->setElementLabel("Total")
		->setDimensions(1000, 500)
		->setResponsive(false)
		->groupByMonth();

	// to display a specific year, pass the parameter. For example to display the months of 2016 and display a fancy output label:
	$chart = Charts::database(User::all(), 'bar', 'highcharts')
		->setElementLabel("Total")
		->setDimensions(1000, 500)
		->setResponsive(false)
		->groupByMonth('2016', true);
	```

	![Example GroupByYear](https://i.gyazo.com/8d93b2f74857047339317d54b5082868.png)

- groupByDay(optional string $month, optional string $year, optional boolean $fancy)

	Groups the data in days (if no year/month set, the current one will be used).

	*Default:* ```$month = date('m'), $year = date('Y'), $fancy = false```

	```
	$chart = Charts::database(User::all(), 'bar', 'highcharts')
		->setElementLabel("Total")
		->setDimensions(1000, 500)
		->setResponsive(false)
		->groupByDay();

	// to display a specific month and/or year, pass the parameters. For example to display the days of september 2016 and display a fancy output label:
	$chart = Charts::database(User::all(), 'bar', 'highcharts')
		->setElementLabel("Total")
		->setDimensions(1000, 500)
		->setResponsive(false)
		->groupByDay('09', '2016', true);
	```

	![Example GroupByYear](https://i.gyazo.com/b461f29f41a0a5ac046f1cea79083dcc.png)

- lastByYear(optional int $number)

	Alias for groupByYear() method. Does the same.

	*Default:* ```$number = 4```

	```
	$chart = Charts::database(User::all(), 'bar', 'highcharts')
		->setElementLabel("Total")
		->setDimensions(1000, 500)
		->setResponsive(false)
		->lastByYear();

	// to display a number of years behind, pass a int parameter. For example to display the last 3 years:
	$chart = Charts::database(User::all(), 'bar', 'highcharts')
		->setElementLabel("Total")
		->setDimensions(1000, 500)
		->setResponsive(false)
		->lastByYear(3);
	```

	![Example LastByYear](https://i.gyazo.com/7f85bec0fb49f5729608aa87b8657fc1.png)

- lastByMonth(optional int $number, optional boolean $fancy)

	Display the numbers of months behind (relative to the current date).

	*Default:* ```$number = 6, $fancy = false```

	```
	$chart = Charts::database(User::all(), 'bar', 'highcharts')
		->setElementLabel("Total")
		->setDimensions(1000, 500)
		->setResponsive(false)
		->lastByMonth();

	// to display a number of months behind, pass a int parameter. For example to display the last 6 months and use a fancy output:
	$chart = Charts::database(User::all(), 'bar', 'highcharts')
		->setElementLabel("Total")
		->setDimensions(1000, 500)
		->setResponsive(false)
		->lastByMonth(6, true);
	```

	![Example LastByMonth](https://i.gyazo.com/7c7df6503749fda8d96807d6bc2861aa.png)

- lastByDay(optional int $number, optional boolean $fancy)

	Display the numbers of days behind (relative to the current date).

	*Default:* ```$number = 7, $fancy = false```

	```
	$chart = Charts::database(User::all(), 'bar', 'highcharts')
		->setElementLabel("Total")
		->setDimensions(1000, 500)
		->setResponsive(false)
		->lastByDay();

	// to display a number of days behind, pass a int parameter. For example to display the last 14 days and use a fancy output:
	$chart = Charts::database(User::all(), 'bar', 'highcharts')
		->setElementLabel("Total")
		->setDimensions(1000, 500)
		->setResponsive(false)
		->lastByDay(14, true);
	```

	![Example LastByDay](https://i.gyazo.com/eeac8c7551ed681ef3728454ba4be9f0.png)

## Realtime Charts

You can create realtime charts (currently limited to gauge/temperature charts)

Example json:

```
{"value":31}
```

'value' can be changed to diferent index name with ```setValueName($string)```

```
$chart = Charts::realtime(url('/path/to/json'), 2000, 'gauge', 'google')
            ->setValues([65, 0, 100])
            ->setLabels(['First', 'Second', 'Third'])
            ->setResponsive(false)
            ->setHeight(300)
            ->setWidth(0)
            ->setTitle("Permissions Chart")
			->setValueName('value'); //This determines the json index for the value
```

**Note:** The interval is set in ms

The available methods are:

-	setValueName(required string $string)

	Sets the value json index

	*Default:* ```value```

	```
	$chart = Charts::realtime(url('/path/to/json'), 2000, 'gauge', 'google')
				->setValues([65, 0, 100])
				->setLabels(['First', 'Second', 'Third'])
				->setResponsive(false)
				->setHeight(300)
				->setWidth(0)
				->setTitle("Permissions Chart")
				->setValueName('value'); //This determines the json index for the value
	```

-	setUrl(required string $url)

	Sets the url after chart object creation

	```
	$chart = Charts::realtime(url('/path/to/json'), 2000, 'gauge', 'google')
				->setValues([65, 0, 100])
				->setLabels(['First', 'Second', 'Third'])
				->setResponsive(false)
				->setHeight(300)
				->setWidth(0)
				->setTitle("Permissions Chart")
				->setUrl(url('/new/json'));
	```

-	setInterval(required int $interval)

	Sets the interval after chart object creation (ms)

	```
	$chart = Charts::realtime(url('/path/to/json'), 2000, 'gauge', 'google')
				->setValues([65, 0, 100])
				->setLabels(['First', 'Second', 'Third'])
				->setResponsive(false)
				->setHeight(300)
				->setWidth(0)
				->setTitle("Permissions Chart")
				->setInterval(3000); // in ms
	```
	
## Charts Functions

- new()

  Returns a new chart instance, if no library is specified, the default one will be used.

  ```
  Charts::new('line');
  Charts::new('line', 'highcharts');
  ```



- database(required mixed $object, optional string $type, optional string $library)

	Returns a new database chart instance that extends the base one.

	```
    Charts::database(User::all());
    Charts::new(User::all(), 'line', 'highcharts');
    ```

- realtime(required string $url, required int $interval, optional string $type, optional string $library)

	Returns a new database chart instance that extends the base one.

	```
    Charts::realtime(url('/json/data'), 2000, 'gauge', 'google')
    ```

- assets()

  Returns all the assets to generate the graphs.

  ```
  <?php echo Charts::assets(); ?>

  // using blade
  {!! Charts::assets() !!}
  ```

- libraries()

  Returns an array of all the libraries available (can be filtered).

  ```
  // Return all the libraries available
  print_r(Charts::libraries());

  // Return all the libraries available for the line chart
  print_r(Charts::libraries('line'));
  ```

- types()

  Returns an array of all the chart types available (can be filtered).

  ```
  // Return all the chart types available
  print_r(Charts::types());

  // Return all the chart types available for the highcharts library
  print_r(Charts::libraries('highcharts'));
  ```

## Available Chart Settings:

- setGaugeStyle($style)

	Set the gauge style

	*Default:* ```left```

	*Available options:* ```left``` ```right``` ```center```

	```
	Charts::new('gauge', 'google')->setGaugeStyle('right');
	```

- setType()

  Set the chart type after creation (Example: from line to pie).

  ```
  Charts::new('line', 'highcharts')->setType('pie');
  ```

- setLibrary()

  Set the chart library after creation (Example: from highcharts to google).

  ```
  Charts::new('line', 'highcharts')->setLibrary('google');
  ```

- setLabels()

  The labels of the chart.

  ```
  Charts::new('line', 'highcharts')->setLabels(['First', 'Second', 'Third']);
  ```

- setValues()

  The values of the chart respectively.

  ```
  Charts::new('line', 'highcharts')->setValues([10, 50, 100]);
  ```

- setElementLabel()

  The element label for line / bar / geo charts.

  ```
  Charts::new('line', 'highcharts')->setElementLabel('Total Views');
  ```

- setTitle()

  The chart title.

  ```
  Charts::new('line', 'highcharts')->setTitle('My Chart');
  ```

- setColors()

  The colors of the charts respectively.

  ```
  Charts::new('line', 'highcharts')->setColors(['#ff0000', '#00ff00', '#0000ff']);
  ```

- setWidth()

  The chart width if non-responsive. 0 = responsive width.

  ```
  Charts::new('line', 'highcharts')->setWidth(1000);
  ```

- setHeight()

  The chart height if non-responsive. 0 = responsive height.

  ```
  Charts::new('line', 'highcharts')->setHeight(500);
  ```

- setDimensions()

  The chart dimensions (shortcut to set width, height with one funcion).

  ```
  Charts::new('line', 'highcharts')->setHeight(1000, 500);
  ```

- setResponsive()

  Set if the chart is responsive or not. If not, the chart dimensions will be used.

  ```
  Charts::new('line', 'highcharts')->setResponsive(false);
  ```

- settings()

  Return the chart settings.

  ```
  print_r(Charts::new('line', 'highcharts')->settings());
  ```

- render()

  Render the chat.

  ```
  echo Charts::new('line', 'highcharts')->setLabels(['One', 'Two'])->setValues([10, 20])->render();
  ```

## Extend your way!

You can create your own Charts by forking this repository. The ```src/Templates``` folder contains all the current charts, but you can
add yours like this:

### Create a new file

Create a new file, the syntax is: ```library.type.php```

if your chart library is called: ```mylib```
and your template is for the line chart: ```line```
Then you create a file like this: ```mylib.line.php```

To call it later, just use:

```
$chart = Charts::new('line', 'mylib');
```

You will need to add the CSS / JS to the includes.php file found in the ```/src``` folder.

You have plenty of examples to see how to put the data so just take a closer look at all the included templates before doing yours!
