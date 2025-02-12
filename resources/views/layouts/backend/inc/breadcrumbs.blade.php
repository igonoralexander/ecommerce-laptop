                                <div class="flex items-center flex-wrap justify-between gap20 mb-30">
                                    <h3>{{$title}}</h3>
                                    <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                                        <li>
                                            <a href="index.html"><div class="text-tiny">Dashboard</div></a>
                                        </li>
                                        @foreach($breadcrumbs as $breadcrumb)
                                            <li><i class="icon-chevron-right"></i></li>
                                            @if(!$loop->last)
                                                <li><a href="{{ $breadcrumb['url'] }}"><div class="text-tiny">{{ $breadcrumb['label'] }}</div></a></li>
                                            @else
                                                <li><div class="text-tiny">{{ $breadcrumb['label'] }}</div></li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>