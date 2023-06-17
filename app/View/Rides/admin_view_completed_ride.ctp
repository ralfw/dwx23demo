<!-- Content Wrapper. Contains page content -->
<?php //pr ($rides);die; ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= $layoutTitle ?>
        </h1>
        <ol class="breadcrumb">
	    <li><i class="fa fa-home"></i> <?php
		echo $this->Html->getCrumbs(' > ', array(
		    'text' => 'Home',
		    'url' => array('controller' => 'users', 'action' => 'dashboard', 'admin' => true),
		    'escape' => false
		));
		?>  
	    </li>
             <?php if (in_array($rides['Ride']['status'],array(1,2,3,4,5,6))) { ?>
            <li> <?php
		echo $this->Html->getCrumbs(' > ', array(
		    'text' => 'Ongoing Ride List',
		    'url' => array('controller' => 'rides', 'action' => 'listOngoingRide', 'admin' => true),
		    'escape' => false
		));
		?>  
	    </li>
             <?php } else{ ?>
                  <li> <?php
		echo $this->Html->getCrumbs(' > ', array(
		    'text' => 'Past Ride List',
		    'url' => array('controller' => 'rides', 'action' => 'listCompletedRide', 'admin' => true),
		    'escape' => false
		));
		?>  
	    </li>
                 
         <?php    }?>
	    <li class="active"><?= $layoutTitle ?></li>
        </ol>
        
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="box box-primary">
            <?php echo $this->Session->flash(); ?>
            <div class="row">
                <div class="col-xs-12">
                    <?php echo $this->Form->create('rides', array('class' => 'horizontal-form form-validation', 'enctype' => 'multipart/form-data')); ?>
                    <div class="box-body">
                        
                        <div id="demo" class="collapse in" >
                            <div class="col-md-12">
                                <span>
                                    <h4>
                                        <b>
                                           User
                                            
                                        </b>
                                    </h4>
                                </span>
                            </div>
                            <div class="clearfix">
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Name
                                        </label>
                                        </br>
                                        <?php
                                        if (!empty($rides['User']['name'])) {
                                            echo ucfirst($rides['User']['name']);
                                        } else {
                                            echo "No record found";
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Phone
                                        </label>
                                        </br>
                                        <?php
                                        if (!empty($rides['User']['country_code'] . $rides['User']['phone'])) {
                                            echo  $rides['User']['country_code'] .'-'. $rides['User']['phone'];
                                        } else {
                                            echo "No record found";
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email
                                        </label>
                                        </br>
                                        <?php
                                        if (!empty($rides['User']['email'])) {
                                            echo $rides['User']['email'];
                                        } else {
                                            echo "No record found";
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix">
                            </div>
<!--                            <div class="col-md-12">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Image
                                        </label>
                                        </br>
                                        <?php
                                        $m = FULL_BASE_URL . $this->webroot . $rides['User']['image'];
                                        $default = FULL_BASE_URL . $this->webroot . 'img/users/default.png';
                                        //prx( $default);
                                        if (!empty($rides['User']['image'])) {
                                            $img = $this->Html->image($m, array('alt' => 'User Image', 'border' => '1',
                                                'height' => '100', 'width' => '120', 'data-src' => 'holder.js/100%x100'));
                                            echo $img;
                                        } else {
                                            $img = $this->Html->image($default, array('alt' => 'default', 'border' => '1',
                                                'height' => '60', 'width' => '60', 'data-src' => 'holder.js/100%x100'));
                                            echo $img;
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">licence Image
                                        </label>
                                        </br>
                                        <?php
                                        $m = FULL_BASE_URL . $this->webroot . $rides['User']['licence_image'];
                                        $default = FULL_BASE_URL . $this->webroot . 'img/users/default.png';
                                        //prx( $default);
                                        if (!empty($rides['User']['licence_image'])) {
                                            $img = $this->Html->image($m, array('alt' => 'User Image', 'border' => '1',
                                                'height' => '100', 'width' => '120', 'data-src' => 'holder.js/100%x100'));
                                            echo $img;
                                        } else {
                                            $img = $this->Html->image($default, array('alt' => 'default', 'border' => '1',
                                                'height' => '60', 'width' => '60', 'data-src' => 'holder.js/100%x100'));
                                            echo $img;
                                        }
                                        ?>
                                    </div>	
                                </div>

                            </div>-->

                            <div class="clearfix">
                            </div>
                            <div class="col-md-12">
                                <span>
                                    <h4>
                                        <b>
                                            Driver
                                           
                                        </b>
                                    </h4>
                                </span>
                            </div>

                            <div class="clearfix">
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Name
                                        </label>
                                        </br>
                                        <?php
                                        if (!empty($rides['Driver']['name'])) {
                                            echo ucfirst($rides['Driver']['name']);
                                        } else {
                                            echo "No record found";
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Phone
                                        </label>
                                        </br>
                                        <?php
                                        if (!empty($rides['Driver']['country_code'] . $rides['Driver']['phone'])) {
                                            echo $rides['Driver']['country_code'] .'-'.$rides['Driver']['phone'];
                                        } else {
                                            echo "No record found";
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email
                                        </label>
                                        </br>
                                        <?php
                                        if (!empty($rides['Driver']['email'])) {
                                            echo $rides['Driver']['email'];
                                        } else {
                                            echo "No record found";
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix">
                            </div>
<!--                            <div class="col-md-12">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Image
                                        </label>
                                        </br>
                                        <?php
                                        $m = FULL_BASE_URL . $this->webroot . $rides['Driver']['image'];
                                        $default = FULL_BASE_URL . $this->webroot . 'img/users/default.png';
                                        //prx( $default);
                                        if (!empty($rides['Driver']['image'])) {
                                            $img = $this->Html->image($m, array('alt' => 'Driver Image', 'border' => '1',
                                                'height' => '', 'width' => '120', 'data-src' => 'holder.js/100%x100'));
                                            echo $img;
                                        } else {
                                            $img = $this->Html->image($default, array('alt' => 'default', 'border' => '1',
                                                'height' => '60', 'width' => '60', 'data-src' => 'holder.js/100%x100'));
                                            echo $img;
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">licence Image
                                        </label>
                                        </br>
                                        <?php
                                        $m = FULL_BASE_URL . $this->webroot . $rides['Driver']['licence_image'];
                                        $default = FULL_BASE_URL . $this->webroot . 'img/users/default.png';
                                        //prx( $default);
                                        if (!empty($rides['Driver']['licence_image'])) {
                                            $img = $this->Html->image($m, array('alt' => 'Driver Image', 'border' => '1',
                                                'height' => '', 'width' => '120', 'data-src' => 'holder.js/100%x100'));
                                            echo $img;
                                        } else {
                                            $img = $this->Html->image($default, array('alt' => 'default', 'border' => '1',
                                                'height' => '60', 'width' => '60', 'data-src' => 'holder.js/100%x100'));
                                            echo $img;
                                        }
                                        ?>
                                    </div>	
                                </div>


                            </div>-->
                            <div class="clearfix">
                            </div>
                            <div class="col-md-12">
                                <span>
                                    <h4>
                                        <b>
                                            Ride
                                            
                                        </b>
                                    </h4>
                                </span>
                            </div>
                            <div class="clearfix">
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">From Location
                                        </label>
                                        </br>
                                        <?php
                                        if (!empty($rides['Ride']['s_loc'])) {
                                            echo $rides['Ride']['s_loc'];
                                        } else {
                                            echo "No record found";
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">To Location
                                        </label>
                                        </br>
                                        <?php
                                        if (!empty($rides['Ride']['d_loc'])) {
                                            echo $rides['Ride']['d_loc'];
                                        } else {
                                            echo "No record found";
                                        }
                                        ?>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Cash Amount
                                        </label>
                                        </br>
                                        <?php
                                        if (!empty($rides['Ride']['cash_amt'])) {
                                            echo $rides['Ride']['cash_amt'];
                                        } else {
                                            echo "No record found";
                                        }
                                        ?>
                                    </div>
                                </div>



                            </div>
                            <div class="col-md-12">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Wallet Amount
                                        </label>
                                        </br>
                                        <?php
                                        if (!empty($rides['Ride']['wallet_amt'])) {
                                            echo $rides['Ride']['wallet_amt'];
                                        } else {
                                            echo "No record found";
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Status
                                        </label>
                                        </br>
                                        <?php
                                       echo $rstatus = $ride_status[$rides['Ride']['status']];

                                        
                                        ?>
                                    </div>
                                </div>

                            </div>
                            <?php
                            if (!empty(($rides['Ride']['s_lat']) || ($rides['Ride']['s_lng']) || ($rides['Ride']['d_lat']) || ($rides['Ride']['d_lng']))) {
                                echo "<div class='col-md-12' id='map' style='width: 1300px; height: 600px;'></div>";
                            } else {
                                ?>
                                <style type="text/css">#map{
                                        display:none;
                                    }</style>  
                                <?php }
                                ?>
                        </div>

                    </div>
                    <!-- /.box-body -->
                    <!-- <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    </div> -->
                    <?php echo $this->Form->end(); ?>
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->



<?php //pr($rides); die;?>


<script>
    function initMap() {
        var chicago = {lat: <?php echo $rides['Ride']['s_lat']; ?>, lng: <?php echo $rides['Ride']['s_lng']; ?>};
        var indianapolis = {lat: <?php echo $rides['Ride']['d_lat']; ?>, lng: <?php echo $rides['Ride']['d_lng']; ?>};

        var mapOptions = {
            zoom: 8,
            center: {lat: <?php echo $rides['Ride']['s_lat']; ?>, lng: <?php echo $rides['Ride']['s_lng']; ?>}
        };

        map = new google.maps.Map(document.getElementById('map'),
                mapOptions);

        var directionsDisplay = new google.maps.DirectionsRenderer({
            map: map
        });

        // Set destination, origin and travel mode.
        var request = {
            destination: indianapolis,
            origin: chicago,
            travelMode: 'DRIVING'
        };
        // Pass the directions request to the directions service.
        var directionsService = new google.maps.DirectionsService();
        directionsService.route(request, function (response, status) {
            if (status == google.maps.DirectionsStatus.OK) {
                directionsDisplay.setDirections(response);
                new google.maps.DirectionsRenderer({
                    map: map,
                    directions: response,
                    suppressMarkers: true
                });
                var leg = response.routes[0].legs[0];
                marker = new google.maps.Marker({
                    position: leg.start_location,
                    map: map,
                    icon: {

                        size: new google.maps.Size(45, 45),

                    },
                    label: {
                        text: 'User',
                        fontWeight: 'bold',
                        flabelontSize: '12px',
                        fontFamily: 'italic bold 12px/30px Georgia, serif',
                        color: 'Black',
                        background:'White'
                       
                    }
                });
                marker = new google.maps.Marker({
                    position: leg.end_location,
                    map: map,
                    label: {
                        text: 'Driver',
                        fontWeight: 'bold',
                        fontSize: '12px',
                        fontFamily: 'italic bold 12px/30px Georgia, serif',
                        color: 'Black'
                       
                    }
                });
//                makeMarker(leg.start_location, icons.start, "title", map);
//		
//                makeMarker(leg.end_location, icons.end, 'title', map);

            } else {
                window.alert('Directions request failed due to ' + status);
            }
//            if (status == 'OK') {
//                // Display the route on the map.
//                directionsDisplay.setDirections(response);
//            }
        });


        /* var directionsService = new google.maps.DirectionsService;
         var directionsDisplay = new google.maps.DirectionsRenderer;
         var map = new google.maps.Map(document.getElementById('map'), {
         zoom: 7,
         center: {lat: -34.397, lng: 150.644}
         });
         directionsDisplay.setMap(map); */
    }
    /*   var marker = new google.maps.Marker({
     map: map,
     position: latlng,
     draggable: true,
     anchorPoint: new google.maps.Point(0, -29)
     }
     ); */

    function calculateAndDisplayRoute(directionsService, directionsDisplay) {
        directionsService.route({
            origin: "<?php echo $rides['Ride']['s_lat']; ?>", lng: "<?php echo $rides['Ride']['s_lng']; ?>",
            destination: "<?php echo $rides['Ride']['d_lat']; ?>", lng: "<?php echo $rides['Ride']['d_lng']; ?>",
            travelMode: 'DRIVING'
        }, function (response, status) {

            if (status == google.maps.DirectionsStatus.OK) {
                new google.maps.DirectionsRenderer({
                    map: map,
                    directions: response,
                    suppressMarkers: true
                });
                var leg = response.routes[0].legs[0];
                makeMarker(leg.start_location, icons.start, "title", map);
                var b = 'driver';
                makeMarker(leg.end_location, icons.end, 'title', map, labelContent.b);

            } else {
                window.alert('Directions request failed due to ' + status);
            }

//            if (status === 'OK') {
//                directionsDisplay.setDirections(response);
//            } else {
//               
//            }
        });
    }


</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBvRLSz0PoZuCebhg9qYyReworDJfLV41k&callback=initMap">
</script>

<style>
    /* Always set the map height explicitly to define the size of the div
     * element that contains the map. */
    #map {
        height: 100%;
    }
    /* Optional: Makes the sample page fill the window. */
    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
    }
    #floating-panel {
        position: absolute;
        top: 10px;
        left: 25%;
        z-index: 5;
        background-color: #fff;
        padding: 5px;
        border: 1px solid #999;
        text-align: center;
        font-family: 'Roboto','sans-serif';
        line-height: 30px;
        padding-left: 10px;
    }
</style>

