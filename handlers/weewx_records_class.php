<?php

/*
+---------------------------------------------------------------+
|        Enhanced Guestbook for e107 v7xx - by Father Barry
|
|        This module for the e107 v2 website system
|        Copyright Barry Keal 2004-2015
|
|		Licenced for the use of the purchaser only. This is not free
|		software.
|
+---------------------------------------------------------------+
*/
require_once ( e_PLUGIN . 'weewx/handlers/weewx_class.php' );

class weewx_records extends weewx
{
    public $prefs;

    /**
     * weewx::__construct()
     */
    function __construct()
    {
        $this->prefs = e107::getPlugPref( 'weewx', '', true );
    }
    function processMain()
    {
        $text = $this->makePage();
        return $text;
    }
    function showRow( $caption1 = '', $value1 = '', $unit1 = '', $caption2 = '', $value2 = '', $unit2 = '' )
    {

        $text = "
            <div class='row'>
                <div class='col-md-6'><i class='fa fa-dot-circle-o weeBullet' aria-hidden='true'></i> {$caption1} {$value1} {$unit1}
                </div>
                <div class='col-md-6'><i class='fa fa-dot-circle-o weeBullet' aria-hidden='true'></i> {$caption2} {$value2} {$unit2}
                </div>
            </div>
";
        return $text;
    }
    function makePage()
    {
        $this->getTestTags();

        //    print_a($this->dataFile);
        $text .= "
            <ul class='nav nav-pills'>
                <li class='active'><a href='#monthly' data-toggle='tab'>Month</a></li>
                <li><a href='#yearly' data-toggle='tab'>Year</a></li>
                <li><a href='#alltime' data-toggle='tab'>All Time</a></li>
                <li><a href='#monthsummary' data-toggle='tab'>Monthly Climate</a></li>
                <li><a href='#yearsummary' data-toggle='tab'>Annual Climate</a></li>
            </ul>
            
            <div class='tab-content'>";

        $date = new DateTime();
        $date->sub( new DateInterval( 'P1D' ) );


        //********************************************************************************************
        //*
        //*     This months extremes
        //*
        //********************************************************************************************
        $text .= "           
                <div class='tab-pane fade in active' id='monthly'>
                    <h3>This month's Records</h3>
                    <div class='readingDateTime'>Extremes on " . $date->format( 'l F j, Y' ) . "</div>
                    <div class='multi-column'> 
                        <div class='container-fluid'>";

        $temp1 = $this->dataFile['mrecordhightemp'] . "&deg;C on " . $this->dataFile['mrecordhightempday'] . '-' . $this->dataFile['mrecordhightempmonth'] .
            '-' . $this->dataFile['mrecordhightempyear'];
        $temp2 = $this->dataFile['mrecordlowtemp'] . "&deg;C on " . $this->dataFile['mrecordlowtempday'] . '-' . $this->dataFile['mrecordlowtempmonth'] . '-' .
            $this->dataFile['mrecordlowtempyear'];
        $text .= $this->showRow( "Record high temp", $temp1, " ", "Record low temp", $temp2, "" );

        $temp1 = $this->dataFile['mwarmestdayonrecord']; //. "&deg;C at " . $this->dataFile['maxtempyestt'];
        $temp2 = $this->dataFile['mcoldestdayonrecord']; // . "&deg;C at " . $this->dataFile['mintempyestt'];
        $text .= $this->showRow( "Warmest Day", $temp1, " ", "Coldest Day", $temp2, "" );

        $temp1 = $this->dataFile['mwarmestnightonrecord']; // . "&deg;C at " . $this->dataFile['maxdewyestt'];
        $temp2 = $this->dataFile['mcoldestnightonrecord']; // . "&deg;C at " . $this->dataFile['mindewyestt'];
        $text .= $this->showRow( "Warmest Night", $temp1, " ", "Coldest Night", $temp2, "" );

        $temp1 = $this->dataFile['mrecordwindgust'] . " km/h on " . $this->dataFile['mrecordhighgustday'] . '-' . $this->dataFile['mrecordhighgustmonth'] .
            '-' . $this->dataFile['mrecordhighgustyear'];
        $temp2 = $this->dataFile['mrecordwindspeed'] . " km/h on " . $this->dataFile['mrecordhighavwindday'] . '-' . $this->dataFile['mrecordhighavwindmonth'] .
            '-' . $this->dataFile['mrecordwindspeed'];
        $text .= $this->showRow( "Record wind gust", $temp1, " ", "Record wind speed", $temp2, "" );

        $temp1 = $this->dataFile['mrecorddailyrain'] . "mm on " . $this->dataFile['mrecorddailyrainday'] . '-' . $this->dataFile['mrecorddailyrainmonth'] .
            '-' . $this->dataFile['mrecorddailyrainyear'];
        $temp2 = $this->dataFile['mrecordrainrate'] . "mm/h on " . $this->dataFile['mrecordrainrateday'] . '-' . $this->dataFile['mrecordrainratemonth'] . '-' .
            $this->dataFile['mrecordrainrateyear'];
        $text .= $this->showRow( "Record daily rain", $temp1, " ", "Record daily rain rate", $temp2, "" );

        $temp1 = $this->dataFile['mrecorddayswithrain'] . " occured in " . $this->dataFile['mrecorddayswithrainmonth'] . '-' . $this->dataFile['recorddayswithrainyear'];
        $temp2 = $this->dataFile['mrecorddaysnorain'] . " occured in " . $this->dataFile['mrecorddaysnorainmonth'] . '-' . $this->dataFile['recorddaysnorainyear'];
        $text .= $this->showRow( "Record days with rain", $temp1, " ", "Record days without rain", $temp2, "" );

        $temp1 = $this->dataFile['mrecordhighbaro'] . " hPa on " . $this->dataFile['mrecordhighbaroday'] . '-' . $this->dataFile['mrecordhighbaromonth'] . '-' .
            $this->dataFile['mrecordhighbaroyear'];
        $temp2 = $this->dataFile['mrecordlowbaro'] . " km/h on " . $this->dataFile['mrecordlowbaroday'] . '-' . $this->dataFile['mrecordlowbaromonth'] . '-' .
            $this->dataFile['mrecordlowbaroyear'];
        $text .= $this->showRow( "Record high baro", $temp1, " ", "Record low baro", $temp2, "" );

        $temp1 = $this->dataFile['mrecordhighdew'] . "&deg;C on " . $this->dataFile['mrecordhighdewday'] . '-' . $this->dataFile['mrecordhighdewmonth'] . '-' .
            $this->dataFile['mrecordhighdewyear'];
        $temp2 = $this->dataFile['mrecordlowdew'] . "&deg;C on " . $this->dataFile['mrecordlowdewday'] . '-' . $this->dataFile['mrecordlowdewmonth'] . '-' . $this->
            dataFile['mrecordlowdewyear'];
        $text .= $this->showRow( "Record high dew point", $temp1, " ", "Record low dew point", $temp2, "" );

        $temp1 = $this->dataFile['mrecordhighhum'] . " % on " . $this->dataFile['mrecordhighhumday'] . '-' . $this->dataFile['mrecordhighhummonth'] . '-' . $this->
            dataFile['mrecordhighhumyear'];
        $temp2 = $this->dataFile['mrecordlowhum'] . " % on " . $this->dataFile['mrecordlowhumday'] . '-' . $this->dataFile['mrecordlowhummonth'] . '-' . $this->
            dataFile['mrecordlowhumyear'];
        $text .= $this->showRow( "Record high humidity", $temp1, " ", "Record low humidity", $temp2, "" );
        $text .= "      </div>
                    </div>
                </div> <!-- End of months page -->";
        //********************************************************************************************
        //*
        //*     This rears extremes
        //*
        //********************************************************************************************
        $text .= "           
                <div class='tab-pane fade in' id='yearly'>
                    <h3>This year's Records</h3>
                    <div class='readingDateTime'>Records as at " . $date->format( 'l F j, Y' ) . "</div>
                    <div class='multi-column'> 
                        <div class='container-fluid'>";

        $temp1 = $this->dataFile['yrecordhightemp'] . "&deg;C on " . $this->dataFile['yrecordhightempday'] . '-' . $this->dataFile['yrecordhightempmonth'] .
            '-' . $this->dataFile['yrecordhightempyear'];
        $temp2 = $this->dataFile['yrecordlowtemp'] . "&deg;C on " . $this->dataFile['yrecordlowtempday'] . '-' . $this->dataFile['yrecordlowtempmonth'] . '-' .
            $this->dataFile['yrecordlowtempyear'];
        $text .= $this->showRow( "Record high temp", $temp1, " ", "Record low temp", $temp2, "" );

        $temp1 = $this->dataFile['ywarmestdayonrecord']; //. "&deg;C at " . $this->dataFile['maxtempyestt'];
        $temp2 = $this->dataFile['ycoldestdayonrecord']; // . "&deg;C at " . $this->dataFile['mintempyestt'];
        $text .= $this->showRow( "Warmest Day", $temp1, " ", "Coldest Day", $temp2, "" );

        $temp1 = $this->dataFile['ywarmestnightonrecord']; // . "&deg;C at " . $this->dataFile['maxdewyestt'];
        $temp2 = $this->dataFile['ycoldestnightonrecord']; // . "&deg;C at " . $this->dataFile['mindewyestt'];
        $text .= $this->showRow( "Warmest Night", $temp1, " ", "Coldest Night", $temp2, "" );

        $temp1 = $this->dataFile['yrecordwindgust'] . " km/h on " . $this->dataFile['yrecordhighgustday'] . '-' . $this->dataFile['yrecordhighgustmonth'] .
            '-' . $this->dataFile['yrecordhighgustyear'];
        $temp2 = $this->dataFile['yrecordwindspeed'] . " km/h on " . $this->dataFile['yrecordhighavwindday'] . '-' . $this->dataFile['yrecordhighavwindmonth'] .
            '-' . $this->dataFile['yrecordwindspeed'];
        $text .= $this->showRow( "Record wind gust", $temp1, " ", "Record wind speed", $temp2, "" );

        $temp1 = $this->dataFile['yrecorddailyrain'] . "mm on " . $this->dataFile['yrecorddailyrainday'] . '-' . $this->dataFile['yrecorddailyrainmonth'] .
            '-' . $this->dataFile['yrecorddailyrainyear'];
        $temp2 = $this->dataFile['yrecordrainrate'] . "mm/h on " . $this->dataFile['yrecordrainrateday'] . '-' . $this->dataFile['yrecordrainratemonth'] . '-' .
            $this->dataFile['yrecordrainrateyear'];
        $text .= $this->showRow( "Record daily rain", $temp1, " ", "Record daily rain rate", $temp2, "" );

        $temp1 = $this->dataFile['yrecorddayswithrain'] . " occured in " . $this->dataFile['yrecorddayswithrainmonth'] . '-' . $this->dataFile['recorddayswithrainyear'];
        $temp2 = $this->dataFile['yrecorddaysnorain'] . " occured in " . $this->dataFile['yrecorddaysnorainmonth'] . '-' . $this->dataFile['recorddaysnorainyear'];
        $text .= $this->showRow( "Record days with rain", $temp1, " ", "Record days without rain", $temp2, "" );

        $temp1 = $this->dataFile['yrecordhighbaro'] . " hPa on " . $this->dataFile['yrecordhighbaroday'] . '-' . $this->dataFile['yrecordhighbaromonth'] . '-' .
            $this->dataFile['yrecordhighbaroyear'];
        $temp2 = $this->dataFile['yrecordlowbaro'] . " km/h on " . $this->dataFile['yrecordlowbaroday'] . '-' . $this->dataFile['yrecordlowbaromonth'] . '-' .
            $this->dataFile['yrecordlowbaroyear'];
        $text .= $this->showRow( "Record high baro", $temp1, " ", "Record low baro", $temp2, "" );

        $temp1 = $this->dataFile['yrecordhighdew'] . "&deg;C on " . $this->dataFile['yrecordhighdewday'] . '-' . $this->dataFile['yrecordhighdewmonth'] . '-' .
            $this->dataFile['yrecordhighdewyear'];
        $temp2 = $this->dataFile['yrecordlowdew'] . "&deg;C on " . $this->dataFile['yrecordlowdewday'] . '-' . $this->dataFile['yrecordlowdewmonth'] . '-' . $this->
            dataFile['yrecordlowdewyear'];
        $text .= $this->showRow( "Record high dew point", $temp1, " ", "Record low dew point", $temp2, "" );

        $temp1 = $this->dataFile['yrecordhighhum'] . " % on " . $this->dataFile['yrecordhighhumday'] . '-' . $this->dataFile['yrecordhighhummonth'] . '-' . $this->
            dataFile['yrecordhighhumyear'];
        $temp2 = $this->dataFile['yrecordlowhum'] . " % on " . $this->dataFile['yrecordlowhumday'] . '-' . $this->dataFile['yrecordlowhummonth'] . '-' . $this->
            dataFile['yrecordlowhumyear'];
        $text .= $this->showRow( "Record high humidity", $temp1, " ", "Record low humidity", $temp2, "" );
        $text .= "      </div>
                    </div>
                </div> <!-- End of years page -->";
        //********************************************************************************************
        //*
        //*     All time extremes
        //*
        //********************************************************************************************
        $text .= "           
                <div class='tab-pane fade in' id='alltime'>
                    <h3>All time Records</h3>
                    <div class='readingDateTime'>All time records as at " . $date->format( 'l F j, Y' ) . "</div>
                    <div class='multi-column'> 
                        <div class='container-fluid'>";

        $temp1 = $this->dataFile['recordhightemp'] . "&deg;C on " . $this->dataFile['recordhightempday'] . '-' . $this->dataFile['recordhightempmonth'] . '-' .
            $this->dataFile['recordhightempyear'];
        $temp2 = $this->dataFile['recordlowtemp'] . "&deg;C on " . $this->dataFile['recordlowtempday'] . '-' . $this->dataFile['recordlowtempmonth'] . '-' . $this->
            dataFile['recordlowtempyear'];
        $text .= $this->showRow( "Record high temp", $temp1, " ", "Record low temp", $temp2, "" );

        $temp1 = $this->dataFile['warmestdayonrecord']; //. "&deg;C at " . $this->dataFile['maxtempyestt'];
        $temp2 = $this->dataFile['coldestdayonrecord']; // . "&deg;C at " . $this->dataFile['mintempyestt'];
        $text .= $this->showRow( "Warmest Day", $temp1, " ", "Coldest Day", $temp2, "" );

        $temp1 = $this->dataFile['warmestnightonrecord']; // . "&deg;C at " . $this->dataFile['maxdewyestt'];
        $temp2 = $this->dataFile['coldestnightonrecord']; // . "&deg;C at " . $this->dataFile['mindewyestt'];
        $text .= $this->showRow( "Warmest Night", $temp1, " ", "Coldest Night", $temp2, "" );

        $temp1 = $this->dataFile['recordwindgust'] . " km/h on " . $this->dataFile['recordhighgustday'] . '-' . $this->dataFile['recordhighgustmonth'] . '-' .
            $this->dataFile['recordhighgustyear'];
        $temp2 = $this->dataFile['recordwindspeed'] . " km/h on " . $this->dataFile['recordhightempday'] . '-' . $this->dataFile['recordhightempmonth'] . '-' .
            $this->dataFile['recordhightempyear'];
        $text .= $this->showRow( "Record wind gust", $temp1, " ", "Record wind speed", $temp2, "" );

        $temp1 = $this->dataFile['recorddailyrain'] . "mm on " . $this->dataFile['recorddailyrainday'] . '-' . $this->dataFile['recorddailyrainmonth'] . '-' .
            $this->dataFile['recorddailyrainyear'];
        $temp2 = $this->dataFile['recordrainrate'] . "mm/h on " . $this->dataFile['recordrainrateday'] . '-' . $this->dataFile['recordrainratemonth'] . '-' .
            $this->dataFile['recordrainrateyear'];
        $text .= $this->showRow( "Record daily rain", $temp1, " ", "Record daily rain rate", $temp2, "" );

        $temp1 = $this->dataFile['recorddayswithrain'] . " occured in " . $this->dataFile['recorddayswithrainmonth'] . '-' . $this->dataFile['recorddayswithrainyear'];
        $temp2 = $this->dataFile['recorddaysnorain'] . " occured in " . $this->dataFile['recorddaysnorainmonth'] . '-' . $this->dataFile['recorddaysnorainyear'];
        $text .= $this->showRow( "Record days with rain", $temp1, " ", "Record days without rain", $temp2, "" );

        $temp1 = $this->dataFile['recordhighbaro'] . " hPa on " . $this->dataFile['recordhighbaroday'] . '-' . $this->dataFile['recordhighbaromonth'] . '-' .
            $this->dataFile['recordhighbaroyear'];
        $temp2 = $this->dataFile['recordlowbaro'] . " km/h on " . $this->dataFile['recordlowbaroday'] . '-' . $this->dataFile['recordlowbaromonth'] . '-' . $this->
            dataFile['recordlowbaroyear'];
        $text .= $this->showRow( "Record high baro", $temp1, " ", "Record low baro", $temp2, "" );

        $temp1 = $this->dataFile['recordhighdew'] . "&deg;C on " . $this->dataFile['recordhighdewday'] . '-' . $this->dataFile['recordhighdewmonth'] . '-' . $this->
            dataFile['recordhighdewyear'];
        $temp2 = $this->dataFile['recordlowdew'] . "&deg;C on " . $this->dataFile['recordlowdewday'] . '-' . $this->dataFile['recordlowdewmonth'] . '-' . $this->
            dataFile['recordlowdewyear'];
        $text .= $this->showRow( "Record high dew point", $temp1, " ", "Record low dew point", $temp2, "" );

        $temp1 = $this->dataFile['recordhighhum'] . " % on " . $this->dataFile['recordhighhumday'] . '-' . $this->dataFile['recordhighhummonth'] . '-' . $this->
            dataFile['recordhighhumyear'];
        $temp2 = $this->dataFile['recordlowhum'] . " % on " . $this->dataFile['recordlowhumday'] . '-' . $this->dataFile['recordlowhummonth'] . '-' . $this->
            dataFile['recordlowhumyear'];
        $text .= $this->showRow( "Record high humidity", $temp1, " ", "Record low humidity", $temp2, "" );
        /*
        $temp1 = $this->dataFile['recordhighhum'] . " % on " . $this->dataFile['recordhighhumday'].'-'.$this->dataFile['recordhighhummonth'].'-'.$this->dataFile['recordhighhumyear'];
        $temp2 = $this->dataFile['recordlowhum'] . " % on ". $this->dataFile['recordlowhumday'].'-'.$this->dataFile['recordlowhummonth'].'-'.$this->dataFile['recordlowhumyear'];
        $text .= $this->showRow( "Record high humidity", $temp1, " ", "Record low humidity", $temp2, "" );
        */
        $text .= "  
                        </div>
                    </div>
                </div> <!-- End of all time page -->";
        $text .= "           
                <div class='tab-pane fade in' id='monthsummary'>
                    <h3>Climate Summary by month</h3>
                    <div class='readingDateTime'>Extremes on " . $date->format( 'l F j, Y' ) . "</div>
                    <div class='multi-column'> 
                        <div class='container-fluid'>";
        $text .= $this->getMonthly();
        $text .= "      </div>
                    </div>
                </div> <!-- End of months page -->";
        $text .= "           
                <div class='tab-pane fade in' id='yearsummary'>
                    <h3>Climate Summary by Year</h3>
                    <div class='readingDateTime'>Extremes on " . $date->format( 'l F j, Y' ) . "</div>
                    <div class='multi-column'> 
                        <div class='container-fluid'>";
        $text .= $this->getAnnual();
        $text .= "      </div>
                    </div>
                </div> <!-- End of months page -->";
        $text .= "  
            </div>";
        return $text;
    }
    function getMonthly()
    {
$path=$this->prefs['weewx_noaapath'];
        $month = glob( $path.'NOAA-????-??.txt' );
      //  var_dump( $path );
        $retval .= '
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="false">';

        foreach ( $month as $key => $value ) // do each year
        {
            $tmp = pathinfo( $value );
            $tmp = str_replace( 'NOAA-', '', $tmp['filename'] );
            //  var_dump( $tmp );
            $file = file_get_contents( $value );
          //  var_dump( $file );
            $retval .= '
    <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="heading' . $tmp . '">
            <h4 class="panel-title">
                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse' . $tmp .
                '" aria-expanded="true" aria-controls="collapse' . $tmp . '">';
            $retval .= $tmp;
            $retval .= '</a>
            </h4>
        </div>
        <div id="collapse' . $tmp . '" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading' . $tmp . '">
            <div class="panel-body">
            <div class="cliDown"><a href="' . $value .
                '" target="_blank" data-toggle="tooltip" title="Download this as a text file in NOAA format(right click save as)"><i class="fa fa-arrow-circle-o-down" aria-hidden="true"></i></a></div><div class="climSum" >';
            $retval .= nl2br( $file );
            $retval .= ' </div>
            </div>
        </div>
    </div>';
        }
        $retval .= ' 
</div>';

        return $retval;
    }


    function getAnnual()
    {
$path=$this->prefs['weewx_noaapath'];
        $year = glob( $path.'NOAA-????.txt' );
        $retval .= '
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="false">';

        foreach ( $year as $key => $value ) // do each year
        {
            $tmp = pathinfo( $value );
            $tmp = str_replace( 'NOAA-', '', $tmp['filename'] );
            //  var_dump( $tmp );
            $file = file_get_contents( $value );
            $retval .= '
    <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="heading' . $tmp . '">
            <h4 class="panel-title">
                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse' . $tmp .
                '" aria-expanded="true" aria-controls="collapse' . $tmp . '">';
            $retval .= $tmp;
            $retval .= '</a>
            </h4>
        </div>
        <div id="collapse' . $tmp . '" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading' . $tmp . '">
            <div class="panel-body">
            <div class="cliDown"><a href="' . $value .
                '" target="_blank" data-toggle="tooltip" title="Download this as a text file in NOAA format(right click save as)"><i class="fa fa-arrow-circle-o-down" aria-hidden="true"></i></a></div><div class="climSum" >';
            $retval .= nl2br( $file );
            $retval .= ' </div>
            </div>
        </div>
    </div>';


        }
        $retval .= ' 
</div>';

        return $retval;
    }
}
