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

include_lan( e_PLUGIN . 'weewxfb/languages/' . e_LANGUAGE . '_weewx.php' );
require_once ( e_PLUGIN . 'weewx/handlers/weewx_class.php' );

/**
 * weewx_data
 * 
 * @package   
 * @author WeeWX
 * @copyright Father Barry
 * @version 2016
 * @access public
 */
class weewx_data extends weewx
{

    /**
     * weewx_data::showRow()
     * 
     * @param string $caption1
     * @param string $value1
     * @param string $unit1
     * @param string $caption2
     * @param string $value2
     * @param string $unit2
     * @return
     */
    function showRow( $caption1 = '', $value1 = '', $unit1 = '', $caption2 = '', $value2 = '', $unit2 = '' )
    {
        $text = "
            <div class='row'>
                <div class='col-md-6'><i class='fa fa-dot-circle-o weeBullet' aria-hidden='true'></i> {$caption1} {$value1} {$unit1}
                </div>
                <div class='col-md-6'><i class='fa fa-dot-circle-o weeBullet' aria-hidden='true'></i> {$caption2} {$value2} {$unit2}
                </div>
            </div>";
        return $text;
    }
    /**
     * weewx_data::makePage()
     * 
     * @return
     */
    function makePage()
    {
        $this->getTestTags();

        $text .= "
            <ul class='nav nav-pills'>
                <li class='active'><a href='#current' data-toggle='tab'>Current</a></li>
                <li><a href='#today' data-toggle='tab'>Today</a></li>
                <li><a href='#yesterday' data-toggle='tab'>Yesterday</a></li>
                <!--
                <li><a href='#daily' data-toggle='tab'>Daily</a></li>
                <li><a href='#weekly' data-toggle='tab'>Weekly</a></li>
                <li><a href='#monthly' data-toggle='tab'>Monthly</a></li>
                <li><a href='#yearly' data-toggle='tab'>Annual</a></li>
                <li><a href='#alltime' data-toggle='tab'>All Time</a></li>
                -->
            </ul>
            
            <div class='tab-content'>
                <div class='tab-pane fade in active' id='current'>
                    <h3>Current Conditions</h3>
                    <div class='readingDateTime'>Reading taken at {$this->dataFile['time']} on {$this->dataFile['date']}</div>

                    <div class='multi-column'> 
                        <div class='container-fluid'>";
        //********************************************************************************************
        //*
        //*     Current conditions
        //*
        //********************************************************************************************
        $text .= $this->showRow( "Temperature outside", $this->dataFile['temperature'], "&deg;C", "Humidity", $this->dataFile['humidity'], "%" );

        $text .= $this->showRow( "Feels like", $this->dataFile['feelslike'], "&deg;C", "Dew point", $this->dataFile['dewpt'], "&deg;C" );

        $text .= $this->showRow( "Average windspeed", $this->dataFile['avgspd'], "mph", "Wind gust", $this->dataFile['gstspd'], "mph" );

        $text .= $this->showRow( "Wind direction", $this->dataFile['dirdeg'], "&deg;", "Blowing from", $this->dataFile['dirlabel'], " " );

        $text .= $this->showRow( "Barometer", $this->dataFile['baro'], "hPa;", "Pressure trend", $this->dataFile['trend3hour'], $this->dataFile['pressuretrendname'] );

        $text .= $this->showRow( "UV Level", $this->dataFile['VPuv'], " ", "Solar Radiation", $this->dataFile['VPsolar'], " W/m<sup>2</sup>" );

        $text .= $this->showRow( "Rainfall today", $this->dataFile['dayrn'], "mm", "Current rain rate", $this->dataFile['currentrainratehr'], "mm/hr" );

        $text .= "      </div>
                    </div>
                </div> <!-- End of current page -->";
        //********************************************************************************************
        //*
        //*     Todays extremes
        //*
        //********************************************************************************************
        $text .= "
                <div class='tab-pane fade ' id='today'>
                    <h3>Today's Summary</h3>
                    <div class='readingDateTime'>Extremes at {$this->dataFile['time']} on {$this->dataFile['date']}</div>
                    <div class='multi-column'> 
                        <div class='container-fluid'>";

        $temp1 = $this->dataFile['maxtemp'] . "&deg;C at " . $this->dataFile['maxtempt'];
        $temp2 = $this->dataFile['mintempyest'] . "&deg;C at " . $this->dataFile['mintempyestt'];
        $text .= $this->showRow( "Max temperature", $temp1, " ", "Min temperature", $temp2, "" );

        $temp1 = $this->dataFile['maxdewyest'] . ";C at " . $this->dataFile['maxdewyestt'];
        $temp2 = $this->dataFile['mindewyest'] . ";C at " . $this->dataFile['mindewyestt'];
        $text .= $this->showRow( "Max dewpoint", $temp1, " ", "Min dewpoint", $temp2, "" );

        $temp1 = $this->dataFile['highhum'] . "% at " . $this->dataFile['highhumt'];
        $temp2 = $this->dataFile['lowhum'] . "% at " . $this->dataFile['lowhumt'];
        $text .= $this->showRow( "Max humidity", $temp1, " ", "Min humidity", $temp2, "" );

        $temp1 = $this->dataFile['maxrainrate'] . " mm/hr at " . $this->dataFile['maxrainratetime'];
        $temp2 = $this->dataFile['dayrn'] . "" . ""; //"$this->dataFile['lowbarot'];
        $text .= $this->showRow( "Max rainrate", $temp1, " ", "Total rain", $temp2, "" );

        $temp1 = $this->dataFile['highbaro'] . " hpa at " . $this->dataFile['highbarot'];
        $temp2 = $this->dataFile['lowbaro'] . " hpa at " . $this->dataFile['lowbarot'];
        $text .= $this->showRow( "Max barometer", $temp1, " ", "Min barometer", $temp2, "" );


        $temp1 = $this->dataFile['windruntoday'] . " km ";
        $temp2 = $this->dataFile['maxgst'] . " /hr at " . $this->dataFile['maxgstt'];
        $text .= $this->showRow( "Wind run", $temp1, " ", "Max gust", $temp2, "" );


        $temp1 = $this->dataFile['highbaro'] . "hpa at " . $this->dataFile['highbarot'];
        $temp2 = $this->dataFile['lowbaro'] . "hpa at " . $this->dataFile['lowbarot'];
        $text .= $this->showRow( "Max barometer", $temp1, " ", "Min barometer", $temp2, "" );


        $temp1 = $this->dataFile['maxavgspd'] . " at " . $this->dataFile['maxavgspdt'];
        $temp2 = ""; //"$this->dataFile['lowbaro'] . "hpa at " . $this->dataFile['lowbarot'];
        $text .= $this->showRow( "Max average gust speed", $temp1, " ", "", $temp2, "" );


        $text .= "  
                        </div>
                    </div>
                </div>  <!-- End of todays page -->";
        //********************************************************************************************
        //*
        //*     Yesterdays extremes
        //*
        //********************************************************************************************
        $date = new DateTime();
        $date->sub( new DateInterval( 'P1D' ) );

        $text .= "           
                <div class='tab-pane fade' id='yesterday'>
                    <h3>Yesterday's Summary</h3>
                    <div class='readingDateTime'>Extremes on " . $date->format( 'l F j, Y' ) . "</div>
                    <div class='multi-column'> 
                        <div class='container-fluid'>";

        $temp1 = $this->dataFile['maxtempyest'] . "&deg;C at " . $this->dataFile['maxtempyestt'];
        $temp2 = $this->dataFile['mintempyest'] . "&deg;C at " . $this->dataFile['mintempyestt'];
        $text .= $this->showRow( "Max temperature", $temp1, " ", "Min temperature", $temp2, "" );

        $temp1 = $this->dataFile['maxdewyest'] . ";C at " . $this->dataFile['maxdewyestt'];
        $temp2 = $this->dataFile['mindewyest'] . ";C at " . $this->dataFile['mindewyestt'];
        $text .= $this->showRow( "Max dewpoint", $temp1, " ", "Min dewpoint", $temp2, "" );

        $temp1 = $this->dataFile['maxhumyest'] . "% at " . $this->dataFile['maxhumyestt'];
        $temp2 = $this->dataFile['minhumyest'] . "% at " . $this->dataFile['minhumyestt'];
        $text .= $this->showRow( "Max humidity", $temp1, " ", "Min humidity", $temp2, "" );

        $temp1 = $this->dataFile['maxbaroyest'] . "hpa at " . $this->dataFile['maxbaroyestt'];
        $temp2 = $this->dataFile['minbaroyest'] . "hpa at " . $this->dataFile['minbaroyestt'];
        $text .= $this->showRow( "Max barometer", $temp1, " ", "Min barometer", $temp2, "" );

        $temp1 = $this->dataFile['highsolaryest'] . "W/m2 at " . $this->dataFile['highsolaryesttime'];
        $temp2 = $this->dataFile['highuvyest'] . " at " . $this->dataFile['highuvyesttime'];
        $text .= $this->showRow( "Max Solar", $temp1, " ", "Max UV", $temp2, "" );

        $temp1 = $this->dataFile['maxgustyest'] . "  ";
        $temp2 = $this->dataFile['windrunyesterday'] . "";
        $text .= $this->showRow( "Max wind gust", $temp1, " ", "Wind run", $temp2, "" );

        $text .= $this->showRow( "Rainfall total", $this->dataFile['yesterdayrain'], "mm", "Average temperature", $this->dataFile['yesterdayavtemp'], "&deg;C" );

        $text .= $this->showRow( "Peak UV level", $this->dataFile['highuvyest'], " ", "at", $this->dataFile['highuvyesttime'], "" );

        $text .= "
                        </div>
                    </div>
                </div> <!-- End of yesterdays page -->";
        //********************************************************************************************
        //*
        //*     Daily extremes
        //*
        //********************************************************************************************
        $text .= "
                <div class='tab-pane fade' id='daily'>
                    <h3>Daily</h3>
                    <div class='readingDateTime'>Extremes on " . $date->format( 'l F j, Y' ) . "</div>
                    <div class='multi-column'> 
                        <div class='container-fluid'>
                        </div>    
                    </div>    
                </div>      
                ";
        //********************************************************************************************
        //*
        //*     This weeks extremes
        //*
        //********************************************************************************************
        $text .= "<div class='tab-pane fade' id='weekly'>
                    <h3>Weekly</h3>                    
                    <div class='readingDateTime'>Extremes on " . $date->format( 'l F j, Y' ) . "</div>
                    <div class='multi-column'> 
                        <div class='container-fluid'>
                        </div>    
                    </div>    
                </div>      
  ";
        //********************************************************************************************
        //*
        //*     This months extremes
        //*
        //********************************************************************************************
        $text .= "<div class='tab-pane fade' id='monthly'>
                    <h3>Monthly</h3>                    
                    <div class='readingDateTime'>Extremes on " . $date->format( 'l F j, Y' ) . "</div>
                    <div class='multi-column'> 
                        <div class='container-fluid'>
                        </div>    
                    </div>    
                </div>      
  ";
        //********************************************************************************************
        //*
        //*     This rears extremes
        //*
        //********************************************************************************************
        $text .= "<div class='tab-pane fade' id='yearly'>
                    <h3>Annual</h3>                    
                    <div class='readingDateTime'>Extremes on " . $date->format( 'l F j, Y' ) . "</div>
                    <div class='multi-column'> 
                        <div class='container-fluid'>
                        </div>    
                    </div>    
                </div>      
  ";
        //********************************************************************************************
        //*
        //*     All time extremes
        //*
        //********************************************************************************************
        $text .= "<div class='tab-pane fade' id='alltime'>
                    <h3>All Time Extremes</h3>                    <div class='readingDateTime'>Extremes on " . $date->format( 'l F j, Y' ) . "</div>
                    <div class='multi-column'> 
                        <div class='container-fluid'>
                        </div>    
                    </div>    
                </div>      
  
            </div>";
        return $text;
    }
}
