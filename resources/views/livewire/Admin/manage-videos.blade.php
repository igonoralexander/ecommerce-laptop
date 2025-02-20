<div>

@push('styles')
    <style>
       
       .video-preview {
    position: relative;
    width: 100%; /* Full width */
    padding-top: 100%; /* Ensures a square aspect ratio */
    overflow: hidden;
}

.video-preview video {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 70%;
    object-fit: cover; /* Ensures the video fills the square */
}

    </style>
@endpush
    <!-- Search & Filter -->
    <div class="wg-box">
        <div class="flex items-center justify-between gap10 flex-wrap">
            <div class="wg-filter flex-grow">
                <div class="show">
                    <div class="text-tiny">Showing</div>
                    <div class="select">
                        <select wire:model="perPage">
                            <option>10</option>
                            <option>20</option>
                            <option>30</option>
                        </select>
                    </div>
                    <div class="text-tiny">entries</div>
                </div>
                <form class="form-search">
                    <fieldset class="name">
                        <input type="text" placeholder="Search here..." wire:model="search" />
                    </fieldset>
                </form>
            </div>
        </div>
    </div>

         <!--Activity Section-->
         <section class="activity-section">
            <div class="mixit-gallery">
                <div class="filter-list row">
                    @foreach($media as $item)
                        <!--Activity Block-->
                        <div class="activity-block mix {{ $item->media_type }} col-md-4 col-sm-12">
                            <div class="inner-box">
                                <figure class="video-preview">
                                    <a href="{{ $item->file_url }}" data-fancybox="video-gallery" data-type="iframe" class="video-overlay">
                                        <video width="100%" height="auto" controls muted>
                                            <source src="{{ $item->file_url }}" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                        <span class="icon fa fa-play-circle"></span>
                                    </a>
                                </figure>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </section> 
    
        <!-- Pagination -->
    <div class="divider"></div>
    <br>
    <div class="flex items-center justify-between flex-wrap gap10">
        <div class="text-tiny">
            Showing {{ $media->firstItem() }} to {{ $media->lastItem() }} of {{ $media->total() }} entries
        </div>

        <!-- Livewire Pagination Controls -->
        <ul class="wg-pagination">
            @if ($media->onFirstPage())
                <li class="disabled">
                    <span><i class="icon-chevron-left"></i></span>
                </li>
            @else
                <li>
                    <a wire:click="previousPage" wire:loading.attr="disabled"><i class="icon-chevron-left"></i></a>
                </li>
            @endif

            @foreach ($media->getUrlRange(1, $media->lastPage()) as $page => $url)
                <li class="{{ $media->currentPage() == $page ? 'active' : '' }}">
                    <a wire:click="gotoPage({{ $page }})" wire:loading.attr="disabled">{{ $page }}</a>
                </li>
            @endforeach

            @if ($media->hasMorePages())
                <li>
                    <a wire:click="nextPage" wire:loading.attr="disabled"><i class="icon-chevron-right"></i></a>
                </li>
            @else
                <li class="disabled">
                    <span><i class="icon-chevron-right"></i></span>
                </li>
            @endif
        </ul>
    </div>

</div>