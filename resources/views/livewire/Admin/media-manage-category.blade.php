<div>    
                            @include('layouts.backend.inc.breadcrumbs')                                

                            @if (session()->has('message'))
                                <div class="alert alert-success" style = "font-size: 16px;">{{ session('message') }}</div>
                            @endif
                            <!-- Index View -->
                            @if ($action === 'index')
                                <!-- all-user -->
                                <div class="wg-box">
                                    <div class="flex items-center justify-between gap10 flex-wrap">
                                        <div class="wg-filter flex-grow">
                                            <div class="show">
                                                <div class="text-tiny">Showing</div>
                                                <div class="select">
                                                    <select class="">
                                                        <option>10</option>
                                                        <option>20</option>
                                                        <option>30</option>
                                                    </select>
                                                </div>
                                                <div class="text-tiny">entries</div>
                                            </div>
                                            <form class="form-search">
                                                <fieldset class="name">
                                                    <input type="text" placeholder="Search here..." class="" name="name" tabindex="2" value="" aria-required="true" required="">
                                                </fieldset>
                                                <div class="button-submit">
                                                    <button class="" type="submit"><i class="icon-search"></i></button>
                                                </div>
                                            </form>
                                        </div>
                                        <a class="tf-button style-1 w208" href="#" wire:click.prevent="create" ><i class="icon-plus"></i>Add new</a>
                                    </div>
                                    <div class="wg-table table-all-category">
                                        <ul class="table-title flex gap20 mb-14">
                                            <li>
                                                <div class="body-title">Name</div>
                                            </li> 
                                            <li>
                                                <div class="body-title">Action</div>
                                            </li>
                                        </ul>
                                        <ul class="flex flex-column">
                                            @foreach($categories as $category)
                                                <li class="wg-product item-row g20">
                                                    <div class="name">
                                                        @if($category->image)
                                                            <div class="image">
                                                                <img src="{{ $category->image }}" alt="">
                                                            </div>
                                                        @endif
                                                        <div class="title line-clamp-2 mb-0">
                                                            <a href="#" class="body-title-2">{{ $category->name }} </a>
                                                        </div>
                                                    </div>
                                                    <div class="list-icon-function">
                                                        <div class="item eye">
                                                            <a href="#" wire:click.prevent="view({{ $category->id }})" ><i class="icon-eye"></i></a>
                                                        </div>
                                                        <div class="item edit">
                                                            <a  class="item edit" href="#" wire:click.prevent="edit({{ $category->id }})" ><i class="icon-edit-3"></i></a>
                                                        </div>
                                                        <div class="item trash">
                                                            <a class="item trash" href="#" wire:click.prevent="delete({{ $category->id }})" ><i class="icon-trash-2"></i></a>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="divider"></div>
                                    {{ $categories->links('vendor.pagination.tailwind') }}
                                </div>
                                <!-- /all-user -->                                
                            @endif

                            <!-- Index View -->
                            @if ($action === 'create')
                                <!-- new-category -->
                                <div class="wg-box">
                                    <form class="form-new-product form-style-1" method = "POST" wire:submit.prevent="save">
                                        @csrf

                                        <fieldset class="name">
                                            <div class="body-title">Name <span class="tf-color-1">*</span></div>
                                            <input class="flex-grow" type="text" wire:model="name"  placeholder="Category name" value = "{{old('name')}}" tabindex="0" aria-required="true" required>
                                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                        </fieldset>
                                        <fieldset>
                                            <div class="body-title">Upload images <span class="tf-color-1">*</span></div>
                                            <div class="upload-image flex-grow">
                                                <div class="item up-load">
                                                    <label class="uploadfile h250" for="myFile">
                                                        <span class="icon">
                                                            <i class="icon-upload-cloud"></i>
                                                        </span>
                                                        <span class="body-text">Drop your images here or select <span class="tf-color">click to browse</span></span>

                                                        <!-- Show Selected File Name -->
                                                        <span class = "body-text" id="file-name">{{ $image ? $image->getClientOriginalName() : '' }}</span>

                                                        <img id="myFile-input" src="" alt="">
                                                        <input type="file" id="myFile" wire:model="image">
                                                    </label>
                                                </div>
                                            </div>
                                            @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                                        </fieldset>
                                        <div class="bot">
                                            <div></div>
                                            <button class="tf-button w208" type="submit">Save</button>
                                            <button type = "button" class="tf-button w208" wire:click="index">Back</button>
                                        </div>
                                    </form>
                                </div>
                                <!-- /new-category -->                                
                            @endif

                            <!-- Index View -->
                            @if ($action === 'edit')

                                <!-- new-category -->
                                <div class="wg-box">
                                    <form class="form-new-product form-style-1" method = "POST" wire:submit.prevent="update">
                                        @csrf

                                        <fieldset class="name">
                                            <div class="body-title">Name <span class="tf-color-1">*</span></div>
                                            <input class="flex-grow" type="text" wire:model="name"  placeholder="Category name" value = "{{old('name')}}" tabindex="0" aria-required="true" required>
                                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                        </fieldset>
                                        <fieldset>
                                            <div class="body-title">Upload images <span class="tf-color-1">*</span></div>
                                            <div class="upload-image flex-grow">
                                                <div class="item up-load">
                                                    <label class="uploadfile h250" for="myFile">
                                                        <span class="icon">
                                                            <i class="icon-upload-cloud"></i>
                                                        </span>
                                                        <span class="body-text">Drop your images here or select <span class="tf-color">click to browse</span></span>
                                                         
                                                        <!-- Show Selected File Name -->
                                                        <span class = "body-text" id="file-name">{{ $image ? $image->getClientOriginalName() : '' }}</span>


                                                        <img id="myFile-input" src="" alt="">
                                                        <input type="file" id="myFile" wire:model="image">
                                                        @if ($image)
                                                            <img src="{{ $image->temporaryUrl() }}" alt="Preview" width="100">
                                                        @endif
                                                    </label>
                                                </div>
                                            </div>
                                            @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                                        </fieldset>
                                        <div class="bot">
                                            <div></div>
                                            <button class="tf-button w208" type="submit">Update</button>
                                            <button type = "button" class="tf-button w208" wire:click="index">Back</button>
                                        </div>
                                    </form>
                                </div>
                                <!-- /new-category -->  

                            @endif


                            
</div>


