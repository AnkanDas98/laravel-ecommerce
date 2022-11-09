@php
    $tagEngs = App\Models\Product::groupBy('product_tags_en')
        ->select('product_tags_en')
        ->limit(10)
        ->get();
    $engTags = [];
    for ($i = 0; $i < count($tagEngs); $i++) {
        if (strstr($tagEngs[$i]['product_tags_en'], ',')) {
            $tags = explode(',', $tagEngs[$i]['product_tags_en']);
            foreach ($tags as $tag) {
                array_push($engTags, $tag);
            }
        } else {
            array_push($engTags, $tagEngs[$i]['product_tags_en']);
        }
    }
    $engTagsUnique = array_unique($engTags);
    
    $tagBan = App\Models\Product::groupBy('product_tags_bn')
        ->select('product_tags_bn')
        ->limit(10)
        ->get();
    $banTags = [];
    for ($i = 0; $i < count($tagBan); $i++) {
        if (strstr($tagBan[$i]['product_tags_bn'], ',')) {
            $tags = explode(',', $tagBan[$i]['product_tags_bn']);
            foreach ($tags as $tag) {
                array_push($banTags, $tag);
            }
        } else {
            array_push($banTags, $tagBan[$i]['product_tags_bn']);
        }
    }
    $banTagsUnique = array_unique($banTags);
@endphp

<div class="sidebar-widget product-tag wow fadeInUp">
    <h3 class="section-title">Product tags</h3>
    <div class="sidebar-widget-body outer-top-xs">
        <div class="tag-list">
            @if (session()->get('language') == 'bangla')
                @foreach ($banTagsUnique as $tag)
                    <a class="item active" title="{{ $tag }}"
                        href="{{ url('/product/tag/ban?tag=' . $tag) }}">{{ $tag }}</a>
                @endforeach
            @else
                @foreach ($engTagsUnique as $tag)
                    <a class="item active" title="{{ $tag }}"
                        href="{{ url('/product/tag/eng?tag=' . $tag) }}">{{ $tag }}</a>
                @endforeach
            @endif
        </div>
        <!-- /.tag-list -->
    </div>
    <!-- /.sidebar-widget-body -->
</div>
