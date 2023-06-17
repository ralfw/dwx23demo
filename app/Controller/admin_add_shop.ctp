<div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor"><?php echo $layoutTitle; ?></h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <i class="fa fa-home"></i> 
                    <?php
                    echo $this->Html->getCrumbs(' > ', array(
                    'text' => 'Home',
                    'url' => array('controller' => 'users', 'action' => 'dashboard', 'admin' => true),
                    'escape' => false
                    ));
                    ?>  
                    </li>

                     <li class="breadcrumb-item">
                     
                    <?php echo $layoutTitle; ?>
                    
                    </li>
                    </ol>
                </div>
            </div>
 <div class="container-fluid">

              



                <!-- Row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-outline-info">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white">Shop Detail</h4>
                            </div>
                            <div class="card-body">
                            <?php
                            echo $this->Form->create('Shop', array('class' => 'horizontal-form form-validation','enctype' => 'multipart/form-data', 'novalidate'));
                            ?>
                                    <div class="form-body">
                                      <div class="row">
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label>Select category</label>
                                      <?php
                                     echo $this->form->input('cat_id',array('label'=>false,'type'=>'select','options'=>$category,'empty'=>'Select category','class'=>'form-control','required' => true));
                                      ?>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label>Select subcategory</label>
                                      <?php
                                     echo $this->form->input('Shop.sub_cat',array('label'=>false,'type'=>'select','options'=>$subcategory,'empty'=>'Select subcategory','class'=>'form-control','required' => true));
                                      ?>
                                  </div>
                              </div>

                          </div>
                          <div class="row">
                        <div class="col-md-6">
                        <div class="form-group">
                        <label>Select shop provider</label>
                        <?php
                        echo $this->form->input('Shop.user_id',array('label'=>false,'type'=>'select','options'=>$provider,'empty'=>'Select provider','class'=>'form-control','required' => true));
                        ?>
                        </div>
                        </div> 
                     <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Select Services</label>
                        <?php 
                        echo $this->Form->input('service_id', 
                        array('label' => false, 
                        'multiple' => 'multiple', 
                        'class' => 'ingre form-control',
                        'empty'=>'select services',
                        'options' => $service, 
                        )); ?>
                         
                      </div>
                    </div>                                      

</div>

<h3 class="box-title m-t-40">Shop Info</h3>
                                        <hr>
                                       <div class="row">
                                          <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Shop name (English)</label>
                                                    <?php
                                                    echo $this->form->input('Shop.name_en',
                                                    array('label'=>false,
                                                    'class'=>'form-control'))
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Shop name (Arabic)</label>
                                                    <?php
                                                    echo $this->form->input('Shop.name_ar',
                                                    array('label'=>false,
                                                    'class'=>'form-control', 'required'))
                                                    ?>
                                                </div>
                                            </div>
                                          </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Shop name (Kurdish)</label>
                                                    <?php
                                                    echo $this->form->input('Shop.name_ku',
                                                    array('label'=>false,
                                                    'class'=>'form-control'))
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Website url</label>
                                                    <?php
                                                    echo $this->form->input('Shop.website',
                                                    array('label'=>false,
                                                    'class'=>'form-control'))
                                                    ?>
                                                </div>
                                            </div>
                                           
                                            

                                        </div>
                                        
                                        <div class="row">
                                            
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Shop image</label>
                                                    <?php 
                                                    echo $this->Form->input('image', array('type' => 'file', 
                                                    'label' => false, 'class' => 'form-control file', 
                                                    'accept' => "image/x-png,image/gif,image/jpeg", 'required' => false)); 
                                                    ?>

                                                </div>
                                            </div>
                                             <div class="col-md-6">
                                                <div class="form-group">
                                                <label>Recommend</label>
                                                <div class="checkbox">
                                                <!--<input type="checkbox" name="promotion_type_old" id="gender" checked />-->
                                                <label class="switch">
                                                <input type="checkbox" name="data[Shop][recommend]" id="gender" checked />
                                                <span class="slider round1"></span>
                                                </label>
                                                </div>
                                            <?php
                                            echo $this->Form->hidden('recommend', array(
                                            'label' => false,
                                            'placeholder' => 'Enter Title',
                                            'id' => 'hidden_gender',
                                            'value' => '1'));
                                            ?>

                                                </div>
                                            </div>

                                        </div>

                                        
                                        </div>
                                        <!--/row-->

                                        <h3 class="box-title m-t-40">Description</h3>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Description (English)</label>
                                                    <?= $this->Form->input('Shop.desc_en', ['type' => 'textarea', 'label' => false, 'escape' => false,'class' =>'form-control', 'rows' => '4']); ?>
                                                </div>
                                            </div>
                                        
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                     <label>Description (Arabic)</label>
                                                      <?= $this->Form->input('Shop.desc_ar', ['type' => 'textarea', 'label' => false, 'escape' => false,'class' =>'form-control', 'rows' => '4']); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                     <label>Description (Kurdish)</label>
                                                     <?= $this->Form->input('Shop.desc_ku', ['type' => 'textarea', 'label' => false, 'escape' => false,'class' =>'form-control', 'rows' => '4']); ?>
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                              
                                            </div>
                                            <!--/span-->
                                        </div>

                                        <!--Contact info start-->
                                        <h3 class="box-title m-t-40">Contact Info</h3>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Phone 1</label>
                                                    <?php echo $this->form->input('Shop.phone1', array('label'=>false,'class'=>'form-control'))
                                                    ?>
                                                </div>
                                            </div>
                                        
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Phone 2</label>
                                                     <?php echo $this->form->input('Shop.phone2', array('label'=>false,'class'=>'form-control'))
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Phone 3</label>
                                                    <?php echo $this->form->input('Shop.phone3', array('label'=>false,'class'=>'form-control'))
                                                    ?>
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                              <div class="form-group">
                                              <label>Email</label>
                                              <?php echo $this->form->input('Shop.email', array('label'=>false,'class'=>'form-control'))
                                                    ?>
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>

                                        
                                       

                                         <h3 class="box-title m-t-40">Social media</h3>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Facebook</label>
                                                    <?php echo $this->form->input('Shop.facebook', array('label'=>false,'class'=>'form-control'))
                                                    ?>
                                                </div>
                                            </div>
                                        
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Twitter</label>
                                                     <?php echo $this->form->input('Shop.twitter', array('label'=>false,'class'=>'form-control'))
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Snapchat</label>
                                                    <?php echo $this->form->input('Shop.snapchat', array('label'=>false,'class'=>'form-control'))
                                                    ?>
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                              <div class="form-group">
                                              <label>Instagram</label>
                                              <?php echo $this->form->input('Shop.instagram', array('label'=>false,'class'=>'form-control'))
                                                    ?>
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>

                                          <!--/address here-->

                                          <h3 class="box-title m-t-40">Address</h3>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-12 ">
                                                <div class="form-group">
                                                    <label>Formal Address (English)</label>
                                                     <?= $this->Form->input('address_en', ['type' => 'textarea', 'label' => false, 'escape' => false,'class' =>'form-control', 'rows' => '4']); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Formal Address (Arabic)</label>
                                                     <?= $this->Form->input('address_ar', ['type' => 'textarea', 'label' => false, 'escape' => false,'class' =>'form-control', 'rows' => '4']); ?>
                                                </div>
                                            </div>
                                        
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Formal Address (Kurdish)</label>
                                                     <?= $this->Form->input('address_ku', ['type' => 'textarea', 'label' => false, 'escape' => false,'class' =>'form-control', 'rows' => '4']); ?>
                                                </div>
                                            </div>
                                        </div>

                                       
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Latitude</label>
                                                    <?php
                                                    echo $this->form->input('Shop.lat',
                                                    array('label'=>false,
                                                      'id'=>'lat',
                                                    'class'=>'form-control'))
                                                    ?>
                                             </div>

                                            </div>
                                            <!--/span-->
                                          <div class="col-md-6">
                                              <div class="form-group">
                                              <label>Longitude</label>
                                              <?php echo $this->form->input('Shop.lng', array('label'=>false,'id'=>'lng','class'=>'form-control'))
                                                    ?>
                                              </div>
                                          </div>
                                          
                                          
                                          </div>
                                          
                                          <div id="map"></div> <br/> 
                                         <div class="form-actions">
                                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                                       
                                    </div>
                                    </div>
                                     </div>
                                    </div>
                                    
                               <?php echo $this->Form->end(); ?>
                            </div>
                        </div>
                    </div>
                </div>

               
<script type="text/javascript" src="//maps.googleapis.com/maps/api/js?key=AIzaSyB6y9gHV5gMmUW28iFyAdaybxkTru3Z5cE"></script>

<script type="text/javascript">
$("#lng").keyup(function(){
   showMap();
});

$("#lat").keyup(function(){
   showMap();
});

function showMap(){
  var lat =  document.getElementById('lat').value;
  var lng = document.getElementById('lng').value;
  if(lat != '' && lng!=''){
     var latlng = new google.maps.LatLng(lat,lng);
  //  console.log(latlng);
     var map = new google.maps.Map(document.getElementById('map'), {
      center: latlng,
      zoom: 13
    });
    var marker = new google.maps.Marker({
      map: map,
      position: latlng,
      draggable: false,
      anchorPoint: new google.maps.Point(0, -29)
   });
    var infowindow = new google.maps.InfoWindow();   
    google.maps.event.addListener(marker, 'click', function() {
      var iwContent = '<div id="iw_container">' +
      '<div class="iw_title"><b>Location</b></div></div>';
      // including content to the infowindow
      infowindow.setContent(iwContent);
      // opening the infowindow in the current map and at the current marker location
      infowindow.open(map, marker);
    });
    $('#map').css({"width": "100%", "height": "300px"});
  
  } else{
     $('#map').css({"width": "0", "height": "0"});
  }
  
}
</script>

<script>
    /*car make and model dropdown*/
   // $('#UserCarmakeId').bind('change', function () {
    $('#ShopCatId').change(function () {
        var carid = $(this).val();
        console.log(carid);
        $.ajax({
            type: 'POST',
            url: '<?= Router::url('/', true) . 'admin/shops/getsubcategory/'; ?>' + carid,
            success: function (data) {
                $("#ShopSubCatId").html('');
                $("#ShopSubCatId").html(data);
            }
        }
        );
    }
    );
</script>
<script type="text/javascript">
    $('#gender').change(function () {
        if ($(this).prop('checked'))
        {
            $('#hidden_gender').val('1');
        } else
        {
            $('#hidden_gender').val('0');
        }
    });
</script>
<script>
    $(document).ready(function () {
        $('.select2').select2({
            placeholder: 'Select Services'}
        );
        $('.ingre').select2({
            placeholder: 'Select Services'}
        );
        $("#checkbox").click(function () {
            //if($("#checkbox").is(':checked') ){
            $(".ingre > option").prop("selected", "selected");
            $(".ingre").trigger("change");
            //  }
            // else{
            //     $(".ingre > option").removeAttr("selected");
            //      $(".ingre").trigger("change");
            //  }
        }
        );
    }
    );
</script>
<style>
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #333 !important;
        border: 1px solid #333 !important;
        border-radius: 4px;
        cursor: default;
        float: left;
        margin-right: 5px;
        margin-top: 5px;
        padding: 0 5px;
    }
</style>
<style>
    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    .switch input {display:none;}

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked + .slider {
        background-color: #2196F3;
    }

    input:focus + .slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked + .slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round1 {
        border-radius: 34px;
    }

    .slider.round1:before {
        border-radius: 50%;
    }
</style>

