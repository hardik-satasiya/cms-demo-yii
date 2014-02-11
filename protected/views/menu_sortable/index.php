<?php
/* @var $this Menu_sortableController */

$this->breadcrumbs=array(
	'Menu Sortable',
);
?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>

<p>
	You may change the content of this page by modifying
	the file <tt><?php echo __FILE__; ?></tt>.
</p>
<style>
    .list_menu {
        float:left;
        padding: 2px 2px 0;
        box-shadow: 0 0 6px grey;
        background: none repeat scroll 0 0 dimgray;
        margin-left:15px;
    }
    .list_inner{
        
        padding: 3px 5px;
        background: none repeat scroll 0 0 ghostwhite;
    }
    .list {
        
        box-shadow: 0 0 2px grey;
        padding: 3px 5px;
        color:white;
        text-align: center;
        
    }
    #list_title {
        box-shadow: 0 0 2px grey;
        background: none repeat scroll 0 0 yellowgreen;
        border:ghostwhite solid 3px;
        margin-bottom: 5px;
        padding: 4px 3px;
        text-align: center;
    }
    
    .list_inner ul {
        margin: 0;
        list-style-type: none;
        text-decoration: none;        
    }
    .list_inner ul li {
        margin: 0;        
        width:200px;
        box-shadow: 0 0 0.5px grey;
        border:ghostwhite solid 2px;
        background: none repeat scroll 0 0 #525252;
        color:white;
        margin: 0 0 5px;
        padding: 2px 5px;
        cursor: default;
        /*text-shadow: 1px 1px 1px #333333;    */
    }
    .list_inner ul li:hover {        
        box-shadow: 0 0 2px grey;
        background: none repeat scroll 0 0 #2B2B2B;        
        cursor: default;
    }          
    .pholder {
        height:100px;    
        width:200px;
        background: yellowgreen;
       
        /*text-shadow: 1px 1px 1px #333333;    */
    }
    .list
    {
        max-height: 20px;
    }
    code
    {
        padding: 2px 50px;
    }
    .bg_opacity
    {
        height:20px;            
        background: yellowgreen;
    }
    
    
</style>
<div class="list_menu">
    <div class="list_inner">       
        <div id="list_title">Super Admin</div>
        <?php
            $menu = "huhaaa";
            $this->widget('zii.widgets.jui.CJuiSortable', array(
                //list of items                
                'id'=>'superadmin',
                'items'=>$this->getMenufor('superadmin'),        
                // additional javascript options for the accordion plugin
                'options'=>array(                                                
                        'placeholder'=> "bg_opacity",
                        'opacity'=>0.4, //set the dragged object's opacity to 0.6                        
                        'update'=>'js:function(event,ui)
                                    {                                
                                        
                                      //alert($(this).sortable("toArray").toString());
                                        $("#s_admnin_list").html("<div class=\"progress progress-danger progress-striped active\"><div class=\"bar\" style=\"width: 100%;\"></div></div>");                                      
                                        $.post("Ajaxsort",
                                        {
                                            role:this.id, 
                                            Order:$(this).sortable("toArray").toString(),
                                        },
                                        function(data)                                        
                                        {                                               
                                            
                                            var json = JSON.parse(data)                                                                                        
                                            $("#s_admnin_list").html(json.status);                                                                                        
                                            
                                        });
                                    }'
                    
                ),

        ));    
        ?>
    </div>
    <div id="s_admnin_list" class="list"></div>
    <div id="list_privew"> </div>
</div>
<div class="list_menu">
    <div class="list_inner">       
        <div id="list_title">Admin</div>
        <?php
            $this->widget('zii.widgets.jui.CJuiSortable', array(
                //list of items
                'items'=>$this->getMenufor('admin'),        
                'id'=>'admin',
                // additional javascript options for the accordion plugin
                'options'=>array(
                        'cursor'=>'n-resize',
                        'opacity'=>0.3, //set the dragged object's opacity to 0.6                        
                        'update'=>'js:function(event,ui)
                                    {                                
                                      //alert($(this).sortable("toArray").toString());
                                        $("#admin_list").html("<div class=\"progress progress-danger progress-striped active\"><div class=\"bar\" style=\"width: 100%;\"></div></div>");                                      
                                        $.post("Ajaxsort",
                                        {
                                            role:this.id,
                                            Order:$(this).sortable("toArray").toString(),
                                        },
                                        function(data)
                                        {
                                            var json = JSON.parse(data)                                            
                                            $("#admin_list").html(json.status);                                                                                            
                                        });
                }'
                ),

        ));    
        ?>
        </div>
    <div id="admin_list" class="list"></div>
    <div id="list_privew"> </div>
</div>

<div class="list_menu">
        <div class="list_inner">        
        <div id="list_title">User</div>
        <?php
            $this->widget('zii.widgets.jui.CJuiSortable', array(
                //list of items
                'id'=>'user',
                'items'=>$this->getMenufor('user'),        
                // additional javascript options for the accordion plugin
                'options'=>array(
                        'cursor'=>'n-resize',
                        'opacity'=>0.3, //set the dragged object's opacity to 0.6                        
                        'update'=>'js:function(event,ui)
                                    {                                
                                      //alert($(this).sortable("toArray").toString());
                                        $("#user_list").html("<div class=\"progress progress-danger progress-striped active\"><div class=\"bar\" style=\"width: 100%;\"></div></div>");                                      
                                        $.post("Ajaxsort",
                                        {
                                            role:this.id,
                                            Order:$(this).sortable("toArray").toString(),
                                        },
                                        function(data)
                                        {
                                            var json = JSON.parse(data)                                            
                                            $("#user_list").html(json.status);                                                                                            
                                            
                                        });
                }'
                ),

        ));    
          
        ?>
        </div>
    <div id="user_list" class="list"></div>
    <div id="list_privew"> </div>
</div> 
<script>
    $(document).ready(function(){                
        
    });    
</script>




