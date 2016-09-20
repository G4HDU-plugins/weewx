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
e107::js();
class weewx_charts extends weewx
{

    function makePage()
    {
        $this->getTestTags();
$chartPath=$this->prefs['weewx_chartpath'];
        //    print_a($this->dataFile);
        $text .= "
        <div id='myModal' class='modal fade' tabindex='-1' role='dialog'>
            <div class='modal-dialog'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <button type='button' class='close' data-dismiss='modal'>x</button>
                        <h3 class='modal-title'>Heading</h3>
                    </div>
                    <div class='modal-body'></div>
                    <div class='modal-footer'>
		              <button class='btn btn-default' data-dismiss='modal'>Close</button>
                    </div>
                </div>
            </div>
        </div>

        <ul class='nav nav-pills'>
            <li class='active'><a href='#daily' data-toggle='tab'>Daily</a></li>
            <li><a href='#weekly' data-toggle='tab'>Weekly</a></li>
            <li><a href='#monthly' data-toggle='tab'>Monthly</a></li>
            <li><a href='#yearly' data-toggle='tab'>Annual</a></li>
        </ul>
            
        <div class='tab-content'>
            <div class='tab-pane fade in active' id='daily'>
                <h3>Daily Chart</h3>
                <div class='readingDateTime'>Reading taken at {$this->dataFile['time']} on {$this->dataFile['date']}</div>
                <div class='multi-column'> 
                    <div class='container-fluid'>
                        <div class='row'>
      <div class='col-lg-4 col-sm-3 col-4'><a href='#' data-toggle='tooltip' title='Daily Barometer'><img src='{$chartPath}daybarometer.png' alt='Daily Barometer' class='thumbnail img-responsive'></a></div>
      <div class='col-lg-4 col-sm-3 col-4'><a href='#' data-toggle='tooltip' title='Daily Radiation'><img src='{$chartPath}dayradiation.png' alt='Daily Radiation' class='thumbnail img-responsive'></a></div>
      <div class='col-lg-4 col-sm-3 col-4'><a href='#' data-toggle='tooltip' title='Daily Rain'><img src='{$chartPath}dayrain.png' alt='Daily Rain' class='thumbnail img-responsive'></a></div>
      <div class='col-lg-4 col-sm-3 col-4'><a href='#' data-toggle='tooltip' title='Daily Rx'><img src='{$chartPath}dayrx.png' alt='Daily Rx' class='thumbnail img-responsive'></a></div>
      <div class='col-lg-4 col-sm-3 col-4'><a href='#' data-toggle='tooltip' title='Daily Wind Chill'><img src='{$chartPath}daytempchill.png' alt='Daily Wind Chill' class='thumbnail img-responsive'></a></div>
      <div class='col-lg-4 col-sm-3 col-4'><a href='#' data-toggle='tooltip' title='Daily Dewpoint'><img src='{$chartPath}daytempdew.png' alt='Daily Dewpoint' class='thumbnail img-responsive'></a></div>
      <div class='col-lg-4 col-sm-3 col-4'><a href='#' data-toggle='tooltip' title='Daily UV'><img src='{$chartPath}dayuv.png' alt='Daily UV' class='thumbnail img-responsive'></a></div>
      <div class='col-lg-4 col-sm-3 col-4'><a href='#' data-toggle='tooltip' title='Daily Windspeed'><img src='{$chartPath}daywind.png' alt='Daily Windspeed' class='thumbnail img-responsive'></a></div>
      <div class='col-lg-4 col-sm-3 col-4'><a href='#' data-toggle='tooltip' title='Daily Wind Direction'><img src='{$chartPath}daywinddir.png' alt='Daily Wind Direction' class='thumbnail img-responsive'></a></div>
      <div class='col-lg-4 col-sm-3 col-4'><a href='#' data-toggle='tooltip' title='Daily Wind Vector'><img src='{$chartPath}daywindvec.png' alt='Daily Wind Vector' class='thumbnail img-responsive'></a></div>
                        </div> <!-- End of row -->
                    </div> <!-- End of container-fluid -->    
                </div>  <!-- End of multi-column -->
            </div>  <!-- End of tab content daily page -->
        ";
        //********************************************************************************************
        //*
        //*     Todays extremes
        //*
        //********************************************************************************************
        $text .= "
            <div class='tab-pane fade in ' id='weekly'>
                <h3>Weekly Chart</h3>
                <div class='readingDateTime'>Reading taken at {$this->dataFile['time']} on {$this->dataFile['date']}</div>
                <div class='multi-column'> 
                    <div class='container-fluid'>
                        <div class='row'>                         
      <div class='col-lg-4 col-sm-3 col-4'><a href='#' data-toggle='tooltip' title='Weekly Barometer'><img src='{$chartPath}weekbarometer.png' alt='Weekly Barometer' class='thumbnail img-responsive'></a></div>
      <div class='col-lg-4 col-sm-3 col-4'><a href='#' data-toggle='tooltip' title='Weekly Radiation'><img src='{$chartPath}weekradiation.png' alt='Weekly Radiation' class='thumbnail img-responsive'></a></div>
      <div class='col-lg-4 col-sm-3 col-4'><a href='#' data-toggle='tooltip' title='Weekly Rain'><img src='{$chartPath}weekrain.png' alt='Weekly Rain' class='thumbnail img-responsive'></a></div>
      <div class='col-lg-4 col-sm-3 col-4'><a href='#' data-toggle='tooltip' title='Weekly Rx'><img src='{$chartPath}weekrx.png' alt='Weekly Rx' class='thumbnail img-responsive'></a></div>
      <div class='col-lg-4 col-sm-3 col-4'><a href='#' data-toggle='tooltip' title='Weekly Wind Chill'><img src='{$chartPath}weektempchill.png' alt='Weekly Wind Chill' class='thumbnail img-responsive'></a></div>
      <div class='col-lg-4 col-sm-3 col-4'><a href='#' data-toggle='tooltip' title='Weekly Dewpoint'><img src='{$chartPath}weektempdew.png' alt='Weekly Dewpoint' class='thumbnail img-responsive'></a></div>
      <div class='col-lg-4 col-sm-3 col-4'><a href='#' data-toggle='tooltip' title='Weekly UV'><img src='{$chartPath}weekuv.png' alt='Weekly UV' class='thumbnail img-responsive'></a></div>
      <div class='col-lg-4 col-sm-3 col-4'><a href='#' data-toggle='tooltip' title='Weekly Windspeed'><img src='{$chartPath}weekwind.png' alt='Weekly Windspeed' class='thumbnail img-responsive'></a></div>
      <div class='col-lg-4 col-sm-3 col-4'><a href='#' data-toggle='tooltip' title='Weekly Wind Direction'><img src='{$chartPath}weekwinddir.png' alt='Weekly Wind Direction' class='thumbnail img-responsive'></a></div>
      <div class='col-lg-4 col-sm-3 col-4'><a href='#' data-toggle='tooltip' title='Weekly Wind Vector'><img src='{$chartPath}weekwindvec.png' alt='Weekly Wind Vector' class='thumbnail img-responsive'></a></div>
                        </div> <!-- End of row -->
                    </div> <!-- End of container-fluid -->    
                </div>  <!-- End of multi-column -->
            </div>  <!-- End of tab content weekly page -->
             ";
        //********************************************************************************************
        //*
        //*     Yesterdays extremes
        //*
        //********************************************************************************************
        $date = new DateTime();
        $date->sub( new DateInterval( 'P1D' ) );

        $text .= "           
            <div class='tab-pane fade in ' id='monthly'>
                <h3>Monthly Chart</h3>
                <div class='readingDateTime'>Reading taken at {$this->dataFile['time']} on {$this->dataFile['date']}</div>
                <div class='multi-column'> 
                    <div class='container-fluid'>
                        <div class='row'>
      <div class='col-lg-4 col-sm-3 col-4'><a href='#' data-toggle='tooltip' title='Monthly Barometer'><img src='{$chartPath}monthbarometer.png' alt='Monthly Barometer' class='thumbnail img-responsive'></a></div>
      <div class='col-lg-4 col-sm-3 col-4'><a href='#' data-toggle='tooltip' title='Monthly Radiation'><img src='{$chartPath}monthradiation.png' alt='Monthly Radiation' class='thumbnail img-responsive'></a></div>
      <div class='col-lg-4 col-sm-3 col-4'><a href='#' data-toggle='tooltip' title='Monthly Rain'><img src='{$chartPath}monthrain.png' alt='Monthly Rain' class='thumbnail img-responsive'></a></div>
      <div class='col-lg-4 col-sm-3 col-4'><a href='#' data-toggle='tooltip' title='Monthly Rx'><img src='{$chartPath}monthrx.png' alt='Monthly Rx' class='thumbnail img-responsive'></a></div>
      <div class='col-lg-4 col-sm-3 col-4'><a href='#' data-toggle='tooltip' title='Monthly Wind Chill'><img src='{$chartPath}monthtempchill.png' alt='Monthly Wind Chill' class='thumbnail img-responsive'></a></div>
      <div class='col-lg-4 col-sm-3 col-4'><a href='#' data-toggle='tooltip' title='Monthly Dewpoint'><img src='{$chartPath}monthtempdew.png' alt='Monthly Dewpoint' class='thumbnail img-responsive'></a></div>
      <div class='col-lg-4 col-sm-3 col-4'><a href='#' data-toggle='tooltip' title='Monthly UV'><img src='{$chartPath}monthuv.png' alt='Monthly UV' class='thumbnail img-responsive'></a></div>
      <div class='col-lg-4 col-sm-3 col-4'><a href='#' data-toggle='tooltip' title='Monthly Windspeed'><img src='{$chartPath}monthwind.png' alt='Monthly Windspeed' class='thumbnail img-responsive'></a></div>
      <div class='col-lg-4 col-sm-3 col-4'><a href='#' data-toggle='tooltip' title='Monthly Wind Direction'><img src='{$chartPath}monthwinddir.png' alt='Monthly Wind Direction' class='thumbnail img-responsive'></a></div>
      <div class='col-lg-4 col-sm-3 col-4'><a href='#' data-toggle='tooltip' title='Monthly Wind Vector'><img src='{$chartPath}monthwindvec.png' alt='Monthly Wind Vector' class='thumbnail img-responsive'></a></div>
                        </div> <!-- End of row -->
                    </div> <!-- End of container-fluid -->    
                </div>  <!-- End of multi-column -->
            </div>  <!-- End of tab content monthly page -->";

        //********************************************************************************************
        //*
        //*     Daily extremes
        //*
        //********************************************************************************************
        $text .= "
 
            <div class='tab-pane fade in ' id='yearly'>
                <h3>Annual Chart</h3>
                <div class='readingDateTime'>Reading taken at {$this->dataFile['time']} on {$this->dataFile['date']}</div>
                <div class='multi-column'> 
                    <div class='container-fluid'>
                        <div class='row'>
      <div class='col-lg-4 col-sm-3 col-4'><a href='#' data-toggle='tooltip' title='Annual Barometer'><img src='{$chartPath}yearbarometer.png' alt='Annual Barometer' class='thumbnail img-responsive'></a></div>
      <div class='col-lg-4 col-sm-3 col-4'><a href='#' data-toggle='tooltip' title='Annual Radiation'><img src='{$chartPath}yearradiation.png' alt='Annual Radiation' class='thumbnail img-responsive'></a></div>
      <div class='col-lg-4 col-sm-3 col-4'><a href='#' data-toggle='tooltip' title='Annual Rain'><img src='{$chartPath}yearrain.png' alt='Annual Rain' class='thumbnail img-responsive'></a></div>
      <div class='col-lg-4 col-sm-3 col-4'><a href='#' data-toggle='tooltip' title='Annual Rx'><img src='{$chartPath}yearrx.png' alt='Annual Rx' class='thumbnail img-responsive'></a></div>
      <div class='col-lg-4 col-sm-3 col-4'><a href='#' data-toggle='tooltip' title='Annual Wind Chill'><img src='{$chartPath}yeartempchill.png' alt='Annual Wind Chill' class='thumbnail img-responsive'></a></div>
      <div class='col-lg-4 col-sm-3 col-4'><a href='#' data-toggle='tooltip' title='Annual Dewpoint'><img src='{$chartPath}yeartempdew.png' alt='Annual Dewpoint' class='thumbnail img-responsive'></a></div>
      <div class='col-lg-4 col-sm-3 col-4'><a href='#' data-toggle='tooltip' title='Annual UV'><img src='{$chartPath}yearuv.png' alt='Annual UV' class='thumbnail img-responsive'></a></div>
      <div class='col-lg-4 col-sm-3 col-4'><a href='#' data-toggle='tooltip' title='Annual Windspeed'><img src='{$chartPath}yearwind.png' alt='Annual Windspeed' class='thumbnail img-responsive'></a></div>
      <div class='col-lg-4 col-sm-3 col-4'><a href='#' data-toggle='tooltip' title='Annual Wind Direction'><img src='{$chartPath}yearwinddir.png' alt='Annual Wind Direction' class='thumbnail img-responsive'></a></div>
      <div class='col-lg-4 col-sm-3 col-4'><a href='#' data-toggle='tooltip' title='Annual Wind Vector'><img src='{$chartPath}yearwindvec.png' alt='Annual Wind Vector' class='thumbnail img-responsive'></a></div>
                        </div> <!-- End of row -->
                    </div> <!-- End of container-fluid -->    
                </div>  <!-- End of multi-column -->
            </div>  <!-- End of tab content annual page -->";
                $text .= "
      </div> <!-- End of tab content -->";
        return $text;
    }
}
