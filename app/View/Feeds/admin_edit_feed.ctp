<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?=$layoutTitle?>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="box box-primary">
            <?php echo $this->Session->flash(); ?>
        <div class="row">
            <div class="col-xs-6">
                <?php  echo $this->Form->create('Feed', array('class'=>'horizontal-form form-validation','enctype'=>'multipart/form-data')); ?>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Title</label>
                            <?php echo $this->Form->input('title',array('label'=>false,'placeholder'=>'Enter name','class'=>'form-control')); ?>
                        </div>
							

                         <div class="form-group">
                            <label for="exampleInputEmail1">Description</label>
                            <?php echo $this->Form->input('description',array('label'=>false,'type' => 'textarea','placeholder'=>'Enter Description','class'=>'form-control')); ?>
                        </div>
								
								<div class="form-group">
									
								 <?php 
								 
								 
								 $images = explode(',',$this->request->data['Feed']['image']);
								 
								 //pr($this->request->data['Feed']['image']); ?>
								
                            <label for="exampleInputEmail1">Feed Images</label>
								<div id="filediv">
								<p><?=__('Select images')?></p>
								<?php //$temp = explode(',',$this->request->data['Feed']['image']);

								foreach($images as $image){

								?>
								<div cl-imng="<?php echo $image?>" id-img="<?=$this->request->data['Feed']['image']?>" >
								<img src="<?php echo $this->webroot.$image;  ?>" style="height:100px;width:100px;" >
								
								<img src ="<?php echo FULL_BASE_URL.$this->webroot.'img/x.png'?>" class="remove-img"/>
								<input type="hidden" name="data[Feed][mage][]" value="<?=$image?>">
								</div>
							<?php
							}
							?>
						</div><br/>

						<input type="button" id="add_more" class="upload" value="Add More Files"/>
									
							<br/> 	
							<p><?=__('Select multiples images for Feed')?></p>
							</div>
							
								<div class="form-group">
                            <label class="control-label">Add Video</label>
                            <?php echo $this->Form->input('video',array('type'=>'file','label'=>false,'class'=>'form-control')); ?>
									 <input type="hidden"value = "<?php echo $this->request->data['Feed']['video']; ?>"name="data[Feed][videos]">
									 
									  <a href = "<?php echo FULL_BASE_URL.$this->webroot.$this->request->data['Feed']['video']; ?>"target="_blank">Video</a>
				                    
                        </div>
								
								<div class="form-group"> 
                            <label class="control-label">Video Image</label>
                            <?php echo $this->Form->input('video_thumbnail',array('type'=>'file','label'=>false,'class'=>'form-control')); ?>
									 <input type="hidden"value = "<?php echo $this->request->data['Feed']['video_thumbnail']; ?>" name="data[Feed][oldImages]">
									 <a href = "<?php echo FULL_BASE_URL.$this->webroot.$this->request->data['Feed']['video_thumbnail']; ?>"target="_blank">image</a>
				                    <p>Thumbnail image size must be less than 2 MB.</p>
                        </div>
								
					
                            <?php
                            $status = array('Disable','Enable');
                            echo $this->Form->input('status',array('label'=>false,'placeholder'=>'','class'=>'form-control','options'=> $status,'empty'=> '--Select--')); ?>
                        </div>
								
								
								<div class="box-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                <?php echo $this->Form->end(); ?>
                    </div>
                    <!-- /.box-body -->
                   
                </div>
                    <!-- /.box -->
            </div>
        </div>
    </section>
    <!-- /.content -->


<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script>
<script>
var abc = 0; //Declaring and defining global increement variable

$(document).ready(function() {

//To add new input file field dynamically, on click of "Add More Files" button below function will be executed
    $('#add_more').click(function() {
        $(this).before($("<div/>", {id: 'filediv'}).fadeIn('slow').append(
                $("<input/>", {name: 'data[Feed][images][]', type: 'file', class: 'form-control file',accept:'image/x-png,image/gif,image/jpeg'}),
                $("<br/><br/>")
                ));
    });

//following function will executes on change event of file input to select different file
$('body').on('change', '.file', function(){
            if (this.files && this.files[0]) {
                 abc += 1; //increementing global variable by 1

				var z = abc - 1;
                var x = $(this).parent().find('#previewimg' + z).remove();
                $(this).before("<div id='abcd"+ abc +"' class='abcd'><img id='previewimg" + abc + "' src=''/></div>");

			    var reader = new FileReader();
                reader.onload = imageIsLoaded;
                reader.readAsDataURL(this.files[0]);

			    $(this).hide();
                $("#abcd"+ abc).append($("<img/>", {id: 'img', src: 'http://175.176.184.119:8080/~apis~/purebreed/img/x.png', alt: 'delete'}).click(function() {
                $(this).parent().parent().remove();
                }));
            }
        });

//To preview image
    function imageIsLoaded(e) {
        $('#previewimg' + abc).attr('src', e.target.result);
    };

    $('#upload').click(function(e) {
        var name = $(":file").val();
        if (!name)
        {
            alert("First Image Must Be Selected");
            e.preventDefault();
        }
    });

		$('.remove-img').on('click',function(){
			$(this).parent().remove();
		})
});
</script>

<!-- /.content-wrapper -->
<style>
.abcd img{
    height:100px;
    width:100px;
    padding: 5px;
    border: 1px solid rgb(232, 222, 189);
}
#img{
    width: 30px;
    border: none;
    height:30px;
    margin-left: -20px;
    margin-bottom: 91px;
}
.upload {
    /* background-color: #ff0000; */
    /* border: 1px solid #ff0000; */
    /* color: #fff; */
    /* border-radius: 5px; */
    /* padding: 10px; */
    /* text-shadow: 1px 1px 0px green; */
    /* box-shadow: 2px 2px 15px rgba(0,0,0, .75); */
    width: 25%;
}
div#filediv img {
    margin: 2px 5px 6px 7px;
}

</style>
