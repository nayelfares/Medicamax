@extends('drugAdministration.multi_media.base')
@section('action-content')
 <meta charset="UTF-8">
<meta name="csrf-token" content="{{ csrf_token() }}" />

<link rel="stylesheet" type="text/css" href="{{asset('/assets/font-awesome/fonts/New Fonts.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('/assets/css/cs.css')}}">
<script src="{{asset('/js/alaa/jquery.js')}}"></script>

<script src="http://releases.flowplayer.org/js/flowplayer-3.2.12.min.js"></script>
<style>
        .parsley-error {
            border-color: #ff5d48 !important;
        }
        .parsley-errors-list.filled {
            display: block;
        }
        .parsley-errors-list {
            display: none;
            margin: 0;
            padding: 0;
        }
        .parsley-errors-list > li {
            font-size: 12px;
            list-style: none;
            color: #ff5d48;
            margin-top: 5px;
        }
        .form-section {
            padding-left: 15px;
            border-left: 2px solid #FF851B;
            display: none;
        }
        .form-section.current {
            display: inherit;
        }
</style>

<div class="card mb-3"> 

  <div class="card-header">
    <i class="fa fa-tint bigfonts" aria-hidden="true"></i> All Multi ({{$count}})  
    <span class="pull-right">
      <a  class="btn btn-outline-info btn-sm" href="{{ route('multi_media.index') }}"><i class="fa fa-refresh bigfonts" aria-hidden="true"></i> </a>
    <!--  <a class="btn btn-primary btn-sm" href="#"><i class="fa fa-upload bigfonts" aria-hidden="true"></i> Export</a>
      <a class="btn btn-primary btn-sm" href="#"><i class="fa fa-download bigfonts" aria-hidden="true"></i> Import</a>-->
      <button class="btn btn-primary btn-sm"  id="create"><i class="fa fa-plus bigfonts" aria-hidden="true"></i> Add new multi media</button>
    </span>              
  </div>   
<!-- ADD     EDIT ------->

      
        <form id="upload_image_form" method="post" enctype="multipart/form-data">
           {{  csrf_field() }}
            <div id="container" class="row " style="padding-left: 20px;padding-bottom: 0.0px;" hidden="true">  
              <input type="integer" name="multi_media_id" id="multi_media_id" hidden="true">
              <input type="hidden" value="{{ csrf_token() }}" name="_token">
              <!--<div class="form-group col-md-1 control-label">
                  <label for="multi_media_title">title<span class="text-danger">*</span></label>
                  <input type="text" name="title" data-parsley-trigger="change" required placeholder="Enter Title" class="form-control" id="title">
              </div>-->
              <div class="form-group col-md-5 control-label">
                  <label for="description">Description<span class="text-danger">*</span></label>
                  <textarea type="text" name="description" data-parsley-trigger="change" required placeholder="Enter Description" class="form-control" id="description"></textarea>
              </div>
              <div class="form-group col-md-1 control-label">
                  <label for="m_mfile_type">File Type</label>
                  <select class="form-control" name="file_type" id="file_type">
                      <option selected="selected"></option>
                      <option  value="image">Image</option>
                      <option  value="video">Video</option>
                      <option  value="file">file</option>
                      
                  </select>
              </div>
              <!--<div class="form-group col-md-4 control-label">
                  <label  >File</label>
                  <input type="file" id="m_m_file" name="m_m_file" class="form-control" >
              </div>-->
              <div class="form-group col-md-4 control-label">
                  <label for="m_mfile">Upload File</label>
                  <input id="image_input" type="file" name="m_m_file" class="form-control form-control-sm">
                  
              </div>
              <button class="btn btn-primary btn-lg"  id="save" name="save" style="margin-top: 20px;margin-left: 15px;  height: 50px;text-align: center;"> Save</button>
              <button class="btn btn-danger btn-lg"  id="cancel" name="cancel" style="margin-top: 20px;margin-left: 15px;  height: 50px;text-align: center;"> Cancel</button>
            </div>
          </form>
          

                               
      

      <hr class="fixedpar" style="float:left;border-style: inset; border-width: 0.8px;margin-top: 0.0em;margin-bottom: 0.0em; width:100%;padding-bottom: 0.0px">
      
      <div class="card-body" style="padding-top:0.0px ">
        <div class="table-responsive">
          <table id="example" class="table table-bordered table-hover display" style="width:100%">
            <thead>
              <tr>
                <th width ="100">Description</th>
                <th width ="100">File Type</th>
                <th width ="100">SnapShoot</th>
                <th width ="100" >Action</th>
              </tr>
            </thead>

            <tbody>
              @foreach ($multi_media as $m_m)
              <tr role="row" class="odd" >
                <td width ="100">{{ $m_m->description }}</td>
                <td width ="100">{{ $m_m->file_type }}</td>
                  @if($m_m->file_type =='image')
                    <th width ="100">
                        
                    <a href="#{{$m_m->id}}">
                          <img src="{{ asset($m_m->path) }}" class="thumbnail" height="50">
                     </a>

                        <!-- lightbox container hidden with CSS -->
                        <a href="#_" class="lightbox" id="{{$m_m->id}}">
                          <img src="{{ asset($m_m->path) }}">
                        </a>    
                        
                    </th>  
                        
                  @endif
                  @if($m_m->file_type =='video')
                    <th width ="100" >
                        <div id="light">
                          <a class="boxclose" id="boxclose" onclick="lightbox_close();"></a>
                          <video id="VisaChipCardVideo" width="600" controls>
                              <source src="{{ asset($m_m->path) }}" type="video/mp4">
                              <!--Browser does not support <video> tag -->
                            </video>
                        </div>
                        <div id="fade" onClick="lightbox_close();"></div>

                        <div>
                          <a href="#" onclick="lightbox_open();">       
                            <img src="{{ asset('images_tree/watch.png') }}" width="200" height="100" >
                            </a>
                        </div>
                  </th>
                  @endif
                  @if($m_m->file_type =='file')
                    <th width ="100">
                         
                        <div id="light1">
                          <a class="boxclose1" id="boxclose1" onclick="lightbox_close1();"></a>
                            
                            <iframe src="{{ asset($m_m->path) }}" height="500" width="600"></iframe>
                        </div>
                        <div id="fade1" onClick="lightbox_close1();"></div>

                        <div>
                          <a href="#" onclick="lightbox_open1();">       
                            <img alt="Logo" src="{{ asset('images_tree/pdf.svg') }}" width="200" height="100" />
                            </a>
                        </div>
                  
                  </th>
                  @endif
                  <th width ="100" style="width: 100px !important;">  
                    <form  method="POST" action="{{ route('multi_media.destroy', ['id' => $m_m->id]) }}" onsubmit = "return confirm('Are you sure?')">
                      <input type="hidden" name="_method" value="DELETE">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash-o" aria-hidden="true"></i>
                      </button>
                    </form>
                  </th>
                  <th>
                      <button  onclick="returnFileUrl({{$m_m->id}});">Select</button>
                  </th>
            </tr>
            @endforeach
          </tbody>
          </table>
        </div>
      </div>
</div>




<!-- BEGIN Java Script for this page -->
<script src={{asset("js/alaa/jquery-3.3.1.js")}}></script>
<script src={{asset("js/alaa/jquery.dataTables.min.js")}}></script>
<link  href="{{ asset('/js/alaa/jquery.dataTables.min.css')}}" type="text/css" />

<script>
  // END CODE FOR BASIC DATA TABLE 
  $(document).ready(function() {

    $('#example thead th').each( function () {
      var title = $('#example thead th').eq( $(this).index() ).text();
      $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );

    // DataTable
    var table = $('#example').DataTable();

    // Apply the search
    table.columns().eq( 0 ).each( function ( colIdx ) {
      $( 'input', table.column( colIdx ).header() ).on( 'keyup change', function () {
        table
        .column( colIdx )
        .search( this.value )
        .draw();
      } );
    } );
  } );


  $('#create').click(function(){
    document.getElementById('container').hidden = false;
    initailize_feild_to_add();
  })
//cancel Edit Or Cancel Create
  $('#cancel').click(function(){
        document.getElementById('container').hidden = true;
        initailize_feild_to_add();
  })
//Select multi_media To Edit
  function selectmulti_mediaToEdit(id){
    document.getElementById('container').hidden = false;
    console.log(id);
    $.ajax({
        type :'GET',
        url:"{{route('multi_media.get_details')}}",
        data:{
            id : id
        },
        success:function(res){
            console.log(res);
            multi_media =  JSON.parse(res);
            
            console.log(multi_media);
            document.getElementById('multi_media_id').value = multi_media.id;
            document.getElementById('description').value = multi_media.description;
            document.getElementById('file_type').value = multi_media.file_type;
            
          }
    })
  }
//save tag to update or create
  /*$('#save').click(function(){
    $('#upload_image_form').submit();
  });*/

  $('#upload_image_form').on('submit', function(e){
      e.preventDefault();
      var id = document.getElementById('multi_media_id').value;
      var data = new FormData(this);
      if($('#image_input').val()){
        $.ajax({
          type: 'POST',
          data: data,
          url:  "{{route('multi_media.save_multi_media')}}",
          contentType: false,
          cache: false,
          processData:false
        }).done(function(_data){
          console.log(_data);
          document.getElementById('container').hidden = true;
          initailize_feild_to_add();
          //alert(res['success']);
          if(id == "")
            location.reload();
        });
      }else{
        alert('no image');
      }
    });

  function initailize_feild_to_add()
  {
    document.getElementById('multi_media_id').value = "";
    document.getElementById('description').value = "";
    $('#file_type option').prop('selected', function() {
        return this.defaultSelected;
    });

  }


  $.ajaxSetup(
        {
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    
    
/*****************************************/
            function getUrlParam( paramName ) {
            var reParam = new RegExp( '(?:[\?&]|&)' + paramName + '=([^&]+)', 'i' );
            var match = window.location.search.match( reParam );

            return ( match && match.length > 1 ) ? match[1] : null;
        }
        //*******/
        function returnFileUrl(id) {   
            document.getElementById('container').hidden = false;
            $.ajax({
                type :'GET',
                url:"{{route('multi_media.get_details')}}",
                data:{
                    id : id
                },
                success:function(res){
                    multi_media =  JSON.parse(res);
                    var ur=multi_media.path;
                    var funcNum = getUrlParam( 'CKEditorFuncNum' );
                    var fileUrl ="{{ asset('') }}"+ur.substring(1,ur.length);
                    window.opener.CKEDITOR.tools.callFunction( funcNum, fileUrl );
                    window.close();
                    
                  }
            });
        }
    /****************************************/
 window.document.onkeydown = function(e) {
  if (!e) {
    e = event;
  }
  if (e.keyCode == 27) {
    lightbox_close();
  }
}

function lightbox_open() {
  var lightBoxVideo = document.getElementById("VisaChipCardVideo");
  window.scrollTo(0, 0);
  document.getElementById('light').style.display = 'block';
  document.getElementById('fade').style.display = 'block';
  lightBoxVideo.play();
}

function lightbox_close() {
  var lightBoxVideo = document.getElementById("VisaChipCardVideo");
  document.getElementById('light').style.display = 'none';
  document.getElementById('fade').style.display = 'none';
  lightBoxVideo.pause();
}

    
function lightbox_open1() {
  var lightBoxVideo = document.getElementById("VisaChipCardVideo1");
  window.scrollTo(0, 0);
  document.getElementById('light1').style.display = 'block';
  document.getElementById('fade1').style.display = 'block';
  lightBoxVideo1.play();
}

function lightbox_close1() {
  var lightBoxVideo = document.getElementById("VisaChipCardVideo1");
  document.getElementById('light1').style.display = 'none';
  document.getElementById('fade1').style.display = 'none';
  lightBoxVideo1.pause();
}    
    
</script>


@endsection
