<div class="row justify-content-center mt-4 ">
    <div class="col-md-8">
        <h3 class="text-center font-weight-bold text-primary">Select your exam</h3>
    </div>
    <div class="col-md-8 border-bottom mt-3 pb-2">
        <ul class="main_nav nav nav-tabs category_list border-0" id="pills-tab" role="tablist">
            @foreach($categories as $category)
                <li class="nav-item">
                    <a href="#{{$category->name}}"
                       class="{{ ($loop->first) ? 'active' : '' }} nav-link category_name px-3"
                       id="{{ $category->name }}-tab" data-toggle="tab" role="tab" aria-controls="{{$category->name}}">
                        {{ $category->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="col-md-8 mt-4">
        <div class="tab-content " id="pills-tabContent">
            @foreach($categories as $category)
                <div class="tab-pane fade  {{ ($loop->first) ? 'show active' : '' }}"
                     id="{{ $category->name }}" role="tabpanel" aria-labelledby="{{ $category->name }}-tab">
                    <div class="row">
                        @forelse($category->count_sub_category as $sub_category)
                            <div class="col-md-3 mb-3">
                                <div class="feature pb-0 text-center trans_400 border">
                                    <div class="feature_icon"><img src="{{ asset('web_assets/images/icon_2.png') }}"
                                                                   alt=""></div>
                                    <h3 class="feature_title">{{ $sub_category->name }}</h3>
                                </div>
                            </div>
                        @empty
                            <h4>No Sub Category Found </h4>
                        @endforelse
                    </div>

                </div>
            @endforeach
        </div>
    </div>
</div>
