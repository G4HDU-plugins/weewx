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
include_lan( e_PLUGIN . 'weewx/languages/' . e_LANGUAGE . '_weewx.php' );

require_once( e_PLUGIN . 'weewx/handlers/weewx_class.php' );
class weewx_menu extends weewx
{
    function getForecast()
    {
        $json_string = file_get_contents( "http://api.wunderground.com/api/4e3ceda17ba386b2/geolookup/forecast/q/53.515227,-2.936043.json" );
        $this->parsed_json = json_decode( $json_string );

        $retval = '
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="headingOne">
            <h4 class="panel-title">
                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">';
        $retval .= $this->getForecastDayname( 0 );
        $retval .= '</a>
            </h4>
        </div>
        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
            <div class="panel-body">';
        $retval .= $this->getDayForecast( 0 );
        $retval .= $this->getDayForecast( 1 );
        $retval .= ' 
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="headingTwo">
            <h4 class="panel-title">
                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          ';
        $retval .= $this->getForecastDayname( 2 );
        $retval .= '
                </a>
            </h4>
        </div>
        <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
            <div class="panel-body">';
        $retval .= $this->getDayForecast( 2 );
        $retval .= $this->getDayForecast( 3 );
        $retval .= ' 
            </div>
        </div>
  </div>
  <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="headingThree">
            <h4 class="panel-title">
                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    ';
        $retval .= $this->getForecastDayname( 4 );
        $retval .= '
                </a>
            </h4>
        </div>
        <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
            <div class="panel-body">';
        $retval .= $this->getDayForecast( 4 );
        $retval .= $this->getDayForecast( 5 );
        $retval .= ' 
            </div>
        </div>
  </div>
  <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="headingFour">
            <h4 class="panel-title">
                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                    ';
        $retval .= $this->getForecastDayname( 6 );
        $retval .= '
                </a>
            </h4>
        </div>
        <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
            <div class="panel-body">';
        $retval .= $this->getDayForecast( 6 );
        $retval .= $this->getDayForecast( 7 );
        $retval .= ' 
            </div>
        </div>
  </div>
</div>
<span class="weewxForecastFooter">
Forecast information from <a href="https://www.wunderground.com/?ID=IMAGHULL3">Wunderground</a> at ' . $this->getForecastTime() . '
</span>';

        return $retval;
    }
    function getForecastTime()
    {
        // error_reporting(E_ALL);
        return $this->parsed_json->{'forecast'}->{'txt_forecast'}->{'date'};
    }
    function getForecastDayname( $period )
    {
        error_reporting( E_ALL );
        return $this->parsed_json->{'forecast'}->{'txt_forecast'}->{'forecastday'}[$period]->{'title'};
    }
    function getDayForecast( $period )
    {
        $day = $this->parsed_json->{'forecast'}->{'txt_forecast'}->{'forecastday'}[$period]->{'title'};
        $text = $this->parsed_json->{'forecast'}->{'txt_forecast'}->{'forecastday'}[$period]->{'fcttext_metric'};
        $iconName = $this->parsed_json->{'forecast'}->{'txt_forecast'}->{'forecastday'}[$period]->{'icon'};
        $iconurl = $this->parsed_json->{'forecast'}->{'txt_forecast'}->{'forecastday'}[$period]->{'icon_url'};
        $retval = "
<div class='weewxForecastLeft' >{$day}</div>
<div style='float:right;' ><img src='{$iconurl}' alt='{$$iconName}' title='{$$iconName}' style='height:40px;width:40px;' /></div>
<div style='clear:both'></div>
<div style='font-size:.9em;'>{$text}</div>";

        return $retval;
    }
    function getAlmanac()
    {
        $this->getTestTags();
        $bgst = $this->getGMTChange();
        //print_a($this->dataFile);
        $retval .= '
<div class="weewxCurrentHead">
    <h4>Almanac</h4>
    <h5>' . $this->dataFile["dayname"] . ' ' . $this->dataFile["monthname"] . ' ' . $this->dataFile['date_day'] . ' ' . $this->dataFile['date_year'] .
            ' at ' . $this->dataFile["time"] . '
    </h5>
</div>
<div class="panel-group" id="accordionAlmanac" role="tablist" aria-multiselectable="true">
    <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="headingAlmanacOne">
            <h4 class="panel-title">
                <a role="button" data-toggle="collapse" data-parent="#accordionAlmanac" href="#collapseAlmanacOne" aria-expanded="true" aria-controls="collapseOne">Solar</a>
            </h4>
        </div>
        <div id="collapseAlmanacOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingAlmanacOne">
            <div class="panel-body">
                <ul>
                    <li>Sunrise ' . $this->dataFile['sunrise'] . '</li>
                    <li>Sunset ' . $this->dataFile['sunset'] . '</li>
                    <li>Possible hours of daylight ' . $this->dataFile['hoursofpossibledaylight'] . '</li>
                    <li>Next solar Eclipse ' . $this->dataFile['suneclipse'] . '</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="headingAlmanacTwo">
            <h4 class="panel-title">
                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordionAlmanac" href="#collapseAlmanacTwo" aria-expanded="false" aria-controls="collapseTwo">Lunar</a>
            </h4>
        </div>
        <div id="collapseAlmanacTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingAlmanacTwo">
            <div class="panel-body">
                <ul>                      
                    <li>Moon phase ' . $this->dataFile['moonphasename'] . '</li>
                    <li>Moon phase ' . $this->dataFile['moonphase'] . '</li>
                    <li>Moon next eclipse ' . $this->dataFile['mooneclipse'] . '</li>
                    <li>Moon Perihelion ' . $this->dataFile['moonperihel'] . '</li>
                    <li>Moon Perigee ' . $this->dataFile['moonperigee'] . '</li>
                    <li>Moon Apogee ' . $this->dataFile['moonapogee'] . '</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="headingAlmanacThree">
            <h4 class="panel-title">
                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordionAlmanac" href="#collapseAlmanacThree" aria-expanded="false" aria-controls="collapseAlmanacThree">Station</a>
            </h4>
        </div>
        <div id="collapseAlmanacThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingAlmanacThree">
            <div class="panel-body">
                <ul>
                    <li>Altitude ' . $this->dataFile['stationaltitude'] . '</li>
                    <li>Latitude ' . $this->dataFile['stationlatitude'] . '</li>
                    <li>Longitude ' . $this->dataFile['stationlongitude'] . '</li>
                    <li>Software Version ' . $this->dataFile['swversiononly'] . '</li>
                    <li>Server Uptime ' . $this->dataFile['windowsuptime'] . '</li>
                    <li>Software Started ' . $this->dataFile['Startimedate'] . '</li>
                </ul> 
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="headingAlmanacFour">
            <h4 class="panel-title">
                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordionAlmanac" href="#collapseAlmanacFour" aria-expanded="false" aria-controls="collapseAlmanacFour">Dates</a>
            </h4>
        </div>
        <div id="collapseAlmanacFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingAlmanacFour">
            <div class="panel-body">
                <ul>
                    <li>' . $bgst['0'] . '</li>
                    <li>' . $bgst['1'] . '</li>
                    <li>Easter ' . $this->dataFile['easterdate'] . '</li>
                    <li>Chinese New Year ' . $this->dataFile['chinesenewyear'] . '</li>
                </ul>   
            </div>
        </div>
    </div>
</div>
';

        return $retval;
    }
    function getGMTChange()
    {
        $year = date( 'Y' );
        $month = date( 'n' );
        if ( $month >= 4 )
        {
            $springYear = $year + 1;

        } else
        {
            $springYear = $year;
        }
        if ( $month >= 11 )
        {
            $autumnYear = $year + 1;

        } else
        {
            $autumnYear = $year;
        }
        $tsLast = strtotime( $autumnYear . '-11-01 last sunday' );
        $gmt = "GMT starts " . date( 'j M Y', $tsLast ) . "@ 02:00";
        $tsLast = strtotime( $springYear . '-04-01 last sunday' ) . " @ 02:00";
        $bst = "BST starts " . date( 'j M Y', $tsLast ) . " @ 02:00";
        if ( $month >= 4 && $month < 11 )
        {
            $retval[0] = $gmt;
            $retval[1] = $bst;
        } elseif ( $month >= 11 || $month < 4 )
        {
            $retval[0] = $bst;
            $retval[1] = $gmt;

        }
        return $retval;
    }
    function getCurrent()
    {
        $this->getTestTags();
        // var_dump($this->dataFile);
        $text .= "<div class='weewxCurrentHead'><h4>Weather Station readings</h4><h5>{$this->dataFile['dayname']} {$this->dataFile['monthname']} {$this->dataFile['date_day']},
         {$this->dataFile['date_year']} at {$this->dataFile['time']}</h5></div>";
        $text .= '<ul>';
        if ( $this->prefs['weewx_showtemp'] )
        {
            $text .= "<li>Temperature {$this->dataFile['temperature']} &deg;C</li>";
        }
        if ( $this->prefs['weewx_showhum'] )
        {
            $text .= "<li>Humidity {$this->dataFile['humidity']} %</li>";
        }
        if ( $this->prefs['weewx_showfeels'] )
        {
            $text .= "<li>Feels like {$this->dataFile['feelslike']} &deg;C</li>";
        }
        if ( $this->prefs['weewx_showwind'] )
        {
            $text .= "<li>Wind {$this->dataFile['avgspd']} km/h gusting to {$this->dataFile['gstspd']} km/h</li>";
        }
        if ( $this->prefs['weewx_showdirn'] )
        {
            $text .= "<li>The wind is from {$this->dataFile['dirlabel']} ({$this->dataFile['dirdeg']}&deg;)</li>
            <li>Beaufort {$this->dataFile['currbftspeed']} - {$this->dataFile['bftspeedtext']}</li>";
        }
        if ( $this->prefs['weewx_showbaro'] )
        {
            $text .= "<li>The pressure is {$this->dataFile['baro']} hPa.</li><li>Trend {$this->dataFile['pressuretrendname']} {$this->dataFile['trend']} hPa/h</li>";
        }
        if ( $this->prefs['weewx_showrain'] )
        {
            $text .= "<li>We have had {$this->dataFile['dayrn']} mm rain today</li>";
        }
        if ( $this->prefs['weewx_showuv'] )
        {
            $text .= "<li>UV level is {$this->dataFile['VPuv']}</li>";
        }
        $text .= "</ul>";

        return $text;
    }
}
