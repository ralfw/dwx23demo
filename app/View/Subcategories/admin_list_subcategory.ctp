<div class="row page-titles">
    <div class="col-md-5 align-self-center">
    <h3 class="text-themecolor"><?= $layoutTitle ?></h3>
    </div>
    <div class="col-md-7 align-self-center">
    <ol class="breadcrumb">
    <li><i class="fa fa-home"></i> <?php
    echo $this->Html->getCrumbs(' > ', array(
    'text' => 'Home ',
    'url' => array('controller' => 'users', 'action' => 'dashboard', 'admin' => true),
    'escape' => false
    ));
    ?> 
    </li>
    <?php echo "&nbsp > &nbsp" ?>
    <li><?php
    echo $this->Html->getCrumbs(' > ', array(
    'text' => ucfirst($categories[$cat_id]),
    'url' => array('controller' => 'categories', 'action' => 'listCategory', 'admin' => true),
    'escape' => false
    ));
    ?> 
    </li>
    <?php echo "&nbsp > &nbsp" ?>
    <li class="active"><?php echo  $layoutTitle ?></li>
    </ol>
    </div>
                
</div>
<div class="container-fluid">
<div class="row">
<div class="col-12">
                        <div class="card" >
                         <div class="card-body">
                         <h3>Category Info:</h3>
<table id="demo-foo-addrow" class="table m-t-30 table-hover contact-list footable-loaded footable" data-page-size="10">
<thead>
<tr>
 <th>Id</th>
<th>Image</th>
<th>Name (English)</th>
<th>Name (Arabic)</th>
<th>Name (Kurdish)</th>
</tr>
</thead>
<tbody>
<tr>
<td><?php echo $category_data['Category']['id'] ?></td>
<td><?php
                        $m = FULL_BASE_URL . $this->webroot . $category_data['Category']['image'];
                        $default = FULL_BASE_URL . $this->webroot . 'img/users/default.png';

                        if (!empty($category_data['Category']['image'])) {
                            $img = $this->Html->image($m, array('alt' => 'User Image', 'border' => '1',
                                'height' => '40', 'width' => '40',
                                'data-src' => 'holder.js/100%x100',
                                'class' => "img_display img-circle",
                                "data-title" => "Category"
                            ));
                            echo $img;
                        } else {
                            $img = $this->Html->image($default, array('alt' => 'default', 'border' => '1',
                                'height' => '40', 'width' => '40',
                                'data-src' => 'holder.js/100%x100',
                                'class' => "img_display img-circle",
                                "data-title" => ""
                            ));
                            echo $img;
                        }
                        ?></td>
<td><?php echo $category_data['Category']['name_en']; ?></td>
<td><?php echo $category_data['Category']['name_ar']; ?></td>
<td><?php echo $category_data['Category']['name_ku']; ?></td>
</tr>
</tbody>
</table>
</div></div></div>
</div>
                <div class="row">
                    <div class="col-12">
                        <div class="card" >
                         <div class="card-body">
                          <div class="row">
                         <div class="col-md-9">
                        <!--  <a href="<?php //echo FULL_BASE_URL.$this->webroot ?>admin/subcategories/addSubcategory/<?php //echo $cat_id ?>" class="button">Add Subcategory
                         </a> -->
                         <?php
                        echo $this->Html->link("<button type='button' class='btn waves-effect waves-light btn-info'>Add Subcategory</button>",  array(
                        'controller' => 'subcategories',
                        'action' => 'addSubcategory',
                        'page' => !empty($this->passedArgs['page']) ? $this->passedArgs['page'] : '1',
                        $cat_id, 'listSubcategory',
                        ), array('escape' => false));
                        ?>

                        <?php
                        echo $this->Html->link("<button type='button' class='btn waves-effect waves-light btn-info'>Edit Category</button>",  array(
                        'controller' => 'Categories',
                        'action' => 'editCategory',
                        'page' => !empty($this->passedArgs['page']) ? $this->passedArgs['page'] : '1',
                        $cat_id, 'listCategory',
                        ), array('escape' => false));
                        ?> 
                        <!--  -->


                         </div>



                         <input type="text" class="cat_val" value="<?php echo $cat_id; ?>" style="display:none;">
                         <div class="input-append col-md-3" style="float: right;">
                          <input type="text" name="data[q]" class="search-query myInput form-control" id="demo-input-search2" placeholder="Type to search">
                          </div> 
                          </div>
                           <div class="table-responsive" id="allDataUpdate">
                        <?= $this->element('list_subcategories'); ?>
                        </div></div>
                        </div>
                       
                       
                    </div>
                </div>
               
            </div>

<script type="text/javascript">
    $(function () {
  //setup before functions
  var cat_val = $('.cat_val').val();
  console.log(cat_val);
  var typingTimer;                //timer identifier
  var doneTypingInterval = 1000;  //time in ms, 5 second for example
  var $input = $('.myInput');

  //on keyup, start the countdown
  $input.on('keyup', function () {
      clearTimeout(typingTimer);
      typingTimer = setTimeout(doneTyping, doneTypingInterval);
  });

  //on keydown, clear the countdown
  $input.on('keydown', function () {
      clearTimeout(typingTimer);
  });


  function doneTyping() {
      var text = $('.myInput').val();
      $("#loading").fadeIn("slow");
      $.ajax({
    type: "GET",
    url: root + 'admin/subcategories/listSubcategory/'+cat_val+'/text:' + text,
    success: function (data) {
        $("#loading").fadeOut("slow");
        $('#allDataUpdate').html(data);
    },
    complete: function (e, t, settings) {
        if (e.status === 400 || t === 'timeout') {
      //  form_result.html(alertError('Timeout, please try again after sometime.'));
        }
    }
      });
  }
  ;
    });
</script>
