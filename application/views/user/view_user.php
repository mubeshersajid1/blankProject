      <div class="row">
        <div class="col-md-12">  

        <div class="btn-group pull-right">
          <a class="btn btn-default" data-toggle="modal" data-target="#add">Add User</a>
          <a class="btn btn-default" data-toggle="modal" data-target="#grp_modal">Add Group</a>
          <a class="btn btn-default" data-toggle="modal" data-target="#add_per">Add Permission</a>
        </div>        

        <ul class="nav nav-tabs">
          <li class="active"><a data-toggle="tab" href="#home">Users</a></li>
          <li><a data-toggle="tab" href="#menu1">Groups</a></li>
          <li><a data-toggle="tab" href="#menu2">Permissions</a></li>
        </ul>

        <div class="tab-content">
          <div id="home" class="tab-pane fade in active">
           <!-- Tab 1 -->
              <?php if(!empty($info_users)) { ?>

                <div class="box box-primary">
                  <div class="box-body">


                    <table class="table table-borderd table-striped" id="user_data">
                      <thead>
                        <tr>
                          <th>Id</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Last Login</th>
                          <th>Groups</th>
                          <th>IP Address</th>
                          <th>Banned</th>
                          <th>ACTION</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                            <?php

                            $sno = 1;

                            foreach ($info_users as $val): 

                              $info_group = $this->aauth->get_user_groups($val->id); ?>

                              <td><?php echo $val->id;?></td>
                              <td><?php echo $val->name;?></td>
                              <td><?php echo $val->email;?></td>
                              <td><?php echo $val->last_login;?></td>
                              <td><?php foreach ($info_group as $grp){ echo $grp->name.', '; }?></td>
                              <td><?php echo $val->ip_address;?></td>
                              <td><?php echo $val->banned;?></td>

                       <td>
                        <div class="btn-group">
                            <?php if ($val->banned == 0) { ?>
                              <a class="btn btn-default ban_this btn-xs">
                                <i class="fa fa-lock" aria-hidden="true"></i>
                              </a>                              
                            <?php } else { ?>
                              <a class="btn btn-default unban_this btn-xs">
                                <i class="fa fa-unlock" aria-hidden="true"></i>
                              </a>                              
                            <?php } ?>      


                            <a class="btn btn-default assign_this btn-xs" data-toggle="modal" data-target="#groups">
                              <i class="fa fa fa-plus-square-o" aria-hidden="true"></i>
                            </a>                   
                            <a class="btn btn-info btn-xs" data-toggle="modal" data-target="#update_<?php echo $sno; ?>">
                              <i class="fa fa-edit" aria-hidden="true"></i>
                            </a>               
                            <a class="btn btn-danger btn-xs" data-toggle="modal" data-target="#delete_user_<?php echo $sno; ?>">
                              <i class="fa fa-trash" aria-hidden="true"></i>
                            </a>                                                    

                            <?php if($this->aauth->is_member('Teacher', $val->id)){ ?>

                            <a class="btn btn-default allow_subject btn-xs" data-toggle="modal" data-target="#allow_subject">
                              <i class="fa fa-sitemap" aria-hidden="true"></i>
                            </a>  

                            <?php } ?>

                          </div>
                        </td>
                        </tr>

<!-- Delete Group -->
<div id="delete_user_<?php echo $sno; ?>" class="modal fade" role="dialog" tabindex="-1">
  <div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Are you sure you want to delete?</h4>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete <b>"<?php echo $val->name;?>"</b>?</p>
        
      </div>
      <div class="modal-footer">
        <form action="<?php echo site_url('user/delete_user'); ?>" method="POST">
          <input type="hidden" name="id" value="<?php echo $val->id;?>">
          <button type="submit" class="btn btn-danger" name="delUser">Delete</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Edit -->
<div id="update_<?php echo $sno; ?>" class="modal fade" role="dialog" tabindex="-1">
  <div class="modal-dialog">

<form action="<?php echo site_url('user/edit_user'); ?>" method="POST">
    <input type="hidden" name="user_id" value="<?php echo $val->id;?>">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update User</h4>
      </div>
      <div class="modal-body">     
        <div class="form-group">
          <label>Email Address</label>
          <input type="text" name="email" class="form-control" value="<?php echo $val->email;?>">
        </div>
        <div class="form-group">
          <label>Name</label>
          <input type="text" name="name" class="form-control" value="<?php echo $val->name;?>">
        </div>
        <div class="form-group">
          <label>Password</label>
          <input type="password" name="pass" class="form-control">
        </div>                
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success">Update</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

</form>

  </div>
</div>

                        <?php $sno++; endforeach; ?>
                      </tbody>
                    </table>
                    
                <?php }

                else
                { ?>

                  <div class="alert alert-warning">
                    <strong>No Record found!</strong> Click ADD NEW to add new record.
                  </div>        

                <?php } ?>

              </div> <!-- ./ box body -->
            </div> <!-- ./ close box -->
           
          </div>
          <div id="menu1" class="tab-pane fade">
           <!-- Tab 2 -->
            <?php if(!empty($info_grp)){ ?>

            <div class="box box-primary">
              <div class="box-body">

              <table class="table table-bordered table-striped" id="groups_t">

                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Defination</th>
                    <td></td>
                  </tr>
                </thead>

                <tbody>
                  <?php $sno=1; foreach ($info_grp as $val): ?>
                    <tr>
                      <td><?php echo $val->id; ?></td>
                      <td><?php echo $val->name; ?></td>
                      <td><?php echo $val->definition; ?></td>
                      <td>
                        <div class="btn-group">
                          <a class="btn btn-info edit_group" data-toggle="modal" data-target="#edit_grp_modal_<?php echo $sno; ?>">
                            <i class="fa fa-edit"></i>
                          </a>                          
                          <a class="btn btn-danger del_group" data-toggle="modal" data-target="#delete_grp">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                          </a>                          
                        </div>
                      </td>
                    </tr>

<div id="edit_grp_modal_<?php echo $sno; ?>" class="modal fade" role="dialog" tabindex="-1">
  <div class="modal-dialog">
<form method="POST" action="<?php echo site_url('user/update_group'); ?>">
   <input type="hidden" name="grp_id" value="<?php echo $val->id;?>">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Group</h4>
      </div>
      <div class="modal-body">
    
        <div class="form-group">
          <label>Name</label>
          <input type="text" name="grp_name" class="form-control" value="<?php echo $val->name; ?>">
        </div>
        <div class="form-group">
          <label>Definition</label>
          <input type="text" name="grp_def" class="form-control" value="<?php echo $val->definition; ?>">
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success">Update</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

</form>

  </div>
</div>

                  <?php $sno++; endforeach; ?>
                </tbody>


                
              </table>


            
              </div> <!-- ./ box body -->
            </div> <!-- ./ close box -->

            <?php } else { ?>


              <div class="alert alert-info">No Data Found!</div>


            <?php } ?>


          </div>
          <div id="menu2" class="tab-pane fade">
            <!-- Tab 3 -->
              <?php if(!empty($info_per)){ ?>

              <div class="box box-primary">
                <div class="box-body">

                <table class="table table-bordered table-striped" id="permission">

                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Name</th>
                      <th>Definition</th>
                      <td></td>
                    </tr>
                  </thead>

                  <tbody>
                    <?php foreach ($info_per as $val1): ?>
                      <tr>
                        <td><?php echo $val1->id; ?></td>
                        <td><?php echo $val1->name; ?></td>
                        <td><?php echo $val1->definition; ?></td>
                        <td>
                          <div class="btn-group">
                            <a class="btn btn-info edit_perm" data-toggle="modal" data-target="#edit_per">
                              <i class="fa fa-edit"></i>
                            </a>
                            <a class="btn btn-danger del_permission" data-toggle="modal" data-target="#delete_per">
                              <i class="fa fa-trash" aria-hidden="true"></i>
                            </a>                          
                          </div>
                        </td>
                      </tr>
                    <?php endforeach ?>
                  </tbody>


                  
                </table>


              
                </div> <!-- ./ box body -->
              </div> <!-- ./ close box -->

              <?php } else { ?>


                <div class="alert alert-info">No Data Found!</div>


              <?php } ?>            
          </div>
        </div>        



        </div> <!-- ./ close of cloumn -->        
      </div><!-- /.row -->

<!-- Allow Subject to User -->
<div id="allow_subject" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Allow Subject to <span id="allow_title"></span></h4>
      </div>
      <div class="modal-body">

        <ul class="nav nav-tabs">
          <li class="active"><a data-toggle="tab" href="#assign_sub">Assign Subject</a></li>
          <li><a data-toggle="tab" href="#assigned_sub">Assigned Subjects</a></li>
          <li><a data-toggle="tab" href="#allowed_class">Allowed Class</a></li>
        </ul>   

        <div class="tab-content">
          <div id="assign_sub" class="tab-pane fade in active">
           <!-- Tabe 1 -->

           <input type="hidden" id="as_user_id">

          <div class="form-group">
            <label>Class</label>
            <?php echo  form_dropdown('class', $info_classes, '', 'class="form-control select2" style="width:100%;" id="class_id"'); ?>
          </div>

          <div class="form-group">
            <label>Section</label>
            <select name="section" id="section_id" class="form-control select2" style="width:100%;">
              <option value="">Select Class</option>
            </select>
          </div>   

          <div class="form-group">
            <label>Subject</label>
            <select name="subject" id="subject_id" class="form-control select2" style="width:100%;">
              <option value="">Select Subject</option>
            </select>
          </div>              

          <button type="button" class="btn btn-success" data-dismiss="modal" id="assignsub_confrim">Assign</button>
          </div>
          <div id="assigned_sub" class="tab-pane fade">
            <!-- Tabe 2 -->
            <div id="allowed_subjects">
            </div>
          </div>
          
          <div id="allowed_class" class="tab-pane fade">
            <!-- Tabe 3 -->
     

          </div>


        </div>            


      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>      

    </div>
  </div>
</div>
          
<!-- Add User -->
<div id="add" class="modal fade" role="dialog" tabindex="-1">
  <div class="modal-dialog">
      
    <form action="<?php echo site_url('user/add_user'); ?>" method="POST">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add User</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Email Address</label>
            <input type="text" name="email" class="form-control" id="email" required>
          </div>
          <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control" id="name" required>
          </div>
          <div class="form-group">
            <label>Password</label>
            <input type="password" name="pass" class="form-control" id="pass" required>
          </div>                
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Add</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Add Permission -->
<div id="add_per" class="modal fade" role="dialog" tabindex="-1">
  <div class="modal-dialog">

<form method="POST" action="<?php echo site_url('user/add_permission'); ?>">
  
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Permission</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Name</label>
          <input type="text" name="name" class="form-control" required="">
        </div>
        <div class="form-group">
          <label>Definition</label>
          <input type="text" name="def" class="form-control" required="">
        </div>                
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success" >Add</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
</form>

  </div>
</div>

<!-- Edit Permission -->
<div id="edit_per" class="modal fade" role="dialog" tabindex="-1">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Permission</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>id</label>
          <input type="text" name="name" class="form-control" id="id_per" readonly>
        </div>
        <div class="form-group">
          <label>Name</label>
          <input type="text" name="name" class="form-control" id="name_per_e">
        </div>
        <div class="form-group">
          <label>Definition</label>
          <input type="text" name="def" class="form-control" id="def_per_e">
        </div>                
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-dismiss="modal" id="update_permission">Update</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<!-- Add Group -->
<div id="grp_modal" class="modal fade" role="dialog" tabindex="-1">
  <div class="modal-dialog">

 <form method="POST" action="<?php echo site_url('user/add_grp') ?>">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Group</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Name</label>
          <input type="text" name="grp_name" class="form-control" required="">
        </div>
        <div class="form-group">
          <label>Definition</label>
          <input type="text" name="grp_def" class="form-control" required="">
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success">Add</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </form>

  </div>
</div>




<!-- Delete -->
<div id="delete" class="modal fade" role="dialog" tabindex="-1">
  <div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Are you sure you want to delete?</h4>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete <b>"<span id="delete_title"></span>"</b>?<span id="delete_id" style="display:none"></span></p>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal" id="delete_confrim">Delete</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Delete Permission -->
<div id="delete_per" class="modal fade" role="dialog" tabindex="-1">
  <div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Are you sure you want to delete?</h4>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete <b>"<span id="del_title_per"></span>"</b>?<span id="delete_id_per" style="display:none"></span></p>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal" id="del_perm">Delete</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Delete Group -->
<div id="delete_grp" class="modal fade" role="dialog" tabindex="-1">
  <div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Are you sure you want to delete?</h4>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete <b>"<span id="del_title_grp"></span>"</b>?<span id="delete_id_grp" style="display:none"></span></p>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal" id="del_grp">Delete</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Groups -->
<div id="groups" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Assign Group to <span id="assign_title"></span></h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-10">
            <?php echo form_dropdown('', $info_groups, '', 'class="form-control select2" style="width:100%" id="group_id"'); ?>
          </div>
          <div class="col-md-2">
            <button type="button" class="btn btn-success" data-dismiss="modal" id="assign_confrim">Assign</button>
          </div>
        </div>
        <span id="assigned_groups"></span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">

    var user_data = $('#user_data').DataTable({"paging":false});
    var groups_ta = $('#groups_t').DataTable();
    var per_ta = $('#permission').DataTable();
  

    $('.allow_subject').click(function(){
      var data = user_data.row($(this).parents('tr')).data();

      $('#allow_title').text(data[1]);

      $("#as_user_id").val(data[0]);

      $.ajax({
        type: "POST",
        url: "<?php echo site_url('user/allowed_subjects');?>", 
        data: {
                user_id: data[0],
              },
       
        success: function(data){ $("#allowed_subjects").html(data); },
        
      }); // close ajax call       

      $.ajax({
        type: "POST",
        url: "<?php echo site_url('user/assigned_class');?>", 
        data: {
                user_id: data[0],
              },    
                  
        success: function(data){ $("#allowed_class").html(data); },

      });

    });    

    $("#class_id").change(function(){ 

      $.ajax({
        type: "POST",
        url: "<?php echo site_url('classes/view_section_dropdown');?>", 
        data: {
                clid: $(this).val(),
              },
       
        success: function(data){ $("#section_id").html(data); },
        
      }); // close ajax call 

    }); 

    $("#section_id").change(function(){ 

      $.ajax({
        type: "POST",
        url: "<?php echo site_url('exam/view_subject_dropdown');?>", 
        data: {
                clid: $('#class_id').val(),
                secid: $(this).val(),
              },
       
        success: function(data){ $("#subject_id").html(data); },
        
      }); // close ajax call 

    });      

    $(".assign_this").click(function(){ 

      var group_data = user_data.row($(this).parents('tr')).data();

      $('#assign_title').text(group_data[1]);
      $('#assign_id').text(group_data[0]);
      
        $.ajax({
          type: "POST",
          url: "<?php echo site_url('user/assigned_groups');?>", 
          data: {
                  user_id: group_data[0],
                },
         
        success: function(data){$('#assigned_groups').html(data)},

          }); // close ajax call  
    });  

    // FOR EDIT FEES TYPE INFORMATION

   $("#assign_confrim").click(function(){ 

        $.ajax({
          type: "POST",
          url: "<?php echo site_url('user/assign_group');?>", 
          data: {
                  user_id: $('#user_id').text(),
                  group_id: $('#group_id').val(),
                },
         
        success: location.reload(),
          
          }); // close ajax call 

      });   

</script>
