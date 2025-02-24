<div>
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

    <div class="gallery-grid">
        @foreach ($media as $item)
            <div class="gallery-item">
                <img src="{{ asset($item->file_url) }}" class="gallery-thumb">
                <a href="{{ asset($item->file_url) }}" class="lightbox-image" data-fancybox="gallery">
                    <div class="lightbox-trigger">    
                        <i class="icon fa fa-search-plus"></i>
                    </div>

                </a>
                <div class="gallery-actions">
                    <a href="{{ asset($item->file_url) }}" download class="action-btn">
                        <i class="fa fa-download"></i>
                    </a>
                    <button class="action-btn share-btn" data-url="{{ asset($item->file_url) }}">
                        <i class="fa fa-share-alt"></i>
                    </button>
                    <button type = "button" class="action-btn delete-btn" wire:click.prevent="confirmDelete({{ $item->id }})">
                        <i class="fa fa-trash"></i>
                    </button>
                </div>
            </div>
        @endforeach
    </div>

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
                <li class="disabled"><span><i class="icon-chevron-left"></i></span></li>
            @else
                <li><a wire:click="previousPage" wire:loading.attr="disabled"><i class="icon-chevron-left"></i></a></li>
            @endif

            @foreach ($media->getUrlRange(1, $media->lastPage()) as $page => $url)
                <li class="{{ $media->currentPage() == $page ? 'active' : '' }}">
                    <a wire:click="gotoPage({{ $page }})" wire:loading.attr="disabled">{{ $page }}</a>
                </li>
            @endforeach

            @if ($media->hasMorePages())
                <li><a wire:click="nextPage" wire:loading.attr="disabled"><i class="icon-chevron-right"></i></a></li>
            @else
                <li class="disabled"><span><i class="icon-chevron-right"></i></span></li>
            @endif
        </ul>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Livewire.on('confirmDelete', (data) => {
                    Swal.fire({
                        title: "Are you sure?",
                        text: "You won't be able to revert this!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#d33",
                        cancelButtonColor: "#3085d6",
                        confirmButtonText: "Yes, delete it!"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Livewire.emit('deleteMedia', data.mediaId); // Send the event to Livewire
                        }
                    });
                });
            });

            Livewire.on('mediaDeleted', () => {
                Swal.fire("Deleted!", "Your file has been deleted.", "success");
                Livewire.emit('refreshComponent');
            });
        </script>
    @endpush
</div>
