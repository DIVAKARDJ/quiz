@if(isset($options[0]))
    @foreach($options as $item)
        <div class="col-md-6" id="opt0">
            <div class="que-btn que-btn-new" id="ans{{$item['id']}}">
                <a href='javascript:;' onclick='processForm("{{$item['id']}}");'>
                    @if($item['type'] == 1)
                        <img src="{{$item['question_option']}}" alt="">
                    @else
                        {{$item['question_option']}}
                    @endif
                </a>
            </div>
        </div>
    @endforeach
@endif