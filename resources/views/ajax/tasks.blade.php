<table>
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