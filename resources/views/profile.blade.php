@extends('admin.master')

@section('content')
<div class="row">
            <ol class="breadcrumb">
                <li><a href="#">
                    <em class="fa fa-home"></em>
                </a></li>
                <li class="active">Profile</li>
            </ol>
</div><!--/.row-->
        
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Profile</h1>
            </div>
        </div><!--/.row-->
        
        <div class="panel panel-container">
            <div class="row">
                <div class="col-md-12" style="padding-bottom: 30px;">
                    
                                
                                 <div id = "preview" style="width: 150px; height: 150px; float: left; margin-left:15px;margin-right: 20px;" > <img id="imgs" src="/uploads/{{ $user->avatar }}" style="width: 150px; height: 150px; float: left; margin-right: 25px;"></div>
                                    <h2>{{ $user->name }}'s Profile</h2>
                                    <form enctype="multipart/form-data" action="/profile" method="POST">
                                        <label>Update Profile Image</label>
                                        <input type = "file" id = "file" name = "avatar" accept="image/*"/>
                                     <input type="hidden" name="_token" value="{{ csrf_token()}}"><br>
                                        <input type="submit" class="btn btn-primary">
                                    </form>

                </div> 
            </div>
        </div>
        
        
        
        
            <div class="col-sm-12 panel panel-container">
                <p class="back-link">  &copy; LLCDHMS | All rights reserved 2018 | Developed by Jendy V. Manatad</p>
            </div>
<script>
//script for live preview of picture
    $(document).ready(function(){
    $pic = $('<img id = "image" width = "100%" height = "100%"/>');
    $("#file").change(function(){
        var files = !!this.files ? this.files : [];
        if(!files.length || !window.FileReader){
            $("#image").remove();
        }
        if(/^image/.test(files[0].type)){
            var reader = new FileReader();
            reader.readAsDataURL(files[0]);
            reader.onloadend = function(){
                $pic.appendTo("#preview");
                $("#image").attr("src", this.result);
            }
 
        }
    });
    $(document).on('click', '#file', function()
        {
            $('#imgs').fadeOut(2000);
    });
});
</script>
   
@endsection
