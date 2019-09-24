<div class="border p-4 rounded mb-4">
    <?php
        $categories=DB::table('categories')->where([['status',1],['parent_id',0]])->orderBy('name','Asc')->get();
    ?>
    <h3 class="mb-3 h6 text-uppercase text-black d-block"><a href="/shop"><strong class="text-black">Categories</strong></a></h3>
        <div class="panel-group category-products" id="accordian"><!--category-productsr-->
            @foreach($categories as $category)
                <?php
                $sub_categories=DB::table('categories')->select('id','name')->orderBy('name','Asc')->where([['parent_id',$category->id],['status',1]])->get();
                ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                            <a data-toggle="collapse" data-parent="#accordian" href="#subcat{{$category->id}}">
                                @if(count($sub_categories)>0)
                                    <i class="fa fa-plus fa-pull-right"></i>
                                @endif
                            </a>
                            <a href="{{route('byCat',$category->id)}}">{{$category->name}}</a>

                    </div>
                    @if(count($sub_categories)>0)
                        <div id="subcat{{$category->id}}" class="panel-collapse collapse">
                            <div class="panel-body">
                                <ul>
                                    @foreach($sub_categories as $sub_category)
                                        <li><a href="{{route('byCat',$sub_category->id)}}">&mdash;{{$sub_category->name}} </a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                </div>
            @endforeach
        </div><!--/category-products-->
</div>