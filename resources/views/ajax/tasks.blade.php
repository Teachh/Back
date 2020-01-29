<table class="table">
    <tbody>
      @foreach($notes as $nota)
        <tr>
            <td>
                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" value="">
                        <span class="form-check-sign">
                            <span class="check"></span>
                        </span>
                    </label>
                </div>
            </td>
            <td>
                <p class="title">
                  {{$nota->title}}
                  [{{ $nota->user->name}}]
                  @if($nota->finish==1)
                  <span class="badge badge-pill badge-success">{{__('web.acabado')}}</span>
                  @else
                  <span class="badge badge-pill badge-warning">Pendiente</span>
                  @endif
                  @if($nota->priority==1)
                  <span class="badge badge-pill badge-danger">PRIORITARIO</span>
                  @else

                  @endif

                </p>
                <p class="text-muted">{{ $nota->subject}}</p>
            </td>
            <td class="td-actions text-right">
                <button type="button" rel="tooltip" class="btn btn-link" data-toggle="modal" data-target="#{{ str_replace(' ', '', $nota->title) }}view">
                    <i class="tim-icons icon-zoom-split"></i>
                </button>
                <button type="button" rel="tooltip" title="" class="btn btn-link" data-original-title="Edit Task" data-toggle="modal" data-target="#{{ str_replace(' ', '', $nota->title) }}edit">
                    <i class="tim-icons icon-pencil"></i>
                </button>
                <button type="button" rel="tooltip" title="" class="btn btn-link" data-original-title="Edit Task" data-toggle="modal" data-target="#{{ str_replace(' ', '', $nota->title) }}delete">
                    <i class="tim-icons icon-simple-remove"></i>
                </button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="col-12 d-flex justify-content-center note-pagination">{{ $notes->links() }}</div>

@foreach($notes as $nota)
  <!-- Modal -->
  <div class="modal fade" id="{{ str_replace(' ', '', $nota->title) }}delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{__('web.conf-eli')}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        {{__('web.sure')}}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('web.atras')}}</button>
          <form  action="{{action('TaskController@deleteDash', $nota->id)}}" method="POST" style="display:inline">
              {{ csrf_field() }}
              {{ method_field('PUT') }}
              <button type="submit" class="btn btn-primary">{{__('web.acabado')}}</button>
          </form>
        </div>
      </div>
    </div>
  </div>


    <!-- Modal -->
<div class="modal fade" id="{{ str_replace(' ', '', $nota->title) }}edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="margin-top: -100px;">
    <div class="modal-dialog" role="document">
      <div class="modal-content text-center">

<form class="w-85 text-center p-5"action="{{action('TaskController@putEditDash', $nota->id)}}"  method="post">
@csrf
<br style="clear:both">
                    <h3 style="margin-bottom: 25px; text-align: center;">{{__('web.editar')}} </h3>
                    <div class="form-group">

                        <input type="text" class="form-control" id="name" name="title" value="{{$nota->title}}" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="email" name="subject" value="{{$nota->subject}}" required>
                    </div>
                    <div class="form-group">
                            <textarea class="form-control" type="textarea" name="body" id="message" maxlength="500" rows="7">{{$nota->body}}</textarea>
                        <span class="help-block"><p id="characterLeft" class="help-block ">{{__('web.error')}}</p></span>
                    </div>
                    <div class="form-group">
                        <input type="text" class="datepicker form-control" id="datetimepicker" name="limitdate" value="{{$nota->limitdate}}" required>
                    </div>
                    <div class="form-group">
                        <label class="form-check-label">
                            @if($nota->priority==1)
                               <div class="form-check">
                                  <label class="form-check-label">
                                  <input class="form-check-input" type="checkbox" name="tipusUrg" value="" checked>
                              <span class="form-check-sign">
                                  <span class="check">{{__('web.urgent')}}</span>
                                  </span>
                                  </label>
                                </div>
                            @else
                               <div class="form-check">
                                <label class="form-check-label">
                                  <input class="form-check-input" type="checkbox" name="tipusUrg" value="">
                                     <span class="form-check-sign">
                                    <span class="check">{{__('web.urgent')}}</span>
                                    </span>
                                 </label>
                               </div>
                            @endif
                        </label>
                    </div>

        <button type="submit" id="submit1" name="submit" class="btn btn-primary pull-right w-100">{{__('web.editar')}}</button>
</form>
      </div>
    </div>
  </div>


      <!-- Modal -->
      <div class="modal fade" id="{{ str_replace(' ', '', $nota->title) }}view" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content text-center">

<form class="w-85 text-center p-5" action="{{action('TaskController@putFinishDash', $nota->id)}}" method="post">
@csrf
<br style="clear:both">
                    <h3 style="margin-bottom: 25px; text-align: center;"> {{$nota->title}} </h3>
                    <div class="form-group">
                        <h5> {{$nota->subject}} </h5>
                    </div>
                    <div class="form-group">
                        <p> {{$nota->body}} </p>
                    </div>
                    <div class="form-group">
                        <p> {{$nota->limitdate}} </p>
                    </div>

                    <div class="form-group">
                        <label class="form-check-label">
                            @if($nota->finish==1)
                               <div class="form-check">
                                  <label class="form-check-label">
                                  <input id="finishA" name="finishA" value="1" class="form-check-input" type="checkbox" checked>
                              <span class="form-check-sign">
                                  <span class="check">{{__('web.acabado')}}</span>
                                  </span>
                                  </label>
                                </div>
                            @else
                               <div class="form-check">
                                <label class="form-check-label">
                                  <input id="finishA" name="finishA" value="0" class="form-check-input" type="checkbox" >
                                     <span class="form-check-sign">
                                    <span class="check">{{__('web.acabado')}}</span>
                                    </span>
                                 </label>
                               </div>
                            @endif
                        </label>
                    </div>

        <button type="submit" id="submit2" name="submit" class="btn btn-primary pull-right w-100">Confirmar</button>
</form>
      </div>
    </div>
  </div>
@endforeach
