<a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <i class="fas fa-ellipsis-v fa-sm fa-fw"></i>
</a>
<div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
    aria-labelledby="dropdownMenuLink">

    <a href="{{url('admin/members/'.$item->id.'/edit')}}" class="dropdown-item"><i class="fa fa-edit"> </i> এডিট</a>
    <a href="{{url('admin/members/find?id='.$item->id)}}" class="dropdown-item"><i class="fa fa-eye"> </i> বিস্তারিত</a>
    {!! Form::open([
        'method'=>'DELETE',
        'url' => ['/admin/members', $item->id],
        'style' => 'display:inline'
    ]) !!}
    {!! Form::button('<i class="fa fa-times"></i>  মুছে ফেলুন', array(
            'type' => 'submit',
            'class' => 'dropdown-item',
        'title' => 'Delete user',
        'onclick'=>'return confirm("আপনি কি নিশ্চিত?")'
            )) !!}
    {!! Form::close() !!}
    <a href="{{url('admin/barcode-test/'.$item->id)}}" target="_blank" class="dropdown-item"><i class="fa fa-barcode"> </i> বারকোড</a>
</div>
