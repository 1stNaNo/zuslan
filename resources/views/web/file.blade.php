@extends('layouts.main.main_noslide')

@section('content')

<div class="blog-posts">
    <table width="100%" class="files-table">
          <h3>{{ $type[0]->source }}</h3>
          <div class="row show-grid">
						<div class="col-md-4"><input type="text" placeholder="{{trans('resource.search')}}: {{trans('resource.name')}}" style="padding: 5px; width: 90%;" id="fileSearch"/></div>
						<div class="col-md-4"><input type="text" placeholder="{{trans('resource.search')}}: {{trans('resource.weblinks.id')}}" style="padding: 5px; width: 90%;" id="fileSearchNumb"/></div>
						<div class="col-md-4"><input type="text" placeholder="{{trans('resource.search')}}: 2017-03-05" style="padding: 5px; width: 90%;" id="fileSearchDate"/></div>
					</div>
        <thead>
          <tr>
            <th>{{trans('resource.name')}}</th>
            <th>{{trans('resource.weblinks.id')}}</th>
            <th>{{trans('resource.main.confirm_date')}}</th>
          </tr>
        </thead>
        <tbody>
          @foreach($files as $file)
            <tr class="files-item">
              <td width="50%" class="fileNameTD">{{$file->source}}</td>
              <td class="fileNumbTD">{{$file->number}}</td>
              <td class="fileDateTD">{{$file->confirm_date}}</td>
              <td style="display:none" class="file-path"><a href="{{$file->path}}"></a></td>
            </tr>
          @endforeach
        </tbody>
    </table>
</div>

<style>
  .files-table{
      border-top: grey 1px solid;
      border-bottom: grey 1px solid;
  }

  .files-table th{
      padding: 10px;
  }
  .files-table td{
      cursor: pointer;
      padding: 10px;
      border-top: grey 1px solid;
  }
  .files-table tr:hover > td{
      color: red;
  }
</style>

<script type="text/javascript">
  $(document).ready(function(){
    $("#fileSearch").keyup(function(){
      findFromFileTable();
    });
    $("#fileSearchNumb").keyup(function(){
      findFromFileTable();
    });
    $("#fileSearchDate").keyup(function(){
      findFromFileTable();
    });

    $(".files-table tr").click(function(){
      $(this).find("a")[0].click();
    });
  });

  function findFromFileTable(){
    var tmpKey = $("#fileSearch").val();
    var tmpKeyNumb = $("#fileSearchNumb").val();
    var tmpKeyDate = $("#fileSearchDate").val();

    $(".files-table tr").each(function(){

        var tmpText = $(this).find('.fileNameTD').text();
        var tmpNumb = $(this).find('.fileNumbTD').text();
        var tmpDate = $(this).find('.fileDateTD').text();

        var isShow = true;

        if(tmpText != "" && tmpKey != ""){
          if(tmpText.toUpperCase().indexOf(tmpKey.toUpperCase()) < 0){
            isShow = false;
          }
        }

        if(tmpNumb != "" && tmpKeyNumb != ""){
          if(tmpNumb.toUpperCase().indexOf(tmpKeyNumb.toUpperCase()) < 0){
            isShow = false;
          }
        }

        if(tmpDate != "" && tmpKeyDate != ""){
          if(tmpDate.indexOf(tmpKeyDate) < 0 ){
            isShow = false;
          }
        }

        if(isShow){
          $(this).show();
        }else{
          $(this).hide();
        }

    });
    if(tmpKey == "" && tmpKeyNumb == "" && tmpKeyDate == ""){
        $(".files-table tr").show();
    }
  }
</script>

@endsection
